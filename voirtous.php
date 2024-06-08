<?php
require_once 'config.php';
session_start();
if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}
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
if (isset($_SESSION["id_user"])) {
  $id_user = $_SESSION["id_user"];
} else {
  $id_user = null;
}

$sql = "select * from `articles` where id_frs!= '$id_user' ";
$all_article = $conn->query($sql);
$sql2 = "select * from `equipes` where id_frs!= '$id_user'";
$all_equipes = $conn->query($sql2);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="stylesheet" href="css/dropdown.css" type="text/css">
    <link rel="stylesheet" href="css/voirtous.css" type="text/css">
    <title>Voir Tous</title>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="js/Button-scroller.js"></script>
  <script defer src="js/fadein.js"></script>
  <script src="js/linkwithjs.js"></script>
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>

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

<div class="container-all">
<div class="container" style="margin-bottom:2rem;">
            <nav>
<style>
  .card {
    padding: 0;
    margin: 1rem;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    text-align: center;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
  }

  .card img {
    height: 200px; /* Adjust this value as needed */
    object-fit: cover;
    border-radius: 10px 10px 0 0;
  }

  .card-body {
    padding: 1rem;
  }

  .title {
    font-weight: bold;
    margin-bottom: 0.5rem;
  }

  /* Adjust colors as needed */
  .nav-link.active {
    color: #ffffff !important;
    background-color: #773a00 !important;
    border-color: #773a00 !important;
  }

  .nav-link {
    color: #773a00;
    border-color: #773a00;
  }

  .nav-link:hover {
    color: #ffffff;
    background-color: #773a00;
    border-color: #773a00;
  }

  /* Cursor pointer */
  .card:hover {
    cursor: pointer;
  }


                </style>
            <div class="nav nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-equipement" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Equippement</button>
                <button class="nav-link" id="nav-Personnel-tab" data-bs-toggle="tab" data-bs-target="#nav-Personnel" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Personnel</button>
                <button class="nav-link" id="nav-espace-tab" data-bs-toggle="tab" data-bs-target="#nav-espace" type="button" role="tab" aria-controls="nav-espace" aria-selected="false">Espace</button>
                <button class="nav-link" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service" aria-selected="false">Service</button>
                <button class="nav-link" id="nav-formation-tab" data-bs-toggle="tab" data-bs-target="#nav-formation" type="button" role="tab" aria-controls="nav-formation" aria-selected="false">Formation</button>
                <button class="nav-link" id="nav-meuble-tab" data-bs-toggle="tab" data-bs-target="#nav-meuble" type="button" role="tab" aria-controls="nav-meuble" aria-selected="false">Meubles</button>
                <button class="nav-link" id="nav-autre-tab" data-bs-toggle="tab" data-bs-target="#nav-autre" type="button" role="tab" aria-controls="nav-autre" aria-selected="false">Autre</button>
               
            </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-equipement" role="tabpanel" aria-labelledby="nav-equipement-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php
        while ($row = mysqli_fetch_assoc($all_article)) {
          if ($row['categorie'] == 'Equipement') {



            ?>
            <div class="col">
            <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

              ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
            } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
              ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
            } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
            } ?>>
              <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="">
              <div class="card-body">
              <p class="title"><?php echo $row['libelle']; ?></p>
              <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
              </div>
            </div>
            </div>
          <?php }
        }
        mysqli_data_seek($all_article, 0); ?>
                    </div>
            </div>
            <div class="tab-pane fade " id="nav-Personnel" role="tabpanel" aria-labelledby="nav-Personnel-tab" tabindex="0">
                 <div class="row row-cols-1 row-cols-md-5 g-4">
                                              <style>
                                .badge-container {
            position: absolute;
            top: 10px; 
            right: 10px; 
            width: 50px;
            height: 50px; 
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            z-index: 999; 
        }

        .badge-container img {
            max-width: 80%; 
            max-height: 80%;
        }
                                </style>
                                    <?php
                            while ($row2 = mysqli_fetch_assoc($all_equipes)) {
                              $idfrs = $row2['id_frs'];
                              $sql0="select * from `utilisateur` where id_user = '$idfrs' ";
                              $all_users=$conn->query($sql0);
                              $row0 = mysqli_fetch_assoc($all_users);
                            ?>
                            <div class="col">
                                <div class="card h-100"  onclick="window.location.href='details_equipe.php?id=<?php echo $row2['id']; ?>';">
                                <img src="images/upload/equipes/<?php echo $row2['image']; ?>" class="card-img-top" alt="">
                                                    <?php
                                      if($row0["role"] == "admin") {
                                          echo '
                                          <div class="badge-container">
                                  <img src="images/badge.png" />
                                </div>
                                          ';
                                      }
                                    ?>
                                <div class="card-body">
                                <p class="title"><?php echo $row2['libelle']; ?></p>
                                <p class="title"><?php echo $row2['prix'] . " DT"; ?></p>
                                </div>
                                </div>
                            </div>
                            <?php }
                            mysqli_data_seek($all_equipes, 0); ?>
                             <?php
                            while ($row2 = mysqli_fetch_assoc($all_equipes)) {
                            ?>
                            <div class="col">
                                <div class="card h-100"  onclick="window.location.href='details_equipe.php?id=<?php echo $row2['id']; ?>';">
                                <img src="images/upload/equipes/<?php echo $row2['image']; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                <p class="title"><?php echo $row2['libelle']; ?></p>
                                <p class="title"><?php echo $row2['prix'] . " DT"; ?></p>
                                </div>
                                </div>
                            </div>
                            <?php }
                            mysqli_data_seek($all_equipes, 0); ?>
                             <?php
                            while ($row2 = mysqli_fetch_assoc($all_equipes)) {
                            ?>
                            <div class="col">
                                <div class="card h-100"  onclick="window.location.href='details_equipe.php?id=<?php echo $row2['id']; ?>';">
                                <img src="images/upload/equipes/<?php echo $row2['image']; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                <p class="title"><?php echo $row2['libelle']; ?></p>
                                <p class="title"><?php echo $row2['prix'] . " DT"; ?></p>
                                </div>
                                </div>
                            </div>
                            <?php }
                            mysqli_data_seek($all_equipes, 0); ?>
                             <?php
                            while ($row2 = mysqli_fetch_assoc($all_equipes)) {
                            ?>
                            <div class="col">
                                <div class="card h-100"  onclick="window.location.href='details_equipe.php?id=<?php echo $row2['id']; ?>';">
                                <img src="images/upload/equipes/<?php echo $row2['image']; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                <p class="title"><?php echo $row2['libelle']; ?></p>
                                <p class="title"><?php echo $row2['prix'] . " DT"; ?></p>
                                </div>
                                </div>
                            </div>
                            <?php }
                            mysqli_data_seek($all_equipes, 0); ?>
                    </div>
            </div>
            <div class="tab-pane fade" id="nav-espace" role="tabpanel" aria-labelledby="nav-espace-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                        <?php
                    while ($row = mysqli_fetch_assoc($all_article)) {
                    if ($row['categorie'] == 'Espace') {



                        ?>
                        <div class="col">
                        <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

                            ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
                            } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
                            ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
                            } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
                            } ?>>
                            <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="chaises">
                        <div class="card-body">
                        <p class="title"><?php echo $row['libelle']; ?></p>
                        <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
                        </div>
                        </div>
                        </div>
                    <?php }
                    }
                    mysqli_data_seek($all_article, 0); ?>
                                </div>
            </div>
            <div class="tab-pane fade" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                        <?php
                    while ($row = mysqli_fetch_assoc($all_article)) {
                    if ($row['categorie'] == 'Service') {



                        ?>
                        <div class="col">
                        <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

                        ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
                        } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
                        ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
                        } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
                        } ?>>
                        <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="chaises">
                        <div class="card-body">
                        <p class="title"><?php echo $row['libelle']; ?></p>
                        <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
                        </div>
                        </div>
                        </div>
                    <?php }
                    }
                    mysqli_data_seek($all_article, 0); ?>
                                </div>
            </div>
            <div class="tab-pane fade" id="nav-formation" role="tabpanel" aria-labelledby="nav-formation-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                        <?php
                    while ($row = mysqli_fetch_assoc($all_article)) {
                    if ($row['categorie'] == 'Formation') {



                        ?>
                        <div class="col">
                        <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

                        ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
                        } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
                        ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
                        } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
                        } ?>>
                        <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="chaises">
                        <div class="card-body">
                        <p class="title"><?php echo $row['libelle']; ?></p>
                        <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
                        </div>
                        </div>
                        </div>
                    <?php }
                    }
                    mysqli_data_seek($all_article, 0); ?>
                                </div>
            </div>
            <div class="tab-pane fade" id="nav-meuble" role="tabpanel" aria-labelledby="nav-meuble-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                        <?php
                    while ($row = mysqli_fetch_assoc($all_article)) {
                    if ($row['categorie'] == 'Meuble') {



                        ?>
                        <div class="col">
                        <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

                        ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
                        } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
                        ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
                        } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
                        } ?>>
                        <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="chaises">
                        <div class="card-body">
                        <p class="title"><?php echo $row['libelle']; ?></p>
                        <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
                        </div>
                        </div>
                        </div>
                    <?php }
                    }
                    mysqli_data_seek($all_article, 0); ?>
                                </div>
            </div>
            <div class="tab-pane fade" id="nav-autre" role="tabpanel" aria-labelledby="nav-autre-tab" tabindex="0">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                        <?php
                    while ($row = mysqli_fetch_assoc($all_article)) {
                    if ($row['categorie'] == 'Autres') {



                        ?>
                        <div class="col">
                        <div class="card h-100" <?php if ($row['nombre'] == 1 && $row['motif'] == 'Vente') { ?>onclick="window.location.href='details_art_vente_1.php?id=<?php echo $row['id']; ?>';" <?php } elseif (($row['nombre'] > 1 && $row['motif'] == 'Vente')) {

                        ?> onclick="window.location.href='details_art_vente.php?id=<?php echo $row['id']; ?>';" <?php
                        } elseif (($row['nombre'] == 1 && $row['motif'] == 'Location')) {
                        ?> onclick="window.location.href='details_art_location_1.php?id=<?php echo $row['id']; ?>';" <?php
                        } else { ?> onclick="window.location.href='details_art_location.php?id=<?php echo $row['id']; ?>';" <?php
                        } ?>>
                        <img src="images/upload/articles/<?php echo $row['image1']; ?>" alt="chaises">
                        <div class="card-body">
                        <p class="title"><?php echo $row['libelle']; ?></p>
                        <p class="title"><?php echo $row['prix'] . " DT"; ?></p>
                        </div>
                        </div>
                        </div>
                    <?php }
                    }
                    mysqli_data_seek($all_article, 0); ?>
                                </div>
            </div>
            </div>
</div>
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
          <p style="font-family:'Times New Roman', Times, serif;"> Nadhamly est un projet crée afin de faciliter
            l'organisation des évènements il offre une plateforme unique, rapide et facile à utiliser aux utilisateurs
            qui aspirent à planifier tous les aspects de leurs propres évènements en une seule place et même aux
            fournisseurs qui cherchent une vitrine pour présenter leurs services et produits. Ceci permettra aux
            utilisateurs de maximiser leur gain de temps et profiter pleinement de chaque moment spécial.
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
            <li align="left">&#128205; <a href="https://maps.app.goo.gl/zLKkJNBrgjAyrBT1A">5, avenue Taha Hussein
                Montfleury,<br /> 1008 Tunis</a></li>
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
    document.addEventListener("DOMContentLoaded", function () {
      var imageContainer = document.getElementById('image-container');
      var profileImage = document.getElementById('profile-image');

      // Add event listener for hover effect
      imageContainer.addEventListener('mouseover', function () {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1.1)';
        imageContainer.style.cursor = 'pointer';
      });

      // Add event listener to reset when mouse leaves
      imageContainer.addEventListener('mouseout', function () {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1)';
      });
    });
  </script>
</body>
</html>