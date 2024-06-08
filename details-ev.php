<?php
session_start();

// Check if id_event is set in the URL parameter
if(isset($_GET['id_event'])) {
  $id_event = $_GET['id_event'];
} else {
  $id_event = '6636905420e'; // Default id_event value if not provided in the URL
}
// connexion bd
$conn = mysqli_connect('localhost', 'root', '', 'event_app_planner') or die('Connexion à la base de données impossible!');

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



// fonction pour creer un tableau de tableau contenant les donnes sur les articles
function fetchArt($conn, $id_event)
{
  // Prepare SQL statement
  $stmt = $conn->prepare("SELECT id FROM panier WHERE id_event=? AND id!='0'");
  $stmt->bind_param("s", $id_event);
  $stmt->execute();
  $result = $stmt->get_result();

  $article_ids = array();
  while ($row = $result->fetch_assoc()) {
    $article_ids[] = $row['id'];
  }

  // Close statement
  $stmt->close();

  // Fetch row values from 'articles' table for each article id
  $articles = array();
  foreach ($article_ids as $article_id) {
    $stmt = $conn->prepare("SELECT id, libelle, description, prix, image1, categorie, motif,nombre FROM articles WHERE id=?");
    $stmt->bind_param("s", $article_id);
    $stmt->execute();
    $article_result = $stmt->get_result()->fetch_assoc();
    $article_result['stars'] = generateRandomStars(); // Add stars to the article result
    $articles[] = $article_result;
    $stmt->close();
  }

  return $articles;
}
//fin fonction pour creer un tableau de tableau contenant les donnes sur les articles

// fonction pour generer un nombre aleatoire entre 1 et 5 pour les etoiles des articles/equipes
function generateRandomStars()
{
  $num_stars = rand(1, 5); // Generate random number of stars between 1 and 5
  $stars = '';
  for ($i = 0; $i < $num_stars; $i++) {
    $stars .= '<i class="fas fa-star"></i>'; // Append star icons
  }
  return $stars;
}
//fin fonction pour generer un nombre aleatoire entre 1 et 5 pour les etoiles des articles/equipes

// fonction pour creer un tableau de tableau contenant les donnes sur les equipes
function fetchEquipe($conn, $id_event)
{
  // Prepare SQL statement to fetch equipe ids
  $stmt = $conn->prepare("SELECT id_equipe FROM panier WHERE id_event=? AND id_equipe!='0'");
  $stmt->bind_param("s", $id_event);
  $stmt->execute();
  $result = $stmt->get_result();

  $equipe_ids = array();
  while ($row = $result->fetch_assoc()) {
    $equipe_ids[] = $row['id_equipe'];
  }

  // Close statement
  $stmt->close();

  // Fetch row values from 'equipe' table for each equipe id
  $equipes = array();
  foreach ($equipe_ids as $equipe_id) {
    $stmt = $conn->prepare("SELECT id, libelle, prix, image, categorie FROM equipes WHERE id=?");
    $stmt->bind_param("s", $equipe_id);
    $stmt->execute();
    $equipe_result = $stmt->get_result()->fetch_assoc();
    $equipe_result['stars'] = generateRandomStars();
    $equipes[] = $equipe_result;
    $stmt->close();
  }

  return $equipes;
}
//fin fonction pour creer un tableau de tableau contenant les donnes sur les equipes

// fonction pour extraire les donnees d'un evenement dans un tableau
function fetchdetailsevent($conn, $id_event)
{
  // Prepare SQL statement
  $stmt = $conn->prepare("SELECT * FROM evenement WHERE id_event=?");
  $stmt->bind_param("s", $id_event);
  $stmt->execute();
  $result = $stmt->get_result();

  $detailsevent = $result->fetch_assoc();

  // Close statement
  $stmt->close();

  return $detailsevent;
}
//fin fonction pour extraire les donnees d'un evenement dans un tableau

// Fetch articles for the specified event
$articles = fetchArt($conn, $id_event);

// Fetch equipes for the specified event
$equipes = fetchEquipe($conn, $id_event);

// Fetch event details
$detailsevent = fetchdetailsevent($conn, $id_event);

