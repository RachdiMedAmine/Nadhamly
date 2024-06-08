<?php
include 'config.php';
session_start();

if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
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
if (isset($_SESSION['success_message'])) : ?>
  <div class="alert alert-success" style=" padding: 5px 5px;
      border: 1px solid transparent;
      border-radius: .25rem; color: black; background-color: green;">
    <?php echo $_SESSION['success_message']; ?>
  </div>
<?php unset($_SESSION['success_message']);
endif;

$libelle = null;
$libelle_error = null;
$desc = null;
$desc_error = null;
$prix = 0;
$prix_vide_error = null;
$prix_error = null;
$image_error = null;
$image1 = null;
$default_image = "image_default.png";

if (isset($_POST['submit'])) {
  $id = uniqid();
  $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
  $prix = mysqli_real_escape_string($conn, $_POST['prix']);
  $desc = mysqli_real_escape_string($conn, $_POST['desc']);
  $cat = mysqli_real_escape_string($conn, $_POST['cat']);
  $id_frs = $_SESSION["id_user"];



  //image
  $image1 = $_FILES['equipeImage']['name'];
  $image1_size = $_FILES['equipeImage']['size'];
  $image1_tmp_name = $_FILES['equipeImage']['tmp_name'];
  $image1_folder = 'images/upload/equipes/' . $image1;


  $image1 = htmlspecialchars($image1);



  if (empty(trim($libelle))) {
    $libelle_error = "Le libelle est obligatoire!";
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem;'>";
    echo $libelle_error;
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
    $image_error = "Vous devez insérer une image de votre équipe!";
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
    $message1 = ' image très volumineuse!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem;'>";
    echo $message1;
    echo "</div>";
  } else {
    $insert = mysqli_query($conn, "INSERT INTO `equipes` (id, libelle, description, prix, image,categorie, id_frs) values ('$id','$libelle','$desc','$prix','$image1','$cat','$id_frs')") or die('requête échouée');

    if ($insert) {
      move_uploaded_file($image1_tmp_name, $image1_folder);



      // header('location:contact.php');
      echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem; color: black; background-color: green;'>";
      header('location:profile.php');
      $_SESSION['success_message'] = 'Création avec succés!';
    } else {
      $message4 = 'Echec de la création!';
      $_SESSION['error_message'] = 'Echec de la création!';
      echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem;'>";
      echo $message4;
      echo "</div>";
    }
  }
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
  <link rel="stylesheet" href="css/form_validation.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <title>Création d'équipe</title>
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
  <script>
    function triggerClick() {
      document.querySelector('#equipeImage').click();
    }

    function displayImage(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.querySelector('#imageDisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }
  </script>
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
    <header>Fiche équipe</header>
    <p>Veuillez indiquer tous les détails concernant l'équipe que vous voulez créer via ce formulaire!</p>
    <form action="#" class="form" method="post" enctype="multipart/form-data">

      <img src="images/default/image_default.png" id="imageDisplay" style="
  
  display: block;
  width: 40%;
  margin:10px auto;
  border-radius: 50%;" onClick="triggerClick()" />
      <input type="file" name="equipeImage" onChange="displayImage(this)" id="equipeImage" style="display:none;">





      <div class="input-box">
        <label>libelle</label>
        <input type="text" placeholder="Entrer le libellé de l'équipe" name="libelle" />
      </div>


      <div class="input-box">
        <label>Prix</label>
        <input type="text" placeholder="Entrer le prix " name="prix" />

      </div>
      <div class="input-box2">
        <label>Description</label>
        <textarea col="15" rows="5" name="desc" placeholder="Entrer la description de votre équipe"></textarea>

      </div>
      <div class="cat-box">
        <h3>Catégorie</h3>
        <div class="cat-option">
          <div class="cat">
            <input type="radio" id="sécurité" name="cat" value="Sécurité" checked />
            <label for="sécurité">Sécurité</label>
          </div>
          <div class="cat">
            <input type="radio" id="formation" name="cat" value="Formation" />
            <label for="formation">Formation</label>
          </div>
          <div class="cat">
            <input type="radio" id="restauration" name="cat" value="Restauration" />
            <label for="restauration">Restauration</label>
          </div>
          <div class="cat">
            <input type="radio" id="musique" name="cat" value="Musique" />
            <label for="musique">Musique</label>
          </div>
          <div class="cat">
            <input type="radio" id="service" name="cat" value="Service" />
            <label for="service">Service</label>
          </div>
          <div class="cat">
            <input type="radio" id="entretien" name="cat" value="Entretien" />
            <label for="entretien">Entretien</label>
          </div>
          <div class="cat">
            <input type="radio" id="autres" name="cat" value="Autres" />
            <label for="autres">Autres</label>
          </div>

        </div>
      </div>



      <input type="submit" class="button" name="submit" value="Créer" />
      <input type="reset" class="button" name="submit" value="Annuler" />

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