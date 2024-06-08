<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--liens CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <title>Connexion</title>
</head>

<body class="v-100 overflow-hidden">
    <!-- deb liens cdn pour jquery et bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- fin liens cdn pour jquery et bootstrap-->

    <div class="connexionn" style="position:absolute;
    top: 50%;
    left: 50%;
    justify-content: center;
    transform: translate(-50%, -50%);
    z-index: 10; 
    width:18%;
    font-size:190%;
    background-color: #ffefe0;
    border-radius:10px;
    box-shadow : 0px 0px 10px 5px gray;
    display:none;">
        <p align="center" style="color:#773a00;font-family:'Radley';">Connexion Réussite</p>
    </div>
    <!--Début Form-->
    <div class="container">
        <div class="signin-signup">

            <!--Formulaire de connexion-->
            <form action="login.php" class="sign-in-form" method="post">
                <h2 class="title">Se connecter</h2>
                <div class="inputfield">
                    <i class="ri-user-fill"></i>
                    <input type="text" name="mail" placeholder="Adresse Email" />
                </div>
                <div class="inputfield">
                    <i class="ri-lock-fill"></i>
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" />
                </div>
                <input type="submit" value="Se connecter" name="login" class="btn">
                <?php

                if (isset($_POST["login"])) {
                    $email = $_POST["mail"];
                    $password = $_POST["mot_de_passe"];
                    require_once "database.php";
                    $sql = "SELECT * FROM utilisateur WHERE mail = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($user) {
                        if ($password === $user["mot_de_passe"]) {
                            session_start();
                            $_SESSION["utilisateur"] = $user["nom"] . " " . $user["prenom"];
                            $_SESSION["id_user"] = $user["id_user"];
                            $_SESSION["role"] = $user["role"];
                            $_SESSION["pdp"] = $user["pdp"];
                            $_SESSION["nom"] = $user["nom"];
                            $_SESSION["prenom"] = $user["prenom"];
                            $_SESSION["tel"] = $user["tel"];
                            $_SESSION["mail"] = $user["mail"];
                            $_SESSION["bio"] = $user["bio"];
                            header("Location: index.php");
                            $_SESSION["login-success"] = true;
                            $id_user = $_SESSION["id_user"];

                            $sql = "select * from `articles` where id_frs!= '$id_user' ";
                            $all_article = $conn->query($sql);

                            $id_user = $_SESSION["id_user"];
                            $sql0 = "SELECT * FROM `articles` where id_frs = '$id_user'";
                            $res0 = mysqli_query($conn, $sql0);
                            $article0 = $res0->fetch_assoc();
                            $_SESSION["id"] = $article0["id"];
                            die();
                        } else {
                            echo "<div class='alert alert-danger'>Mot de passe incorrecte</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email introuvable</div>";
                    }
                }
                ?>
                <p class="account-text">Vous n'êtes pas inscrit? <a href="#" id="sign-up-btn2">S'inscrire</a></p>

            </form>
            <!--Formulaire d'inscription-->

            <form action="login.php" class="sign-up-form" method="post">
                <h2 class="title">S'inscrire</h2>
                <div class="inputfield">
                    <i class="ri-user-fill"></i>
                    <input name="nom" type="text" placeholder="Nom" />
                </div>
                <div class="inputfield">
                    <i class="ri-user-fill"></i>
                    <input name="prenom" type="text" placeholder="prenom" />
                </div>
                <div class="inputfield">
                    <i class="ri-user-fill"></i>
                    <input name="username" type="text" placeholder="Nom d'utilisateur" />
                </div>
                <div class="inputfield">
                    <i class="ri-mail-fill"></i>
                    <input name="email" type="text" placeholder="Adresse Mail" />
                </div>
                <div class="inputfield">
                    <i class="ri-lock-fill"></i>
                    <input name="mot_de_passe" type="password" placeholder="Mot de passe" />
                </div>
                <div class="inputfield">
                    <i class="ri-lock-fill"></i>
                    <input name="repeatpassword" type="password" placeholder="Confirmer Mot de passe" />
                </div>
                <div class="inputfield">
                    <i class="ri-phone-fill"></i>
                    <input name="tel" type="text" placeholder="Numéro de téléphone" />
                </div>
                <div class="inputarea">
                    <i class="ri-file-text-fill"></i>
                    <textarea name="bio" cols="24" rows="4" placeholder="Biographie"></textarea>
                </div>
                <input type="submit" value="S'inscrire" class="btn" name="submit">
                <?php
                if (isset($_POST["submit"])) {
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $fullName = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["mot_de_passe"];
                    $passwordRepeat = $_POST["repeatpassword"];
                    $tel = $_POST["tel"];
                    $bio = $_POST["bio"];

                    $errors = array();

                    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                        $errors[] = "Tous les champs sont requis";
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "L'email n'est pas valide";
                    }
                    if (strlen($password) < 8) {
                        $errors[] = "Le mot de passe doit comporter au moins 8 caractères";
                    }
                    if ($password !== $passwordRepeat) {
                        $errors[] = "Les mots de passe ne correspondent pas";
                    }

                    require_once "database.php";
                    $sql = "SELECT * FROM utilisateur WHERE mail = '$email'";
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
                        // Generate a random number
                        $random_id_panier = generateRandomNumber();

                        // Check if the random number already exists in the database
                        $sql_check_existing = "SELECT id_panier FROM utilisateur WHERE id_panier = '$random_id_panier'";
                        $result_check_existing = mysqli_query($conn, $sql_check_existing);
                        $num_rows = mysqli_num_rows($result_check_existing);

                        // If the random number already exists, generate a new one until a unique one is found
                        while ($num_rows > 0) {
                            $random_id_panier = generateRandomNumber();
                            $result_check_existing = mysqli_query($conn, $sql_check_existing);
                            $num_rows = mysqli_num_rows($result_check_existing);
                        }

                        // Insert user data into the database along with the generated random id_panier
                        $sql_insert_user = "INSERT INTO utilisateur (nom, prenom, mail, tel, bio, username, mot_de_passe, id_panier) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql_insert_user);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "ssssssss", $nom, $prenom, $email, $tel, $bio, $fullName, $password, $random_id_panier);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>Vous êtes inscrit avec succès.</div>";
                        } else {
                            die("Quelque chose s'est mal passé");
                        }
                    }
                }

                // Function to generate a random number of length shorter than 11
                function generateRandomNumber()
                {
                    $length = rand(1, 10); // Generate a random length shorter than 11
                    $characters = '0123456789';
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, strlen($characters) - 1)];
                    }
                    return $randomString;
                }
                ?>




                <p class="account-text">Vous avez un compte? <a href="#" id="sign-in-btn2">Se connecter</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Vous avez un compte?</h3>
                    <p>
                        Si vous avez un compte, veuillez Cliquer sur le boutoun Se connecter pour accéder à votre compte.
                    </p>
                    <button class="btn" id="sign-in-btn">Se connecter</button>
                    <button class="btn" id="acc1">Acceuil</button>
                </div>
                <!-- <img src="images/reg.png" alt="" class="image" width="40%" height="10%"> -->
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Etes-vous inscrit?</h3>
                    <p>
                        Si vous n'êtes pas encore inscrit, veuillez Cliquer sur le boutoun S'inscrire pour créer un compte sur la plateforme.
                    </p>
                    <button class="btn" id="sign-up-btn">S'inscrire</button>
                    <button class="btn" id="acc2">Acceuil</button>
                </div>
                <!-- <img src="images/reg.png" alt="" class="image" width="40%" height="10%"> -->
            </div>
        </div>
    </div>





    <script src="js/login.js"></script>
</body>

</html>