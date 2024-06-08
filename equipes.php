  <?php
  require_once 'config.php';
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
  $id_user = null;
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

  $sql = "select * from `equipes` where id_frs != '$id_user' and id not in (select id_equipe from `candidatures` where id_candidat='$id_user' and statut='viré' or statut='acceptee' or statut='en_attente');";

  $all_equipe = $conn->query($sql);
  var_dump($all_equipe);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="stylesheet" href="css/planification.css" type="text/css">
    <link rel="stylesheet" href="css/dropdown.css" type="text/css">
    <title>Rejoindre une équipe</title>
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

  <body class="vh 100">
    <!-- deb liens cdn pour jquery et bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/Button-scroller.js"></script>
    <script defer src="js/fadein.js"></script>
    <script src="js/linkwithjs.js"></script>
    <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>
    <!-- fin liens cdn pour jquery et bootstrap-->
    <!-- Debut Header-->
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
    <!-- Fin Header-->
    <div class="rest-container">
      <div class="coverimage">
        <img src="images/background.jpg" alt="background image" />
      </div>

    </div>

    <!--securité-->

    <div class="partie-container">
      <h2 class="section-title hidden">Equipes de sécurité</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Sécurité') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);


          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe de sécurité disponnible pour le moment.</p>';
      }
      ?>
    </div>
    <!--fin sécurité-->

    <!--entretien-->

    <div class="partie-container">
      <h2 class="section-title hidden">Equipes d'entretien</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Entretien') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);


          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe d\'entretien disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin entretien-->
    <!--formation-->
    <div class="partie-container">
      <h2 class="section-title hidden">Equipes de formation</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Formation') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);

          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe de formation disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin formation-->
    <!--Restauration-->
    <div class="partie-container">
      <h2 class="section-title hidden">Equipes de restauration</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Restauration') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);

          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe de restauration disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin restauration-->
    <!--Musiciens-->
    <div class="partie-container">
      <h2 class="section-title hidden">Equipes de musiciens</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Musique') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);

          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe de musiciens disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin musiciens-->
    <!--services-->
    <div class="partie-container">
      <h2 class="section-title hidden">Equipes de techniciens</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Service') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);

          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe de techniciens disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin services-->
    <!--autres équipes-->
    <div class="partie-container">
      <h2 class="section-title hidden">Autres équipes</h2>
      <div class="all-container">
        <div class="scroller-button-container hidden">
          <button class="scroll-left-button" data-target="media-scroller-1">
            <img src="images/arrow-left.png" />
          </button>
        </div>
        <div class="media-scroller snaps-inline container-fluid mr-1.2 md-1.2 " id="media-scroller-1">
          <?php
          $count = 0;
          while ($row = mysqli_fetch_assoc($all_equipe)) {
            if ($row['categorie'] == 'Autres') {
              $count++;
              echo '<div class="media-element hidden" onclick="window.location.href=\'details_joindre_equipe.php?id=' . $row['id'] . '\';" >';
              echo '<img src="images/upload/equipes/' . $row['image'] . '" alt="">';
              echo '<p class="title">' . $row['libelle'] . '</p>';
              echo '</div>';
            }
          }
          mysqli_data_seek($all_equipe, 0);


          ?>
        </div>

        <div class="scroller-button-container hidden">
          <button class="scroll-right-button" data-target="media-scroller-1">
            <img src="images/arrow-right.png" />
          </button>
        </div>
      </div>
      <?php
      if ($count == 0) {
        echo '<p style="margin:0 80px;align-item:center; font-size:18px;color:#351a02;">Aucune équipe disponnible pour le moment.</p>';
      }
      ?>
    </div>

    <!--fin autres équipes-->











    <!-- Debut footer-->
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
              <li><a href="#">Planification</a></li>
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
    <!-- fin footer-->
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