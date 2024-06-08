<?php
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

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--lien css bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!--fin lien css bootstrap-->
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/acceuil.css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">


  <title>Acceuil</title>

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
    .fa-cart-shopping{
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

  <!--section pour la carrousel -->
  <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
                <style>
                  .btn-primary {
    border-radius:2px;
    border-color:#773a00;
    transition: background-color 0.5s ease, color 0.5s ease;
    background-color: #773a00 !important;
    color: white !important;
}
.btn-primary:hover {
    transform: scale(1.05);
    margin-left: 5px;
    border-color:#773a00;
}
.btn:hover {
  border-color: #773a00 !important;
}

                </style>
    <div class="carousel-inner">
      <div class="carousel-item active c-item">
        <img src="images/esppaces/hotel_byzacene_sbeitla_9.jpg__769x462_q85_crop-smart_subsampling-2.jpg" class="d-block w-100 c-img" alt="Slide 1">
        <div class="carousel-caption top-0 mt-4">
          <p class="mt-5 fs-3 text-uppercase">Decouvrez nos services</p>
          <h1 class="display-1 fw-bolder text-capitalize">Nadhamly</h1>
          <a href="planification.php" class="btn btn-primary px-4 py-2 fs-5 mt-5">Reserver votre evenement</a> <!-- Changed button to anchor tag and added href -->
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="images/esppaces/parcflorale.jpg" class="d-block w-100 c-img" alt="Slide 2">
        <div class="carousel-caption top-0 mt-4">
          <p class="text-uppercase fs-3 mt-5">Tout est disponible</p>
          <p class="display-1 fw-bolder text-capitalize">Tous les differents types d'evenements</p>
          <a href="planification.php" class="btn btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">Reserver votre evenement</a> <!-- Changed button to anchor tag and added href -->
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="images/esppaces/sallerihab.jpg" class="d-block w-100 c-img" alt="Slide 3">
        <div class="carousel-caption top-0 mt-4">
          <p class="text-uppercase fs-3 mt-5">Les activités</p>
          <p class="display-1 fw-bolder text-capitalize">Faisons la fête!</p>
          <a href="planification.php" class="btn btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">Reserver votre evenement</a> <!-- Changed button to anchor tag and added href -->
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev"> <!-- Changed button to anchor tag and added href -->
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next"> <!-- Changed button to anchor tag and added href -->
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

  <!--fin section pour la carrousel-->

  </br></br></br>
  <!--section pour les presentations-->
  <div class="container">
    <section class="about">
      <div class="about-image">
        <img src="images/event.jpg" alt="img" />
      </div>
      <div class="about-content">
        <h2>Votre allié numéro 1!</h2>
        <p>
          orem ipsum dolor sit amet. Est similique earum et eaque sint eum asperiores consectetur qui eveniet accusamus a dolore assumenda ut autem quia in exercitationem recusandae.
          Ex cupiditate omnis est voluptates aspernatur et omnis soluta.

        </p>
        <a href="Apropos.php" class="read-more"> Voir Plus</a>
      </div>
    </section>
  </div>
  <!--fin section pour les presentations-->

  </br></br></br>
  <!--section pour les presentations 2-->
  <div class="container">
    <section class="about">

      <div class="about-content">
        <h2>Boutique en ligne</h2>
        <p>
          orem ipsum dolor sit amet. Est similique earum et eaque sint eum asperiores consectetur qui eveniet accusamus a dolore assumenda ut autem quia in exercitationem recusandae.
          Ex cupiditate omnis est voluptates aspernatur et omnis soluta.

        </p>
       <style>
        .read-more {
  transition: background-color 0.5s ease, color 0.5s ease;
    background-color: #773a00 !important;
    color: white !important;
}
.read-more:hover {
  transform: scale(1.05);
    border-color:#773a00;
}
       </style> 
        <a href="Apropos.php" class="read-more"> Voir Plus</a>
      </div>
      <div class="about-image">
        <img src="images/event2.jpg" alt="img" />
      </div>
    </section>
  </div>
  <!--fin section pour les presentations 2-->

  <!--section pour les packages-->
  <section id="packages" class="pt-5">
    <h2 class="text-center my-5">Nos Packages </h2>
    <div class="container">
      <style>
        .card .card-img-top {
          height:auto;
        }
        .card {
          padding:1rem;
        }
      </style>
      <div class="row" align="center">

        <div class="col-lg">
          <div class="card">
            <img src="images/package-bronz.png" class="card-img-top" alt="images/placeholder.webp">
            <div class="card-body">
              <h5 class="card-title">Bronze</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Ajouter au panier</a>
            </div>
          </div>
        </div>

        <div class="col-lg">
          <div class="card">
            <img src="images/package-silver.png" class="card-img-top" alt="images/placeholder.webp">
            <div class="card-body">
              <h5 class="card-title">Silver</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Ajouter au panier</a>
            </div>
          </div>
        </div>

        <div class="col-lg">
          <div class="card">
            <img src="images/gold-package.png" class="card-img-top" alt="images/placeholder.webp">
            <div class="card-body">
              <h5 class="card-title">Golden</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Ajouter au panier</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    </br></br></br>
  </section>
  <!--fin section pour les packages-->

  </br></br></br>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <!--footer-->
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

            <li><a href="index.php">Acceuil</a></li>
            <li><a href="Apropos.php">A propos</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="planification.php">Planification</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="connecter.php">Se connecter</a></li>
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