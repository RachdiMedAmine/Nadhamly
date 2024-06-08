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
if (isset($_SESSION['error_message'])) : ?>
  <div class="alert alert-error" style=" padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem; color: black; background-color:red;">
    <?php echo $_SESSION['error_message']; ?>
  </div>
<?php unset($_SESSION['error_message']);
endif;

if (isset($_SESSION["pdp"])) {
  $pdp = $_SESSION["pdp"];
} else {
  $pdp = null;
}
if (!empty($_SESSION["role"])) {
  $role = $_SESSION["role"];
} else {
  $role = "role";
}
if (!empty($_SESSION["bio"])) {
  $bio = $_SESSION["bio"];
} else {
  $bio = "lorem ipsum dolor sit amet. Est similique earum et eaque sint eum asperiores consectetur qui eveniet accusamus a dolore assumenda ut autem quia in exercitationem recusandae. Ex cupiditate omnis est voluptates aspernatur et omnis soluta. ";
}

$id_user = $_SESSION["id_user"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/planification.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <link rel="stylesheet" href="css/profile1.css" type="text/css">

  <!-- Unicons CSS -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <title><?php echo $_SESSION['utilisateur']; ?></title>

  <style>
    :root {
      --bg-color: #fffbf7;
      --text-noir: black;
      --text-bleu: blue;
      --text-marron: #773a00;
      --marron-int: #351a02;
      --marron-clair: #ffe8d4dd;
      --footer-color: #999;
      --bronze: #977b3f;
    }

    .cover-photo {
      height: 200px;
      background-color: #333;
      overflow: hidden;
    }

    .cover-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    .profile-info {
      margin-top: -80px;
    }

    .biography-container {
      width: 40%;
      text-align: center;

    }

    .biography-container h5 {
      margin-left: 0;
      margin-bottom: 1rem;
    }

    .card {
      padding: 0;
      width: 300px;
      /* Set a fixed width for the card */
      height: 400px;
      /* Set a fixed height for the card */
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-left: 1rem;
      margin-right: 1rem;
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 12px hsla(29, 69%, 34%, 0.337);
    }

    .card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      color: #773a00;
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 20px;
    }

    .card-links {
      margin-top: 10px;
      text-align: center;
      /* Center align the links */
    }

    .card-links a {
      color: #773a00;
      margin-right: 10px;
      transition: color 0.3s ease-in-out;
      display: inline-block;
      font-size: 20px;
      position: relative;
      text-decoration: none;
    }

    .card-links a:hover {
      color: #ff7f50;
      /* Change color on hover */
      transform: scale(1.2);
      /* Add a slight scale effect on hover */
    }

    @media (min-width: 1400px) {
      .profile-username-pic {
        display: flex;
        flex-direction: row;
        align-items: center;
      }

      .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the container without stretching */
        /* Optional: if you want rounded profile pictures */
      }

      .profile-picture {
        border: 4px solid #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      }

      .title-button {
        padding-left: 2.5rem !important;
        padding-right: 5rem !important;
      }
    }

    @media (max-width: 1400px) {

      /* Stack profile picture, username, role, and modify profile button vertically and center them */
      .profile-info {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
      }

      .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the container without stretching */
        /* Optional: if you want rounded profile pictures */
      }

      /* Center the modify profile button */
      .align-self-end {
        margin-top: auto;
        margin-bottom: auto;
      }

      .profile-picture {
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      }

      .title-button {
        padding-left: 2.5rem !important;
        padding-right: 3.5rem !important;
      }

    }

    @media (max-width:991px) {
      .cont {
        position: relative;
        left: 50%;
        transform: translate(-50%);
        margin-top: 1.6rem;
      }
    }

    /* Google Fonts - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");


    .input-box {
      position: relative;
      height: 76px;
      max-width: 900px;
      width: 100%;
      background: var(--bg-color);
      margin: 0 250px;
      border-radius: 8px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .input-box i,
    .input-box .button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }

    .input-box i {
      left: 20px;
      font-size: 30px;
      color: var(--bronze);
    }

    .input-box input {
      height: 100%;
      width: 100%;
      outline: none;
      font-size: 18px;
      font-weight: 400;
      border: none;
      padding: 0 155px 0 65px;
      background-color: transparent;
    }

    .input-box .button {
      right: 20px;
      font-size: 16px;
      font-weight: 400;
      color: var(--marron-clair);
      border: none;
      padding: 12px 30px;
      border-radius: 6px;
      background-color: var(--text-marron);
      cursor: pointer;
    }

    .input-box .button:hover {
      background-color: var(--marron-clair);
      color: var(--text-marron);
    }

    .input-box .button:active {
      transform: translateY(-50%) scale(0.98);
    }

    /* Responsive */
    @media screen and (max-width: 500px) {
      .input-box {
        height: 66px;
        margin: 0 8px;
      }

      .input-box i {
        left: 12px;
        font-size: 25px;
      }

      .input-box input {
        padding: 0 112px 0 50px;
      }

      .input-box .button {
        right: 12px;
        font-size: 14px;
        padding: 8px 18px;
      }
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

  <div class="input-box">
    <i class="uil uil-search"></i>
    <form action="" method="GET">
      <style>
        input[type="text"]:focus {
          outline: none;
        }
      </style>
      <input style="padding: 26px ; margin-left:50px;width:850px;outline:none;" type="text" placeholder="Rechercher..." name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                                                                                        echo $_GET['search'];
                                                                                                                                                      } ?>" class="form-control" />
      <button class="button" type="submit">Rechercher</button>
    </form>
  </div>


  <!--ici affichage -->
  <div class="container">



    <table class="table table-hover text-center">
      <thead class="table">
        <tr>
          <th style="background:#773a00; color:#ffe8d4dd;" scope="col">Libellé</th>
          <th style="background:#773a00; color:#ffe8d4dd;" scope="col">Description</th>
          <th style="background:#773a00; color:#ffe8d4dd;" scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php


        if (isset($_GET['search'])) {
          $filtervalues = $_GET['search'];
          $query = "SELECT * FROM articles WHERE CONCAT(libelle,description) LIKE '%$filtervalues%' ";
          $query_run = mysqli_query($conn, $query);
          $query2 = "SELECT * FROM equipes WHERE CONCAT(libelle,description) LIKE '%$filtervalues%' ";
          $query_run2 = mysqli_query($conn, $query2);
          $query3 = "SELECT * FROM utilisateur WHERE CONCAT(nom,prenom,bio) LIKE '%$filtervalues%' ";
          $query_run3 = mysqli_query($conn, $query3);
          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $items) {
        ?>
              <tr>

                <td><?= $items['libelle']; ?></td>
                <td><?= $items['description']; ?></td>
                <td>
                  <a style="text-decoration:none; color:var(--text_marron);" <?php if ($items['nombre'] == 1 && $items['motif'] == 'Vente') { ?> href="details_art_vente_1.php?id=<?php echo $items['id']; ?>" <?php } elseif ($items['nombre'] > 1 && $items['motif'] == 'Vente') { ?> href="details_art_vente.php?id=<?php echo $items['id']; ?>" <?php } elseif ($items['nombre'] == 1 && $items['motif'] == 'Location') { ?> href="details_art_location_1.php?id=<?php echo $items['id']; ?>" <?php } elseif ($items['id_frs'] == $id_user) { ?> href="details_vente_perso.php?id=<?php echo $items['id']; ?>" <?php } else { ?> href="details_art_location.php?id=<?php echo $items['id']; ?>" <?php } ?>>
                    <i class="ri-eye-fill"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
          }
          if (mysqli_num_rows($query_run2) > 0) {
            foreach ($query_run2 as $items2) {
            ?>
              <tr>
                <td><?= $items2['libelle']; ?></td>
                <td><?= $items2['description']; ?></td>
                <td>
                  <a style="text-decoration:none; color:var(--text_marron);" <?php if ($items2['id_frs'] == $id_user) { ?> href="details_equipe_perso.php?id=<?php echo $items2['id']; ?>" <?php } else { ?> href="details_equipe.php?id=<?php echo $items2['id']; ?>" <?php } ?>>
                    <i class="ri-eye-fill"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
          }
          if (mysqli_num_rows($query_run3) > 0) {
            foreach ($query_run3 as $items3) {
            ?>
              <tr>
                <td><?= $items3['username']; ?></td>
                <td><?= $items3['bio']; ?></td>
                <td>
                  <a style="text-decoration:none; color:var(--text_marron);" <?php if ($items3['id_user'] == $id_user) { ?> href="profile.php?id=<?php echo $items3['id_user']; ?>" <?php } else { ?> href="profile_details.php?id=<?php echo $items3['id_user']; ?>" <?php } ?>>
                    <i class="ri-eye-fill"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
          } else if (mysqli_num_rows($query_run2) == 0 && mysqli_num_rows($query_run) == 0 && mysqli_num_rows($query_run3) == 0) {
            ?>
            <tr>
              <td colspan="3">
                <p style="color:var(--marron-int);margin:0 250px; text-align:center;">Aucun résultat pour cette recherche</p>
              </td>
            </tr>
        <?php
          }
        }
        ?>

      </tbody>
    </table>
  </div>





















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