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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/dropdown.css" type="text/css">
  <link rel="stylesheet" href="css/modifier-profile.css" type="text/css">
  <title><?php echo $_SESSION["utilisateur"] ?></title>
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
  <style>
    .bg {
      background: url(images/bgmod.jpg);
      min-height: 100vh;
      overflow-x: hidden;
      object-fit: cover;
      background-blend-mode: multiply;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .fbtn-active {
      background-color: #773a00 !important;
      color: white !important;
    }
  </style>
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
  <style>
    /* Ensure the image inside the modal fits properly */
    .modal-body img {
      max-width: 100%;
      height: auto;
    }
  </style>
  <div class="modal fade" id="profile-picture-container" tabindex="-1" aria-labelledby="photo-de-profil" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" style="color:#773a00;font-size:25px;">Photo de profil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="<?php echo $pdp; ?>" class="img-fluid" alt="Profile Picture">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-annuler" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-affirmer" data-bs-target="#edit-profile-form-container" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close">Modifier la photo</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit-profile-form-container" tabindex="-1" aria-labelledby="photo-de-profil" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" style="color:#773a00;font-size:25px;">Photo de profil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="modifier-profile.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit2">
          </form>
          <?php
          $id = $_SESSION["id_user"];

          if (isset($_POST["submit2"])) {
            $target_dir = "images/profile/";
            $target_file = $target_dir . $id . ".jpg"; // renommer le fichier
            $uploadOk = 1; // verificion

            // verifier si le fichier est un image a travers le contenu pas l'extension
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }

            // Si le fichier existe déja on le supprime
            if (file_exists($target_file)) {
              unlink($target_file);
            }

            if ($uploadOk == 0) {
              echo "Error uploading the file.";
            } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                require_once 'database.php';
                $sql = "UPDATE utilisateur SET pdp = '$target_file' WHERE id_user = '$id'";

                if (mysqli_query($conn, $sql)) {
                  $_SESSION["pdp"] = $target_file;
                  echo "Profile picture updated successfully.";
                } else {
                  echo "Error updating profile picture: " . mysqli_error($conn);
                }

                mysqli_close($conn);
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-annuler" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>



  <div class="bg" style="overflow:hidden;">

    <div class="container">
      <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
          <div class="card h-100" style="background-color: rgba(255, 255, 255, 0.95);">
            <div class="card-body " style="padding:0;padding-top:2rem;">
              <div class="account-settings">
                <div class="user-profile">
                  <style>
                    .avatar-dropdown {
                      position: relative;
                    }

                    .avatar-dropdown .avatar-dropdown-list {
                      display: none;
                      position: absolute;
                      top: 100%;
                      width: 300px;
                      right: 0;
                      background-color: #fff;
                      border: 1px solid #ccc;
                      border-radius: 4px;
                      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                      z-index: 100;
                    }

                    .avatar-dropdown .avatar-dropdown-list.active {
                      display: block;
                    }

                    .avatar-dropdown-list-item {
                      padding: 0.5rem 0rem 0.5rem 1rem;
                      transition: background-color 0.2s ease-in, padding-left 0.2s;
                    }

                    .avatar-dropdown-list-item a {
                      display: flex;
                      align-items: center;
                      text-decoration: none;
                      font-size: 0.9rem;
                      font-weight: 500;
                      color: var(--black);
                    }

                    .avatar-dropdown-list-item a i {
                      margin-right: 0.8rem;
                      font-size: 1.1rem;
                      width: 2.3rem;
                      height: 2.3rem;
                      background-color: var(--secondary);
                      color: var(--white);
                      line-height: 2.3rem;
                      text-align: center;
                      margin-right: 1rem;
                      border-radius: 50%;
                      transition: margin-right 0.3s;
                    }

                    .avatar-dropdown-list-item:hover {
                      padding-left: 1.5rem;
                      background-color: var(--secondary-light);
                    }
                  </style>
                  <div class="avatar-dropdown">
                    <div onclick="toggleDropdown()" class="user-avatar avatar-dropdown-btn" id="user-avatar">
                      <?php if (!empty($pdp)) { ?>
                        <img src="<?php echo $pdp; ?>" alt="" width="150px" class="profile-picture" id="profile-picture">
                      <?php } else { ?>
                        <img src="images/defaultpdp.jpg" alt="" width="150px" height="150px" class="profile-picture" id="profile-picture">
                      <?php } ?>
                    </div>
                    <ul class="avatar-dropdown-list" id="avatar-dropdown-list" style="list-style-type: none;padding:0;">
                      <li class="avatar-dropdown-list-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#profile-picture-container">
                          <i class="fa-regular fa-image"></i>
                          Voir la photo de profil
                        </a>
                      </li>

                      <li class="avatar-dropdown-list-item">
                        <a href="#" data-bs-target="#edit-profile-form-container" data-bs-toggle="modal">
                          <i class="fa-regular fa-images"></i>
                          Modifier la photo de profil
                        </a>
                      </li>
                    </ul>
                  </div>
                  <h5 class="user-name" style="font-size:1.6rem;color:#773a00;"><?php echo $_SESSION["utilisateur"] ?></h5>
                  <h6 class="user-email" style="font-size:1.2rem;"><?php echo $_SESSION["mail"] ?></h6>
                </div>

              </div>
              <div class="flush">
                <ul class="list-group list-group-flush" style="margin-bottom:2.2rem;">
                  <li class="list-group-item flush-btn" id="btn1" style="background-color: rgba(255, 255, 255, 0.95);">Informations Générales</li>
                  <li class="list-group-item flush-btn" id="btn2" style="background-color: rgba(255, 255, 255, 0.95);">Mot de passe</li>
                </ul>
              </div>
              <div class="text-center mb-3">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#suppression">Supprimer le profil</button>
    </div>
            </div>
          </div>
        </div>
        <div class="box col-xl-9 col-lg-9 col-md-12 col-sm-12 ">
          <div class="card h-100" style="background-color: rgba(255, 255, 255, 0.95);">
            <div class="card-body">
              <div class="informations" id="liste-inf">
                <div class="row gutters">
                  <div class="col">
                    <h6 class="mb-2 " style="color:#773a00;font-size:27px;">Détails personnels : </h6>
                  </div>
                </div>
                <div class="row gutters" style="color:#773a00;">
                  <div class="col-lg-6">
                    <form id="profileForm" method="post" action="modifier-profile.php">
                      <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="form-case" id="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : $_SESSION["nom"]; ?>" placeholder="<?php echo $_SESSION["nom"] ?>">
                      </div>
                      <div class="form-group">
                        <label for="tel">Num Telephone</label>
                        <input type="text" name="tel" class="form-case" id="tel" value="<?php echo isset($_POST['tel']) ? $_POST['tel'] : $_SESSION["tel"]; ?>" placeholder="<?php echo $_SESSION["tel"] ?>">
                      </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="prenom">Prenom</label>
                      <input type="text" name="prenom" class="form-case" id="prenom" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : $_SESSION["prenom"]; ?>" placeholder="<?php echo $_SESSION["prenom"] ?>">
                    </div>
                    <div class="form-group">
                      <label for="eMail">Email</label>
                      <input type="email" name="mail" class="form-case" id="email" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : $_SESSION["mail"]; ?>" placeholder="<?php echo $_SESSION["mail"] ?>">
                    </div>
                  </div>
                </div>
                <div class="row gutters" style="color:#773a00;">
                  <div class="col">
                    <h6 class="mt-3 mb-2" style="font-size:27px;">Biographie : </h6>
                  </div>
                </div>
                <div class="row gutters" style="color:#773a00;">
                  <div class="form-group">
                    <textarea type="bio" class="form-case" name="bio" id="bio" placeholder="<?php echo $_SESSION["bio"] ?>"><?php echo isset($_POST['bio']) ? $_POST['bio'] : $_SESSION["bio"]; ?></textarea>
                  </div>

                  <div class="row gutters" style="margin-top:1rem;">
                    <div class="col">
                      <div class="text-end">
                        <input type="reset" class="btn btn-annuler" name="submit" value="Annuler" />
                        <input type="submit" class="btn btn-affirmer" name="submit" value="Ajouter" />
                        
                      </div>
                    </div>
                  </div>
                  </form>
                  <div class="modal fade" id="suppression" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer votre profil ?
            </div>
            <div class="modal-footer">
                <form method="post" action="supprimer-profile.php">
                    <input type="hidden" name="supprimer" value="supprimer">
                    <button type="button" class="btn btn-annuler" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>





                  <?php
                  if (isset($_POST["submit"])) {

                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $email = $_POST["mail"];
                    $tel = $_POST["tel"];
                    $bio = $_POST["bio"];
                    $errors = array();
                    $mail = $_SESSION["mail"];
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $errors[] = "L'email entrée n'est pas valide";
                    }
                    require_once "database.php";
                    $sql = "SELECT * FROM utilisateur WHERE mail = '$email' AND mail != '$mail'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount > 0) {
                      $errors[] = "L'email existe déjà";
                    }
                    if (!empty($errors)) {
                      echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem;'>";
                      echo "<ul>";
                      foreach ($errors as $error) {
                        echo "<li>$error</li>";
                      }
                      echo "</ul>";
                      echo "</div>";
                    } else {
                      $sql = "UPDATE utilisateur SET nom = ?, prenom = ?, mail = ?, tel = ?, bio = ? WHERE mail = ?";
                      $stmt = mysqli_stmt_init($conn);
                      if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ssssss", $nom, $prenom, $email, $tel, $bio, $_SESSION["mail"]);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Vos informations ont été mises à jour avec succès.</div>";
                        $_SESSION["utilisateur"] = $nom . " " . $prenom;
                        $_SESSION["nom"] = $nom;
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["mail"] = $email;
                        $_SESSION["tel"] = $tel;
                        $_SESSION["bio"] = $bio;
                      } else {
                        die("Quelque chose s'est mal passé lors de la préparation de la requête de mise à jour.");
                      }
                    }
                  }



                  ?>
                </div>
              </div>
              <div class="Securité hidden" style="display:grid;" id="liste-sec">
                <div class="row gutters">
                  <div class="col">
                    <h6 class="mb-2 " style="color:#773a00;font-size:27px;">Changer votre mot de passe : </h6>
                  </div>
                </div>
                <form method="post" action="modifier-profile.php">
                  <div class="row gutters justify-content-center" style="color:#773a00;">

                    <div class="col-lg-8">

                      <div class="form-group">
                        <label for="nom">Mot de passe actuelle : </label>
                        <input type="text" class="form-case" name="Mdp" placeholder="Mot de passe">
                      </div>
                      <div class="form-group">
                        <label for="tel">Nouveau mot de passe</label>
                        <input type="text" class="form-case" name="NMdp" placeholder="Nouveau mot de passe">
                      </div>
                      <div class="form-group">
                        <label for="tel">Confirmer mot de passe</label>
                        <input type="text" class="form-case" name="CNMdp" placeholder="Confirmer le mot de passe">
                      </div>
                    </div>
                  </div>

                  <div class="row gutters" style="margin-top:1rem;">
                    <div class="col">
                      <div class="text-end">
                        <input type="reset" class="btn btn-annuler" name="submitt" value="Annuler" />
                        <input type="submit" class="btn btn-affirmer" name="submitt" value="Ajouter" />
                      </div>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($_POST["submitt"])) {
                  $mdp = $_POST["Mdp"];
                  $nmdp = $_POST["NMdp"];
                  $cnmdp = $_POST["CNMdp"];
                  $id = $_SESSION["id_user"];
                  $errors = array();
                  if ($nmdp != $cnmdp) {
                    $errors[] = "Les mots de passe ne correspondent pas";
                  }
                  if (strlen($mdp) < 8) {
                    $errors[] = "Le mot de passe doit comporter au moins 8 caractères";
                  }
                  require_once "database.php";
                  $sql = "SELECT mot_de_passe FROM utilisateur WHERE id_user = '$id' AND mot_de_passe = '$mdp'";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) == 0) {
                    $errors[] = "Mot de passe actuel incorrecte";
                  }
                  if (!empty($errors)) {
                    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
                          border: 1px solid transparent;
                          border-radius: .25rem;'>";
                    echo "<ul>";
                    foreach ($errors as $error) {
                      echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                  } else {
                    $sql = "UPDATE utilisateur SET mot_de_passe = ? WHERE id_user = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                      mysqli_stmt_bind_param($stmt, "si", $nmdp, $id);
                      mysqli_stmt_execute($stmt);
                      echo "<div class='alert alert-success'>Mot de passe changé avec succès .</div>";
                    } else {
                      die("Quelque chose s'est mal passé lors de la préparation de la requête de mise à jour.");
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
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

  <script src="js/modifier-profile.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/db0be4ca84.js" crossorigin="anonymous"></script>
  <script src="js/dropdown.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var imageContainer = document.getElementById('image-container');
      var profileImage = document.getElementById('profile-image');
      var useravatar = document.getElementById('user-avatar');
      var profilePicture = document.getElementById('profile-picture');
      imageContainer.addEventListener('mouseover', function() {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1.1)';
        imageContainer.style.cursor = 'pointer';
      });

      imageContainer.addEventListener('mouseout', function() {
        profileImage.style.transition = 'transform 0.5s ease';
        profileImage.style.transform = 'scale(1)';
      });

      useravatar.addEventListener('mouseover', function() {
        profilePicture.style.transition = 'transform 0.5s ease';
        profilePicture.style.transform = 'scale(1.1)';
        useravatar.style.cursor = 'pointer';
      });

      useravatar.addEventListener('mouseout', function() {
        profilePicture.style.transition = 'transform 0.5s ease';
        profilePicture.style.transform = 'scale(1)';
      });

    });
    document.addEventListener("DOMContentLoaded", function() {
      const flushButtons = document.querySelectorAll('.flush-btn');
      const informationsSection = document.getElementById('liste-inf');
      const securiteSection = document.getElementById('liste-sec');
      const btn1 = document.getElementById('btn1');
      const btn2 = document.getElementById('btn2');


      flushButtons.forEach(button => {
        button.addEventListener('click', function() {
          // Toggle visibility based on the button clicked
          if (button.textContent === 'Informations Générales') {
            informationsSection.classList.remove('hidden');
            securiteSection.classList.add('hidden');
          } else if (button.textContent === 'Mot de passe') {
            securiteSection.classList.remove('hidden');
            informationsSection.classList.add('hidden');
          }
        });
        button.addEventListener('mouseover', function() {
          button.style.transition = 'transform 0.5s ease';
          button.classList.add('fbtn-active');
          button.style.cursor = 'pointer';
        });
        button.addEventListener('mouseout', function() {
          button.style.transition = 'transform 0.5s ease';
          button.classList.remove('fbtn-active');
          button.style.transform = 'scale(1)';
        });
      });
    });

    function toggleDropdown() {
      var dropdown = document.getElementById("avatar-dropdown-list");
      dropdown.classList.toggle("active");
    }

    function toggleProfilePicture() {
      var profilePictureContainer = document.getElementById("profile-picture-container");
      profilePictureContainer.classList.remove("hidden");

    }
  </script>

</body>

</html>