<?php
session_start();
require_once "config.php"; // Include your database configuration file
// Generate a random and unique varchar(11) id
$id_event = uniqid();
if (isset($_POST["submit"])) {
    if ($_POST["submit"] === "Creer") {
        // Handle event creation
        $nom = $_POST["nom"];
        $description = $_POST["description"];
        $date_debut = $_POST["deb"];
        $date_fin = $_POST["fin"];
        $id_utilisateur = $_SESSION['id_user']; // Assuming you have a session variable for user ID
        
        
        
        // Insert event into the database
        $sql = "INSERT INTO evenement (id_event, id_utilisateur, Nom, description, date_debut, date_fin) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissss", $id_event, $id_utilisateur, $nom, $description, $date_debut, $date_fin);
        $stmt->execute();

        // Update "panier" table to add the event for the logged-in user
        $sql = "UPDATE panier SET id_event = ? WHERE id_user = ? AND id_event='0'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $id_event, $id_utilisateur);
        $stmt->execute();

        // Optionally, you can redirect the user to another page after event creation
        header("Location: panier.php");
        exit;
    } elseif ($_POST["submit"] === "Annuler") {
        // Handle cancel action
        $id_event = $_POST["id_event"];
        $id_utilisateur = $_SESSION['id_user']; // Assuming you have a session variable for user ID

        // Update "panier" table to remove the event
        $sql = "UPDATE panier SET id_event = NULL WHERE id_event = ? AND id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $id_event, $id_utilisateur);
        $stmt->execute();

        // Optionally, you can redirect the user to another page after cancel action
        header("Location: index.php");
        exit;
    }
}

// Fetch user profile picture if available
$pdp = isset($_SESSION["pdp"]) ? $_SESSION["pdp"] : null;
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
    <link rel="stylesheet" href="css/ajout_article.css" type="text/css">


    <title>Creer Evenement</title>

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

    <!--section pour form-->
    <section class="container">
        <header>Details Evenement</header>
        <p>Veuillez fournir les informations sur votre evenment via ce formulaire!</p>
        <form action="#" class="form" method="post" enctype="multipart/form-data">
            <div class="input-box">
                <label>Nom</label>
                <input type="text" placeholder="Entrer le nom de votre evenement" name="nom" />
            </div>

            <div class="input-box">
                <label>Description</label>
                <input type="text" placeholder="Entrer la description de votre evenement" name="description" />
            </div>

            <div class="input-box">
                <label>Date du debut de votre evenement</label>
                <input class="date_debut" type="date" style="width: 120px;" name="deb" />
            </div>

            <div class="input-box">
                <label>Date fin de votre evenement</label>
                <input class="date_fin" type="date" style="width: 120px;" name="fin" />
            </div>

            <input type="submit" class="button" name="submit" value="Creer" />
            <!-- Add a hidden input field to store the event ID for cancel action -->
            <!--input type="hidden" name="id_event" value="<?php echo $event_id; ?>" /-->
            <input type="submit" class="button" name="submit" value="Annuler" />
        </form>
    </section>
    </br></br></br></br>
    <!--fin section pour form-->


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


</body>

</html>