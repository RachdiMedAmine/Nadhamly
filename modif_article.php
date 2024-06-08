<?php
include 'config.php';
session_start();

if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}
if (isset($_SESSION['success_message'])) : ?>
  <div class="alert alert-success" style=" padding: 5px 5px;
      border: 1px solid transparent;
      border-radius: .25rem; color: black; background-color: green;">
    <?php echo $_SESSION['success_message']; ?>
  </div>
<?php unset($_SESSION['success_message']);
endif;

$id_art = $_GET['id'];
$default_image = "image_default.png";
$sql = "select * from `articles` where id='$id_art'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$libelle = $row['libelle'];
$qte = $row['nombre'];
$prix = $row['prix'];
$motif = $row['motif'];
$image1 = $row['image1'];
$image2 = $row['image2'];
$image3 = $row['image3'];
$desc = $row['description'];
$cat = $row['categorie'];
if (isset($_POST['submit'])) {

  $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
  $qte = mysqli_real_escape_string($conn, $_POST['qte']);
  $prix = mysqli_real_escape_string($conn, $_POST['prix']);
  $desc = mysqli_real_escape_string($conn, $_POST['desc']);
  $cat = mysqli_real_escape_string($conn, $_POST['cat']);
  $motif = mysqli_real_escape_string($conn, $_POST['motif']);
  $id_frs = $_SESSION["id_user"];
  $frs = $_SESSION["utilisateur"];

  //images 
  //1ere image
  if (empty($_FILES['images']['name'][0])) {

    $image1 = $default_image;
    $image1_size = 0;
    $image1_tmp_name = '';
    $image1_folder = 'images/upload/articles/' . $image1;
  } else {
    $image1 = $_FILES['images']['name'][0];
    $image1_size = $_FILES['images']['size'][0];
    $image1_tmp_name = $_FILES['images']['tmp_name'][0];
    $image1_folder = 'images/upload/articles/' . $image1;
  }
  // image2
  if (empty($_FILES['images']['name'][1])) {

    $image2 = $default_image;
    $image2_size = 0;
    $image2_tmp_name = '';
    $image2_folder = 'images/upload/articles/' . $image1;
  } else {
    $image2 = $_FILES['images']['name'][1];
    $image2_size = $_FILES['images']['size'][1];
    $image2_tmp_name = $_FILES['images']['tmp_name'][1];
    $image2_folder = 'images/upload/articles/' . $image2;
  }
  //image3

  if (empty($_FILES['images']['name'][2])) {

    $image3 = $default_image;
    $image3_size = 0;
    $image3_tmp_name = '';
    $image3_folder = 'images/upload/articles/' . $image1;
  } else {
    $image3 = $_FILES['images']['name'][2];
    $image3_size = $_FILES['images']['size'][2];
    $image3_tmp_name = $_FILES['images']['tmp_name'][2];
    $image3_folder = 'images/upload/articles/' . $image3;
  }
  $image1 = htmlspecialchars($image1);
  $image2 = htmlspecialchars($image2);
  $image3 = htmlspecialchars($image3);

  if (empty(trim($libelle))) {
    $libelle_error = "Le libelle est obligatoire!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $libelle_error;
    echo "</div>";
  } elseif (empty(trim($qte))) {
    $qte_vide_error = "La quantité est obligatoire!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
      border: 1px solid transparent;
      border-radius: .25rem;'>";
    echo $qte_vide_error;
    echo "</div>";
  } elseif (!ctype_digit($qte) || ($qte < 0)) {
    $qte_error = "La quantité doit être un entier positif!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
      border: 1px solid transparent;
      border-radius: .25rem;'>";
    echo $qte_error;
    echo "</div>";
  } elseif (empty(trim($prix))) {
    $prix_vide_error = "Le prix est obligatoire!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $prix_vide_error;
    echo "</div>";
  } elseif (!is_numeric($prix) || ($prix < 0)) {
    $prix_error = "Le prix doit être un réél positif!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $prix_error;
    echo "</div>";
  } elseif (empty(trim($image1))) {
    $image_error = "Vous devez insérer au moins une image de votre produit!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $image_error;
    echo "</div>";
  } elseif (empty(trim($desc))) {
    $desc_error = "La description est obligatoire!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
   border: 1px solid transparent;
   border-radius: .25rem;'>";
    echo $desc_error;
    echo "</div>";
  } elseif ($image1_size > 2000000) {
    $message1 = '1ère image très volumineuse!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $message1;
    echo "</div>";
  } elseif ($image2_size > 2000000) {
    $message2 = '2eme image très volumineuse!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $message2;
    echo "</div>";
  } elseif ($image3_size > 2000000) {
    $message3 = '3eme image très volumineuse!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
       border: 1px solid transparent;
       border-radius: .25rem;'>";
    echo $message3;
    echo "</div>";
  } elseif (empty($image1)) {
    $image1 = $row['image1'];
  } elseif (empty($image2)) {
    $image2 = $row['image2'];
  } elseif (empty($image3)) {
    $image3 = $row['image3'];
  } else {
    $update = mysqli_query($conn, "update `articles` set libelle='$libelle', description='$desc', nombre='$qte', prix='$prix', categorie='$cat', motif='$motif', image1='$image1', image2='$image2', image3='$image3' where id='$id_art'; ") or die('requête échouée');

    if ($update) {
      move_uploaded_file($image1_tmp_name, $image1_folder);
      move_uploaded_file($image2_tmp_name, $image2_folder);
      move_uploaded_file($image3_tmp_name, $image3_folder);
      $message4 = 'Modification avec succés!';

      header('location:contact.php');
      echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem; color: black; background-color: green;'>";
      header('location:profile.php');
      $_SESSION['success_message'] = 'Modification de l\'article avec avec succés!';
    } else {
      $message5 = 'Echec de la modification!';
      echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem;'>";
      echo $message5;
      echo "</div>";
      $_SESSION['success_message'] = 'Echec de la modification!!';
    }
  }
}
if (isset($_SESSION["pdp"])) {
  $pdp = $_SESSION["pdp"];
} else {
  $pdp = null;
}
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
} else {
  $role = null;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/ajout_article.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <title>Modification</title>

  <style>
    .fa-cart-shopping {
      font-size: 24px;
      color: var(--text-marron);
      margin-left: 10px;
      margin-right: 10px;
      padding-left: 10px;
      padding-right: 10px;
    }

    .fa-cart-shopping:hover {
      transform: scale(1.2);
      color: red;
    }
  </style>
</head>

<body>
  <!-- deb liens cdn pour jquery et bootstrap-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>
  <!-- fin liens cdn pour jquery et bootstrap-->

   <!-- debut nav bar-->
   <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo Nadhamly"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-white border-bottom">
              <h5 class="offcanvas-title fontradley" id="offcanvasNavbarLabel">Nadhamly</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
              <?php
              if ($role == "admin") {
                echo "<li class='nav-item'>
                <a class='nav-link  fontradley bold' aria-current='page' href='dashboard.php'>Admin Dashboard</a>
              </li>";
              }
            ?>
                <li class="nav-item">
                  <a class="nav-link  fontradley bold" aria-current="page" href="index.php">Acceuil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  fontradley bold" href="Apropos.php">A propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  fontradley bold" href="portfolio.php">Portfolio</a>
                  </li>
                  <li class="nav-item fontradley">
                    <a class="nav-link  bold" href="planification.php">Planification</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fontradley  bold" href="contact.php">Contact</a>
                  </li>
                  <li class="nav-item">
              <a href="panier.php" class="cart-link">
                <i class="fa-solid fa-cart-shopping icon-style"></i>
              </a>
            </li>
                  <li class="nav-item">
                  <?php if(isset($_SESSION["utilisateur"])) { ?>
                    <!-- If user is logged in, display image -->
                         <div class="profile-dropdown">
          <div  onclick="toggle()" class="profile-img" id="image-container">
          <?php if (!empty($pdp)) { ?>
                <img src="<?php echo $pdp; ?>" style="border-radius: 50%; overflow: hidden; width: 55px; height: 55px; object-fit: cover;" id="profile-image">
            <?php } else { ?>
                <img src="images/defaultpdp.jpg" alt="Default Profile Picture" style="border-radius: 50%; overflow: hidden; width: 75px; height: 75px; object-fit: cover;" id="profile-image">
            <?php } ?>
          </div>

        <ul class="profile-dropdown-list" style="list-style-type: none;padding:0;z-index:30;">
          <li class="profile-dropdown-list-item">
            <a href="profile.php">
              <i class="fa-regular fa-user"></i>
              <?php $username= $_SESSION["utilisateur"];
              echo $username;
              ?>
            </a>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="equipes.php">
            <i class="ri-user-add-fill"></i>
              Rejoindre des équipes
            </a>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="demandes.php">
              <i class="fa-solid fa-chart-line"></i>
              Demandes de partenariat
            </a>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="recherche.php">
              <i class="fa-solid fa-search"></i>
              Rechercher
            </a>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="#">
              <i class="fa-regular fa-circle-question"></i>
              Aide et contact
            </a>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="#">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              <?php if(isset($_SESSION["utilisateur"])) { ?>
                    <!-- If user is logged in, display logout button -->
                    <form method="post">
                        <button type="submit" name="logout" class="btn btn-link text-black fontradley button-reset">Déconnexion</button>
                    </form>
                    <?php } else { ?>
                    <!-- If user is not logged in, display regular button -->
                    <a class="nav-link text-white px-3 py-1 rounded-4 fontradley navbtn" href="login.php">Se connecter</a>
                <?php } ?>
            </a>
          </li>
        </ul>
      </div>
                <?php } else { ?>
                    <!-- If user is not logged in, display regular button -->
                    <a class="nav-link text-white px-3 py-1 rounded-4 fontradley navbtn" href="login.php">Se connecter</a>
                <?php } ?>
                  </li>
              </ul>
              
            </div>
          </div>
        </div>
      </nav>
  <!-- fin nav bar-->
  <!--début -->

  <section class="container">
    <header>Fiche article</header>
    <p>Veuillez modifier tous les détails concernant l'article que vous voulez mettre en location via ce formulaire!</p>
    <form action="#" class="form" method="post" enctype="multipart/form-data">
      <div class="input-box">
        <label>libelle</label>
        <input type="text" placeholder="Entrer le libellé de l'article" name="libelle" value="<?php echo $libelle ?>" />
      </div>
      <div class="input-box">
        <label>Quantité disponible</label>
        <input type="text" placeholder="Entrer la quantité disponible" name="qte" value="<?php echo $qte ?>" />
      </div>

      <div class="input-box">
        <label>Prix unitaire</label>
        <input type="text" placeholder="Entrer le prix unitaire" name="prix" value="<?php echo $prix ?>" />
      </div>
      <div class="input-box2">
        <label>Description</label>
        <textarea col="15" rows="5" name="desc"><?php echo $desc ?></textarea>
      </div>
      <div class="cat-box">
        <h3>Catégorie</h3>
        <div class="cat-option">
          <div class="cat">
            <input type="radio" id="meuble" name="cat" value="meuble" <?php echo ($cat == 'meuble') ? 'checked' : ''; ?> />
            <label for="meuble">Meuble</label>
          </div>
          <div class="cat">
            <input type="radio" id="equipement" name="cat" value="equipement" <?php echo ($cat == 'equipement') ? 'checked' : ''; ?> />
            <label for="equipement">Equipement</label>
          </div>
          <div class="cat">
            <input type="radio" id="espace" name="cat" value="espace" <?php echo ($cat == 'espace') ? 'checked' : ''; ?> />
            <label for="espace">Espace</label>
          </div>
          <div class="cat">
            <input type="radio" id="formation" name="cat" value="formation" <?php echo ($cat == 'formation') ? 'checked' : ''; ?> />
            <label for="espace">Formation</label>
          </div>
          <div class="cat">
            <input type="radio" id="service" name="cat" value="service" <?php echo ($cat == 'service') ? 'checked' : ''; ?> />
            <label for="service">Service</label>
          </div>
          <div class="cat">
            <input type="radio" id="autres" name="cat" value="autres" <?php echo ($cat == 'autres') ? 'checked' : ''; ?> />
            <label for="espace">Autres</label>
          </div>

        </div>
      </div>
      <div class="cat-box">
        <h3>Vous souhaitez le mettre en </h3>
        <div class="cat-option">
          <div class="cat">
            <input type="radio" id="vente" name="motif" value="vente" <?php echo ($motif == 'vente') ? 'checked' : ''; ?> />
            <label for="vente">Vente</label>
          </div>
          <div class="cat">
            <input type="radio" id="location" name="motif" value="location" <?php echo ($motif == 'location') ? 'checked' : ''; ?> />
            <label for="location">Location</label>
          </div>





        </div>
      </div>
      <br>
      <label> Photos:</label>
      <div class="container2">
        <input type="file" id="file-input" name="images[]" accept="image/png, image/jpeg" onchange="preview()" multiple>
        <label for="file-input">
          <i class="ri-upload-fill"></i> &nbsp; Choisir une photo
        </label>
        <p id="num-of-files">Aucune photo</p>
        <div id="images" class="images">
          <?php
          if (!empty($image1)) {
            echo '<img src="images/upload/articles/' . $image1 . '" alt="Image 1" class="image-preview">';
          }
          if (!empty($image2)) {
            echo '<img src="images/upload/articles/' . $image2 . '" alt="Image 2" class="image-preview">';
          }
          if (!empty($image3)) {
            echo '<img src="images/upload/articles/' . $image3 . '" alt="Image 3" class="image-preview">';
          }
          ?>
        </div>
      </div>


      <input type="submit" class="button" name="submit" value="Modifier" />
      <a href="profile.php"><input type="button" class="button" value="Annuler" /></a>

    </form>
  </section>
  <br />










  <script src="js/ajout_article.js"></script>

  <!--fin -->
  <footer class="bg-dark pt-5 pb-4">
    <div class="container-fluid">
      <div class="row  text-white">
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <h2 style="font-family:'Times New Roman', Times, serif;font-weight: 500;">A propos</h2>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <h2 style="font-family: 'Times New Roman', Times, serif;font-weight: 500;">Accés Rapide</h2>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <h2 style="font-family: 'Times New Roman', Times, serif;font-weight: 500;">Contactez-Nous</h2>
        </div>
      </div>
      <div class="row greytext">
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <p style="font-family:'Times New Roman', Times, serif;"> Nadhamly est un projet crée afin de faciliter l'organisation des évènements il offre une plateforme unique, rapide et facile à utiliser aux utilisateurs qui aspirent à planifier tous les aspects de leurs propres évènements en une seule place et même aux fournisseurs qui cherchent une vitrine pour présenter leurs services et produits. Ceci permettra aux utilisateurs de maximiser leur gain de temps et profiter pleinement de chaque moment spécial.
          </p>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <ul>

            <li><a href="#">Acceuil</a></li>
            <li><a href="Apropos.html">A propos</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="planification.html">Planification</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="login.html">Se connecter</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-1 mx-auto mt-3">
          <ul class="coordonnées">
            <li align="left">&#128205; <a href="https://maps.app.goo.gl/zLKkJNBrgjAyrBT1A">5, avenue Taha Hussein Montfleury,<br /> 1008 Tunis</a></li>
            <li align="left">&#128222; <a href="tel:216 71 39 25 91">71 39 25 91</a></li>
            <li align="left">&#128224; <a href="tel:216 71 39 11 66"> 71 39 11 66</a></li>
            <li align="left">&#128231; <a href="mailto:contact@ensit.rnu.tn">contact@ensit.rnu.tn</a></li>
          </ul>
        </div>

      </div>
    </div>
  </footer>

  <script src="js/dropdown.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var imageContainer = document.getElementById('image-container');
      var profileImage = document.getElementById('profile-image');

      // Add event listener for hover effect
      imageContainer.addEventListener('mouseover', function() {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1.1)';
        imageContainer.style.cursor = 'pointer';
      });

      // Add event listener to reset when mouse leaves
      imageContainer.addEventListener('mouseout', function() {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1)';
      });
    });
  </script>

</body>

</html>