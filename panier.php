<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'event_app_planner') or die('Connexion à la base de donnée impossible!');
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
} else {
  $role = null;
}
if (isset($_SESSION["pdp"])) {
  $pdp = $_SESSION["pdp"];
} else {
  $pdp = null;
}
// Retrieve user id from session if available
if (isset($_SESSION['id_user'])) {
  $userId = $_SESSION['id_user'];
} else {
  // Redirect or handle the case where user id is not available in session
  header("Location: login.php"); // Redirect to login page or handle the case appropriately
  exit(); // Make sure to exit after redirection
}

// Fetch articles from the database with user ID dynamically set
$articles = fetchArticles($conn, $userId);
$equipeArticles = fetchEquipeArticles($conn, $userId);

// Function to fetch articles from the database
function fetchArticles($conn, $userId)
{
  // Modify the SQL query to join the panier table
  $query = "SELECT a.id, a.libelle, a.prix, a.image1, a.motif, p.quantite, p.date_debut, p.date_fin, p.date_ajout FROM articles a ";
  $query .= "JOIN panier p ON a.id = p.id ";
  // Add a condition to filter articles based on the user's id and where id_event is 'none'
  $query .= "WHERE p.id_user = '$userId' AND p.id_event = '0'";

  $result = mysqli_query($conn, $query);

  // Check for errors
  if (!$result) {
    // Display the error message
    echo "Error: " . mysqli_error($conn);
    // Return an empty array to indicate no articles found
    return [];
  }

  $articles = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $articles[] = $row;
  }
  return $articles;
}

function fetchEquipeArticles($conn, $userId)
{
  $query = "SELECT p.id_equipe, p.quantite, p.date_debut, p.date_fin, p.date_ajout FROM panier p ";
  $query .= "WHERE p.id_user = '$userId' AND p.id_event = '0' AND p.id_equipe != '0'";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo "Error: " . mysqli_error($conn);
    return [];
  }

  $equipeArticles = [];
  while ($row = mysqli_fetch_assoc($result)) {
    // Fetch information from 'equipes' table based on id_equipe
    $equipeId = $row['id_equipe'];
    $equipeQuery = "SELECT id, libelle, prix, image, id_frs FROM equipes WHERE id = '$equipeId'";
    $equipeResult = mysqli_query($conn, $equipeQuery);
    if ($equipeRow = mysqli_fetch_assoc($equipeResult)) {
      // Combine information from 'panier' and 'equipes' tables
      $equipeArticles[] = [
        'id' => $equipeRow['id'],
        'libelle' => $equipeRow['libelle'],
        'prix' => $equipeRow['prix'],
        'image' => $equipeRow['image'],
        'id_frs' => $equipeRow['id_frs'],
        'quantite' => $row['quantite'],
        'date_debut' => $row['date_debut'],
        'date_fin' => $row['date_fin'],
        'date_ajout' => $row['date_ajout'] // Add date_ajout column
      ];
    }
  }
  return $equipeArticles;
}




// Function to calculate total price
function calculateTotal($price, $quantity)
{
  return $price * $quantity;
}

