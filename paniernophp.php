<?php
session_start();
if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
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
  <!--finlien css bootstrap-->

  <!--lien css vid yt-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <!--fi lien css vid yt-->

  <!--mes css-->
  <link rel="stylesheet" href="css/index.css" type="text/css">
  <link rel="stylesheet" href="css/panier.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <!--fin mes css-->

  <title>Panier</title>

  <script src="js/panier.js.js"></script>

  <!--style pour alligner les cartes-->

  <!--fin style pour alligner les cartes-->

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
              <?php if (isset($_SESSION["utilisateur"])) { ?>
                <!-- If user is logged in, display image -->
                <div class="profile-dropdown">
                  <div onclick="toggle()" class="profile-img" id="image-container">
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
                        <?php $username = $_SESSION["utilisateur"];
                        echo $username;
                        ?>
                      </a>
                    </li>

                    <li class="profile-dropdown-list-item">
                      <a href="#">
                        <i class="fa-regular fa-envelope"></i>
                        Inbox
                      </a>
                    </li>

                    <li class="profile-dropdown-list-item">
                      <a href="#">
                        <i class="fa-solid fa-chart-line"></i>
                        statistiques
                      </a>
                    </li>

                    <li class="profile-dropdown-list-item">
                      <a href="modifier-profile.php">
                        <i class="fa-solid fa-sliders"></i>
                        parametres
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
                        <?php if (isset($_SESSION["utilisateur"])) { ?>
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
  <!--section pour le titre-->
  <section id="blog-home" class=" container">
    <h2 class="font-weight-bold ">Votre Panier</h2>
    <hr>
  </section>
  <!--fin section pour le titre-->

  <!--section pour le tableau-->
  <section id="cart-container" class="container my-4">
    <table width="100%">
      <thead>
        <tr>

          <td>Image</td>
          <td>Produit</td>
          <td>Prix</td>
          <td>Qte</td>
          <td>Total</td>
          <td>Remove</td>
        </tr>
      </thead>

      <tbody>
        <!--premiere ligne-->
        <tr>

          <td>
            <img class="img-tab" src="images/Equipements/chairs1.jpg" width="70%" alt="placegolder">

          </td>
          <td>
            <h5>Chair</h5>
          </td>
          <td>
            <h5>65DT</h5>
          </td>
          <td>
            <input class="w-25 pl-1" value="1" type="number">
          </td>
          <td>
            <h5>130DT</h5>
          </td>
          <td>
            <a href="#">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
        <!--fin premiere ligne-->

        <!--deuxieme ligne-->
        <tr>

          <td>
            <img class="img-tab" src="images/Equipements/chairs2.jpg" width="70%" alt="placegolder">

          </td>
          <td>
            <h5>Chair</h5>
          </td>
          <td>
            <h5>75DT</h5>
          </td>
          <td>
            <input class="w-25 pl-1" value="1" type="number">
          </td>
          <td>
            <h5>130DT</h5>
          </td>
          <td>
            <a href="#">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
        <!--fin deuxieme ligne-->

        <!--troisieme ligne-->
        <tr>

          <td>
            <img class="img-tab" src="images/Equipements/chairs3.jpg" width="70%" alt="placegolder">

          </td>
          <td>
            <h5>Chair</h5>
          </td>
          <td>
            <h5>85DT</h5>
          </td>
          <td>
            <input class="w-25 pl-1" value="1" type="number">
          </td>
          <td>
            <h5>130DT</h5>
          </td>
          <td>
            <a href="#">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
        <!--fin troisieme ligne-->

      </tbody>
    </table>
  </section>
  <!--fin section pour le tableau-->


  <section id="cart-bottom" class="container">
    <div class="row">
      <div class="coupon col-lg-6 col-md-6 col-12 mb-4">

        <div>
          <h5>COUPON</h5>
          <p>Entrez votre code coupon si vous en avez</p>
          <input type="text" placeholder="Code Coupon">
          <button>Apply coupon</button>
        </div>

      </div>

      <div class="total col-lg-6 col-md-6 col-12">
        <div>
          <h5>TOTALE</h5>
          <div class="d-flex justify-content-between">
            <h6>Sous-total</h6>
            <p>350DT</p>
          </div>
          <div class="d-flex justify-content-between">
            <h6>Livraison</h6>
            <p>50DT</p>
          </div>
          <hr class="second-hr">
          <div class="d-flex justify-content-between">
            <h6>Totale</h6>
            <p>50DT</p>
          </div>
          <button class="ml-auto">Proceed to checkout</button>
        </div>
      </div>

    </div>
  </section>
  <!--section pour la partie du dessus-->

  <!--fin section pour la partie du dessus-->

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

  <!--bootstrap js links-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <!--bootstrap js links-->
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
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>

</body>

</html>