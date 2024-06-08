<?php
require 'config.php';
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
$id_user = $_SESSION["id_user"];
$id_article = $_GET['id'];
$sql = "SELECT * FROM `articles` WHERE id = '$id_article'";
$res = mysqli_query($conn, $sql);
$article = $res->fetch_assoc();
$sql2 = "SELECT * FROM `articles` WHERE categorie = '{$article['categorie']}' AND id != '$id_article' AND id_frs = $id_user LIMIT 4";
$qlq_articles = $conn->query($sql2);
$sqlf = "SELECT * FROM `utilisateur` WHERE id_user = $id_user";
$resf = mysqli_query($conn, $sqlf);
$fournisseur = $resf->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--lien css bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!--finlien css bootstrap-->
  <link rel="icon" href="images/logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <!--lien css vid yt-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <!--fi lien css vid yt-->

  <!--mes css-->
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/details-art.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <!--fin mes css-->

  <title><?php echo $article['libelle']; ?></title>

  <script src="js/detail-art.js"></script>

  <!--style pour alligner les cartes-->
  <style>
    /* Additional CSS for card height */
    .product {
      display: flex;
      align-items: stretch;
    }

    .product .card {
      width: 100%;
    }

    /* Equal height for card images */
    .card .card-img-top {
      height: 200px;
      /* Adjust the height as needed */
      object-fit: cover;
    }

    /* Align button and text on the same level */
    .card-body {
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      /* Change this line */
      height: 100%;
      /* Ensure card body fills the entire height */
    }
  </style>
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
  <!--fin style pour alligner les cartes-->

</head>

<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>

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

  <!--partie article-->
  <section class="container sproduct">

    <div class="row mt-5">

      <!--partie des image (partie gauche)-->
      <div class="col-lg-5 col-md-12 col-12">
        <!--carrousel pour grande image-->
        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <?php for ($i = 1; $i <= 3; $i++) { ?>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i - 1; ?>" <?php echo ($i == 1) ? 'class="active"' : ''; ?> aria-label="Slide <?php echo $i; ?>"></button>
            <?php } ?>
          </div>
          <div class="carousel-inner">
            <?php for ($i = 1; $i <= 3; $i++) { ?>
              <div class="carousel-item <?php echo ($i == 1) ? 'active' : ''; ?>">
                <img class="img-fluid w-100 pb-1 big-img" src="images/upload/articles/<?php echo $article['image' . $i]; ?>" alt="placeholder">
              </div>
            <?php } ?>
          </div>
          <button class="carousel-control-prev" type="button" da ta-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!--fin carrousel pour grande image-->


        <!--partie pour les petites images-->
        <div class="small-img-group d-flex justify-content-between">
          <?php
          // Parcourir les images de la base de données
          for ($i = 1; $i <= 3; $i++) {
            $imageFieldName = 'image' . $i; // Nom du champ de l'image dans la base de données
            $imagePath = $article[$imageFieldName]; // Chemin de l'image récupérée de la base de données
            // Vérifier si le chemin de l'image n'est pas vide
            if (!empty($imagePath)) {
          ?>
              <div class="small-img-col">
                <img src="images/upload/articles/<?php echo $imagePath; ?>" width="100%" class="small-img" alt="placeholder" id="small-img-<?php echo $i; ?>">
              </div>
          <?php
            }
          }
          ?>
        </div>
        <!--fin partie pour les petites images-->
      </div>
      <!--fin partie des image-->

      <!--(right div) partie prix etc-->
      <div class="col-lg-6 col-md-12 col-12">
        <h6><?php echo $article['categorie'] . "/" . $article['motif']; ?></h6>
        <h3 class="py-2"><?php echo $article['libelle']; ?></h3>
        <div class="star ">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h2>prix unitaire: <?php echo $article['prix']; ?></h2>
        <h4><?php echo "Quantité disponnible: " . $article['nombre']; ?></h4>
        <h4><?php echo "Fournisseur: " . $fournisseur['nom'] . " " . $fournisseur['prenom']; ?></h4>
        <h4><?php echo "Catégorie: " . $article['categorie']; ?></h4>
        <h4 class="mt-5 ">Description</h4>
        <p><?php echo $article['description']; ?>
        </p>
        <a href="modif_article.php?id=<?php echo $article['id']; ?>" style="text-decoration:none;"><button class="buy-btn"><i class="ri-pencil-fill"></i> Modifier</button></a>
        <a href="delete_article.php?id=<?php echo $article['id']; ?>" style="text-decoration:none;"><button class="buy-btn"><i class="ri-delete-bin-fill"></i> Supprimer</button></a>

      </div>
      <!-- fin partie prix etc-->

    </div>

  </section>
  <!--fin partie article-->

  <!--partie article reliés-->
  <section id="featured" class="my-5 pb-5">

    <div class="container text-center mt-5 pb-5">
      <hr class="mx-auto">
      <h3>Articles Similaires</h3>
      <hr class="mx-auto">
      <p>Autres articles qui pourront vous intéresser</p>
    </div>

    <div class="row mx-auto container-fluid">
      <?php
      while ($row = mysqli_fetch_assoc($qlq_articles)) {

      ?>
        <div class="product text-center col-lg-3 col-md-4 col-12">
          <div class="card">
            <img class="card-img-top" src="images/upload/articles/<?php echo $row['image1']; ?>" alt="">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['libelle']; ?></h5>
              <h4 class="card-text"><?php echo $row['prix']; ?> DT</h4>
              <div class="star my-2">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <a href="details_art_vente_perso.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;"> <button class="btn btn-primary buy-btn">voir détails</button></a>
            </div>
          </div>
        </div>

      <?php } ?>
      <!-- Repeat this structure for other products -->

    </div>
  </section>
  <!--fin partie reliées-->

  <!--début footer-->
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

            <li><a href="index.html">Acceuil</a></li>
            <li><a href="#">A propos</a></li>
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
  <!--fin footer-->

  <!--script pour changer les images dans la carrousel on click-->
  <script>
    // Get references to the main image, small images, and carousel indicators
    const mainImg = document.getElementById('mainImg');
    const smallImgs = document.querySelectorAll('.small-img');
    const carouselIndicators = document.querySelectorAll('.carousel-indicators button');

    // Loop through each small image and attach a click event listener
    smallImgs.forEach((smallImg, index) => {
      smallImg.addEventListener('click', () => {
        // Update the main image with the clicked small image's source
        mainImg.src = smallImg.src;

        // Deactivate all carousel indicators
        carouselIndicators.forEach(indicator => {
          indicator.classList.remove('active');
        });

        // Activate the corresponding carousel indicator
        carouselIndicators[index].classList.add('active');
      });
    });
  </script>
  <!--fin script pour changer les images dans la carrousel on click-->
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

  <!--bootstrap js links-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <!--bootstrap js links-->

</body>

</html>