// Separate articles based on motif
$articlesLocation = [];
$articlesVente = [];
foreach ($articles as $article) {
  if ($article['motif'] === "Location") {
    $articlesLocation[] = $article;
  } else if ($article['motif'] === "Vente") {
    $articlesVente[] = $article;
  }
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

    .remove-button {
    background: none;
    color:none;
    border: none;
    cursor: pointer;
    padding: 0;
  }

  .remove-button i {
    color: red; /* Change color as needed */
    font-size: 20px; /* Adjust size as needed */
  }
  .remove-button:hover {
      transform: scale(1.2);
      color: none;
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

  <!--pour faire afficher le contenu de l array article-->
  <!--?php
  // Output the contents of $articles
  echo "<pre>";
  print_r($articles);
  echo "</pre>";
  ?-->
  <!--fin pour faire afficher le contenu de l array article-->

  <!--section pour le tableau pour vente-->
  <section id="blog-home" class=" container">
    <h2 class="font-weight-bold">Achats : </h2>
    <hr>
  </section>

  <section id="cart-container" class="container my-4">
    <table width="100%">
      <thead>
        <tr>
          <td>Image</td>
          <td>Produit</td>
          <td>Prix unitaire</td>
          <td>Qte</td>
          <td>Total</td>
          <td>Remove</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($articlesVente as $article) { ?>
          <tr>
            <td>
              <img class="img-tab" src="<?php echo $article['image1']; ?>" width="70%" alt="placegolder">
            </td>
            <td>
              <h5><?php echo $article['libelle']; ?></h5>
              <p style="margin-top: 5px;">REF: <?php echo $article['id']; ?></p>

            </td>
            <td>
              <h5><?php echo $article['prix']; ?> DT</h5>
            </td>
            <td>
              <input class="w-25 pl-1 quantity" value="<?php echo $article['quantite']; ?>" type="number" min="1" data-price="<?php echo $article['prix']; ?>">

            </td>
            <td>
              <h5 class="total"><?php echo calculateTotal($article['prix'], $article['quantite']); ?> DT</h5>
            </td>
            <td>
              <form action="remove_item_lv.php" method="POST" class="remove-form">
                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                <input type="hidden" name="date_ajout" value="<?php echo $article['date_ajout']; ?>">
                <button type="submit" class="remove-button">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <!--fin section pour le tableau pour vente-->

  <!--section pour le tableau pour location-->
  <section id="blog-home" class=" container">
    <h2 class="font-weight-bold">Location </h2>
    <hr>
  </section>

  <section id="cart-container" class="container my-4">
    <table width="100%">
      <thead>
        <tr>
          <td>Image</td>
          <td>Produit</td>
          <td>Prix</td>
          <td>Date</td>
          <td>Total</td>
          <td>Remove</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($articlesLocation as $article) { ?>
          <tr>
            <td>
              <img class="img-tab" src="<?php echo $article['image1']; ?>" width="70%" alt="placegolder">
            </td>
            <td>
              <h5><?php echo $article['libelle']; ?></h5>
              <p style="margin-top: 5px;">REF: <?php echo $article['id']; ?></p>
            </td>
            <td>
              <h5><?php echo $article['prix']; ?> DT</h5>
            </td>
            <td>
              <div class="d-flex flex-column">
                <input class="w-75 pl-1 date-input custom-input" value="<?php echo $article['date_debut']; ?>" type="date" data-price="<?php echo $article['prix']; ?>" placeholder="Date début">

                <input class="w-75 pl-1 date-input custom-input" value="<?php echo $article['date_fin']; ?>" type="date" data-price="<?php echo $article['prix']; ?>" placeholder="Date fin">
              </div>
            </td>
            <td>
              <h5 class="total"><?php echo calculateTotal($article['prix'], $article['quantite']); ?> DT</h5>
            </td>
            <td>
              <form action="remove_item_lv.php" method="POST" class="remove-form">
                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                <input type="hidden" name="date_ajout" value="<?php echo $article['date_ajout']; ?>">
                <button type="submit" class="remove-button">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </section>
  <!--fin section pour le tableau pour location-->

  <!--section pour le tableau pour equipe-->
  <section id="blog-home" class=" container">
    <h2 class="font-weight-bold">Equipe : </h2>
    <hr>
  </section>

  <section id="cart-container" class="container my-4">
    <table width="100%">
      <thead>
        <tr>
          <td>Image</td>
          <td>Equipe</td>
          <td>Chef</td>
          <td>Qte</td>
          <td>Prix</td>
          <td>Remove</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($equipeArticles as $equipe) { ?>
          <tr>
            <td>
              <img class="img-tab" src="<?php echo $equipe['image']; ?>" width="70%" alt="placegolder">
            </td>
            <td>
              <h5><?php echo $equipe['libelle']; ?></h5>
              <p style="margin-top: 5px;">REF: <?php echo $equipe['id']; ?></p>

            </td>
            <td>
              <!-- Fetch and display the concatenated full name -->
              <?php
              // Query to select and concatenate 'nom' and 'prenom' from 'utilisateur'
              $query = "SELECT CONCAT(nom, ' ', prenom) AS full_name FROM utilisateur WHERE id_user = '{$equipe['id_frs']}'";

              // Execute the query
              $result = mysqli_query($conn, $query);

              // Check for errors and fetch the result
              if ($result && $row = mysqli_fetch_assoc($result)) {
                // Display the concatenated full name
                echo "<h5>" . $row['full_name'] . "</h5>";
              } else {
                echo "<h5>Unknown</h5>"; // Display a default value if no result is found
              }
              ?>
            </td>
            <td>
              <div class="d-flex flex-column">
                <input class="w-75 pl-1 date-input custom-input" value="<?php echo $equipe['date_debut']; ?>" type="date" data-price="<?php echo $article['prix']; ?>" placeholder="Date début">

                <input class="w-75 pl-1 date-input custom-input" value="<?php echo $equipe['date_fin']; ?>" type="date" data-price="<?php echo $article['prix']; ?>" placeholder="Date fin">
              </div>
            </td>
            <td>
              <h5 class="total"><?php echo calculateTotal($equipe['prix'], 1); ?> DT</h5>
            </td>
            <td>
              <form action="remove_item_equipe.php" method="POST" class="remove-form">
                <input type="hidden" name="id_equipe" value="<?php echo $equipe['id']; ?>">
                <input type="hidden" name="date_ajout" value="<?php echo $equipe['date_ajout']; ?>">
                <button type="submit" class="remove-button">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>

          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <!--fin section pour le tableau pour equipe-->

  <!--php pour le calcul de total-->
  <?php
  // Initialize initial subtotal and total
  $initialSubtotal = 0;
  $initialTotal = 0;

  // Loop through the articlesVente array to calculate subtotal
  foreach ($articlesVente as $article) {
    $initialSubtotal += calculateTotal($article['prix'], $article['quantite']);
  }

  $equipeTotal = 0;
  foreach ($equipeArticles as $equipe) {
    $equipeTotal += calculateTotal($equipe['prix'], 1);
  }

  // Calculate total for Location section
  $locationTotal = 0;
  foreach ($articlesLocation as $article) {
    $locationTotal += calculateTotal($article['prix'], $article['quantite']);
  }

  // Add Equipe and Location totals to initial subtotal
  $initialSubtotal += $equipeTotal + $locationTotal;
  $initialTotal = $initialSubtotal + 50; // Assuming fixed shipping cost of 50 DT
  ?>
  <!--finphp pour le calcul de total-->


  <!--section pour le deuxieme tab-->
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
            <p id="subtotal"><?php echo $initialSubtotal; ?> DT</p>
          </div>
          <div class="d-flex justify-content-between">
            <h6>Livraison</h6>
            <p>50 DT</p>
          </div>
          <hr class="second-hr">
          <div class="d-flex justify-content-between">
            <h6>Totale</h6>
            <p id="total"><?php echo $initialTotal; ?> DT</p>
          </div>
          <button class="creerevenement ml-auto" id="createEventButton">Créer l'événement</button>

        </div>
      </div>
    </div>
  </section>

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

  <!-- Scripts -->
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

  <script>
    // Update total price when quantity changes
    document.querySelectorAll('.quantity').forEach(item => {
      item.addEventListener('change', event => {
        const price = parseFloat(item.getAttribute('data-price'));
        const quantity = parseInt(item.value);
        const totalElement = item.parentNode.parentNode.querySelector('.total');
        const subtotalElement = document.getElementById('subtotal');
        const totalElementGlobal = document.getElementById('total');

        // Calculate total for this item
        totalElement.textContent = (price * quantity) + ' DT';

        // Recalculate subtotal
        let subtotal = 0;
        document.querySelectorAll('.quantity').forEach(item => {
          const price = parseFloat(item.getAttribute('data-price'));
          const quantity = parseInt(item.value);
          subtotal += price * quantity;
        });
        subtotalElement.textContent = subtotal + ' DT';

        // Recalculate total with shipping
        const shipping = 50; // Assuming fixed shipping cost
        const total = subtotal + shipping;
        totalElementGlobal.textContent = total + ' DT';
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Get the button element
      var createEventButton = document.getElementById('createEventButton');

      // Add click event listener to the button
      createEventButton.addEventListener('click', function() {
        // Redirect to event_creation.php
        window.location.href = 'event_creation.php';
      });
    });
  </script>

  <!--script pour suppression d'element de la table panier vente-->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add click event listener to all elements with class "remove-item"
      var removeButtons = document.querySelectorAll('.remove-item-vente');
      removeButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
          event.preventDefault(); // Prevent default link behavior

          // Extract article id and date ajout from button id
          var idAndDate = button.id.split('_');
          var articleId = idAndDate[0];
          var dateAjout = idAndDate[1];

          // AJAX request to remove item from the database
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'remove_item_vente.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              // Remove row from table if removal was successful
              var row = button.closest('tr');
              row.parentNode.removeChild(row);
            } else {
              console.error('Error: ' + xhr.responseText);
            }
          };
          xhr.onerror = function() {
            console.error('Request failed');
          };
          xhr.send('id=' + articleId + '&date_ajout=' + dateAjout);
        });
      });
    });
  </script>
  <!--finscript pour suppression d'element de la table panier vente-->

</body>

</html>