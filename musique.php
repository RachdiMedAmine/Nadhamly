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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/restauration.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">

  <title>Musique</title>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="js/Button-scroller.js"></script>
  <script defer src="js/fadein.js"></script>
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

  <div class="partie-container">
    <h2 class="section-title hidden">Troupes</h2>
    <div class="all-container">
      <div class="scroller-button-container hidden">
        <button class="scroll-left-button" data-target="media-scroller-1">
          <img src="images/arrow-left.png" />
        </button>
      </div>
      <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
        <div class="media-element hidden">
          <div class="image">
            <img src="images/traiteurs/Alex-toukebri.jpg" alt="chaises">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Alex toukebri</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/traiteurs/hamadi-Monji.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Hamadi Monji</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/traiteurs/Masoudd  belhadj.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Masoud Belhadj</p>
        </div>
      </div>

      <div class="scroller-button-container hidden">
        <button class="scroll-right-button" data-target="media-scroller-1">
          <img src="images/arrow-right.png" />
        </button>
      </div>
    </div>
  </div>

  <div class="partie-container">
    <h2 class="section-title hidden">Musiciens</h2>
    <div class="all-container">
      <div class="scroller-button-container hidden">
        <button class="scroll-left-button" data-target="media-scroller-2">
          <img src="images/arrow-left.png" />
        </button>
      </div>
      <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-2">
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/JALEL JOUNAIDI.jpg" alt="chaises">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Jalel Jounaidi</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/Nour abdessmad.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Nour Abdessmad</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/firas boutabga.jpg" alt="">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Firas Boutabga</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/Alin Peter.jpg" alt="">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Alin Peter</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/Personnel1.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">ahlem firas</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/Personnel2.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Amal firas</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/serveurs/personnel3.jpg" alt="">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Amine Hajer</p>
        </div>
      </div>

      <div class="scroller-button-container hidden">
        <button class="scroll-right-button" data-target="media-scroller-2">
          <img src="images/arrow-right.png" />
        </button>
      </div>
    </div>
  </div>

  <div class="partie-container">
    <h2 class="section-title hidden">Chanteurs</h2>
    <div class="all-container">
      <div class="scroller-button-container hidden">
        <button class="scroll-left-button" data-target="media-scroller-1">
          <img src="images/arrow-left.png" />
        </button>
      </div>
      <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
        <div class="media-element hidden">
          <div class="image">
            <img src="images/Baristas/personnel4.jpg" alt="chaises">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Babak Traouri</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/Baristas/personnel5.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Monji faracha</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/traiteurs/Masoudd  belhadj.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Masoud Belhadj</p>
        </div>
      </div>

      <div class="scroller-button-container hidden">
        <button class="scroll-right-button" data-target="media-scroller-1">
          <img src="images/arrow-right.png" />
        </button>
      </div>
    </div>
  </div>


  <div class="partie-container">
    <h2 class="section-title hidden">DJ</h2>
    <div class="all-container">
      <div class="scroller-button-container hidden">
        <button class="scroll-left-button" data-target="media-scroller-1">
          <img src="images/arrow-left.png" />
        </button>
      </div>
      <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
        <div class="media-element hidden">
          <div class="image">
            <img src="images/Baristas/personnel4.jpg" alt="chaises">
            <div class="badge-container">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Anwer Sokap</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/Baristas/personnel5.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Monji faracha</p>
        </div>
        <div class="media-element hidden">
          <div class="image">
            <img src="images/traiteurs/Masoudd  belhadj.jpg" alt="">
            <div class="badge-container" style="display: none;">
              <img src="images/badge.png" />
            </div>
          </div>
          <p class="title">Masoud Belhadj</p>
        </div>
      </div>

      <div class="scroller-button-container hidden">
        <button class="scroll-right-button" data-target="media-scroller-1">
          <img src="images/arrow-right.png" />
        </button>
      </div>
    </div>
  </div>

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