// Close connection
mysqli_close($conn);
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
  <link rel="stylesheet" href="css/details-ev.css" type="text/css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <!--fin mes css-->

  <title>Details Evenements</title>
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

  <!--partie pour pic evenement-->
  <section class="container sproduct">

    <div class="row mt-5 d-flex align-items-center">

      <!--partie des image (partie gauche)-->

      <div class="col-lg-5 col-md-12 col-12 ">
        <!--carrousel verticale pour grande image-->
        <div class="carou-container mb-5 ">
          <div class="carou-inner ">
            <div class="carou-item "><img src="images/esppaces/sallerihab.jpg" alt="placeholder"></div>
            <div class="carou-item"><img src="images/esppaces/parcflorale.jpg" alt="placeholder"></div>
            <div class="carou-item"><img src="images/esppaces/hotel_byzacene_sbeitla_9.jpg__769x462_q85_crop-smart_subsampling-2.jpg" alt="placeholder"></div>
          </div>
          <div class="carou-indicators">
            <span class="carou-indicator active" onclick="goToSlide(0)"></span>
            <span class="carou-indicator" onclick="goToSlide(1)"></span>
            <span class="carou-indicator" onclick="goToSlide(2)"></span>
          </div>
        </div>
        <!--carrousel verticale pour grande image-->
      </div>
      <!--fin partie des image-->

      <!--(right div) partie ecriture etc-->
      <div class="col-lg-6 col-md-12 col-12 ecriture">
        <h6 class="pt-4">Profil/Vos Evenements</h6>
        <hr>
        <h3><?php echo $detailsevent['Nom']; ?></h3>
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>

        <span>
          <p class="pt-4"><?php echo $detailsevent['Description']; ?></p>
        </span>

      </div>
      <!-- fin partie ecriture etc-->
    </div>

  </section>
  <!--fin partie pour pic evenement-->

  <hr class="separateur2">

  <!--section pour les articles-->
  <section id="fournisseur">

    <div class="container text-center">
      <h3>Services fournis</h3>
      <p>Ici vous trouvez les services utilisés pour cet evenement</p>
    </div>

    <div class="row mx-auto container-fluid">
      <?php foreach ($articles as $article) { ?>
        <div class="produit text-center col-lg-3 col-md-4 col-12">
          <img class="img-fluid mb-3" src="<?php echo $article['image1']; ?>" alt="placegolder">
          <div class="star ">
            <?php echo $article['stars']; ?>
          </div>
          <h5 class="p-name"><?php echo $article['libelle']; ?></h5>
          <button class="voir-plus" onclick="redirectToDetails('<?php echo $article['id']; ?>', '<?php echo $article['motif']; ?>', <?php echo $article['nombre']; ?>)">Voir Plus</button>
        </div>
      <?php } ?>

    </div>
  </section>
  <!--section pour les articles-->

  <hr class="separateur2">

  <!--section pour les equipes-->
  <section id="fournisseur">

    <div class="container text-center">
      <h3>Equipes</h3>
      <p>Ici vous trouvez les equipes utilisés pour cet evenement</p>
    </div>

    <div class="row mx-auto container-fluid">
      <?php foreach ($equipes as $equipe) { ?>
        <div class="produit text-center col-lg-3 col-md-4 col-12">
          <img class="img-fluid mb-3" src="<?php echo $equipe['image']; ?>" alt="placegolder">
          <div class="star ">
            <?php echo $equipe['stars']; ?>
          </div>
          <h5 class="p-name"><?php echo $equipe['libelle']; ?></h5>
          <button class="voir-plus" onclick="window.location.href = 'details_equipe.php?id=<?php echo $equipe['id']; ?>'">Voir Plus</button>
        </div>
      <?php } ?>

    </div>
  </section>
  <!--section pour les equipes-->

  <hr class="separateur2">

  <!--section pour la baniere de promo-->
  <section id="banner" class="col-lg-12 col-md-6 col-12">
    <div class="container col-lg-12 col-md-6 col-12">
      <h4>Venue SALE</h4>
      <h1>Autumn Edition<br>UP TO 20% OFF</h1>
      <hr>
      <button class="text-uppercase">Check Now</button>
      <!--img src="images/esppaces/2.jpg" alt="Image" class="banner-image img-fluid col-lg-12 col-md-6 col-12"-->
      <iframe class="banner-image" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3195.418791762387!2d10.175925675578918!3d36.784508172251606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd340576fc1a05%3A0x25fc1aa869f8cfb6!2s%C3%89cole%20nationale%20sup%C3%A9rieure%20d&#39;ing%C3%A9nieurs%20de%20Tunis%20(ENSIT)!5e0!3m2!1sen!2stn!4v1695837976536!5m2!1sen!2stn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
  </section>
  <!--fin section pour la baniere de promo-->

  <!--section pour le titre sponsors-->
  <section id="baniere-titre" class="container">
    <hr class="m-3 separateur">
    <h2 class="ecriture font-weight-bold pr-5">VOS SPONSORS</h2>
    <hr class="m-3 separateur">
  </section>
  <!--fin section pour le titre sponsors-->

  <!--baniere pour sponsor-->
  <section id="sponsor m-5 p-5" class="container">
    <div class="row py-3">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/1.png" alt="placeholder">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/2.png" alt="placeholder">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/3.png" alt="placeholder">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/4.png" alt="placeholder">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/5.png" alt="placeholder">
      <img class="img-fluid col-lg-2 col-md-4 col-6 p-5" src="images/brand/6.png" alt="placeholder">
    </div>
  </section>
  <!--fin baniere pour sponsor-->

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

  <!--script pour caroussel verticale-->
  <script src="js/details-ev.js"></script>
  <!--fin script pour caroussel verticale-->

  <script src="js/dropdown.js"></script>

  <!--script pour hover effect pour les images-->
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
  <!--script pour hover effect pour les images-->


  <!--bootstrap js links-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <!--bootstrap js links-->
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>

  <!--script pour choisir l'url de renvoi pour le boutton voir plus en services-->
  <script>
    function redirectToDetails(id, motif, nombre) {
      var url;

      // Check conditions and set the URL accordingly
      if (motif === 'Location' && nombre === 1) {
        url = 'details_art_location_1.php?id=' + id;
      } else if (motif === 'Location' && nombre > 1) {
        url = 'details_art_location.php?id=' + id;
      } else if (motif === 'Vente' && nombre === 1) {
        url = 'details_art_vente_1.php?id=' + id;
      } else if (motif === 'Vente' && nombre > 1) {
        url = 'details_art_vente.php?id=' + id;
      }

      // Redirect to the generated URL
      window.location.href = url;
    }
  </script>
  <!--fin script pour choisir l'url de renvoi pour le boutton voir plus en services-->

</body>

</html>