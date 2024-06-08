<?php
require 'config.php';
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
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
} else {
  $role = null;
}
$id_user = $_SESSION["id_user"];
$id_equipe = $_GET['id'];
$sql = "select * from `equipes` where id='$id_equipe'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$idfrs = $row["id_frs"];
$sql2 = "SELECT * FROM `candidatures` WHERE id_equipe = '$id_equipe' AND statut= 'acceptee';";
$res2 = $conn->query($sql2);
$sql3 = "select * from `utilisateur` where id_user='$idfrs'";
$res3 = $conn->query($sql3);
$row3 = mysqli_fetch_assoc($res3);
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
  <!--lien css vid yt-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <!--fi lien css vid yt-->

  <!--mes css-->
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="css/details_equipe.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <!--fin mes css-->

  <title><?php echo $row['libelle']; ?></title>

  <script src="js/detail-art.js"></script>

  <!--style pour alligner les cartes-->
  <style>
    /* Additional CSS for card height */

    :root {
      --bg-color: #fffbf7;
      --text-noir: black;
      --text-bleu: blue;
      --text-marron: #773a00;
      --marron-int: #351a02;
      --marron-clair: #ffe8d4dd;
      --footer-color: #999;
      --bronze: #977b3f;
      --white: #fff
    }

    .product {
      display: flex;
      align-items: stretch;
    }

    .product .card {
      width: 100%;
    }

    /* Equal height for card images */
    .card .card-img-top {
      height: 100px;
      /* Adjust the height as needed */
      object-fit: cover;
    }

    /* Align button and text on the same level */
    .card-body {
      display: flex;
      height: 80px;
      flex-direction: column;
      justify-content: flex-end;
      /* Change this line */
      height: 50%;
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

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <img src="images/upload/equipes/<?php echo $row['image']; ?>" width="350px" height="300px" alt="" />
        </div>

        <div class="col-md-7">
          <p class="equipe text-center">Equipe</p>
          <h2><?php echo $row['libelle']; ?></h2>
          <div class="star ">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>

          <p class="price"><?php echo $row['prix']; ?> DT</p>

          <p><b>Dirigeant:</b> <?php echo $row3['nom'] . " " . $row3['prenom']; ?></p>
          <p><b>Catégorie:</b> <?php echo $row['categorie']; ?></p>
          <p><b>Description:</b></p>
          <p><?php echo $row['description']; ?></p>



          <a href="modif_equipe.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;"><button class="buy-btn"><i class="ri-pencil-fill"></i> Modifier</button></a>
          <a href="delete_equipe.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;"><button class="buy-btn"><i class="ri-delete-bin-fill"></i> Supprimer</button></a>

        </div>

      </div>

    </div>
    </div>

  </section>


  <!--Personnels-->
  <section id="featured" class="my-5 pb-5">

    <div class="container text-center mt-5 pb-5">
      <hr class="mx-auto">
      <h3>Personnels:</h3>
      <hr class="mx-auto">
      <?php
      while ($row = mysqli_fetch_assoc($res2)) {
        $sql3 = "SELECT * FROM `utilisateur` WHERE id_user = '{$row['id_candidat']}'";
        $res3 = $conn->query($sql3);

        if ($res3->num_rows == 0) {
          echo '<div class="col-20" style="color:#351a02"><p>Pas de personnel disponible pour le moment.</p></div>';
        } else {
          while ($user_data = $res3->fetch_assoc()) { ?>
            <div class="row mx-auto container-fluid">

              <div class="product text-center col-lg-3 col-md-4 col-12">
                <div class="card">

                  <img class="card-img-top" src="<?php echo $user_data["pdp"]?>" alt="">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $user_data['nom'] . " " . $user_data['prenom'] ?></h5>
                    <div>
                      <a href="profile_details.php?id=<?php echo $row["id_candidat"]; ?>" style="text-decoration:none;"> <button>Détails</button></a>
                      <a href="retirer_cand.php?id_equipe=<?php echo $row["id_equipe"]; ?>&id_frs=<?php echo $row["id_frs"]; ?>&id_candidat=<?php echo $row["id_candidat"]; ?>" style="text-decoration:none;"> <button>Retirer</button></a>
                    </div>
                  </div>
                </div>
              </div>
        <?php  }
        }
      }
        ?>

        <!-- Repeat this structure for other products -->

            </div>
  </section>













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