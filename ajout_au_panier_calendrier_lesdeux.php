<?php
require 'config.php';
session_start();

// Logout functionality
if (isset($_POST["logout"])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Get user profile picture if available
if (isset($_SESSION["pdp"])) {
    $pdp = $_SESSION["pdp"];
} else {
    $pdp = null;
}

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Get the logged-in user's ID
$id_user = $_SESSION['id_user'];

// Delay the execution for 2000 milliseconds before retrieving the article ID from the URL
echo '<script>window.setTimeout(function() {';
echo 'window.location.href = "current_page.php?id=" + ' . $_GET['id'] . ';'; // Replace 'current_page.php' with the name of your PHP file
echo '}, 200);</script>';

// Get the article ID from the URL
$id_article = $_GET['id'];

// Retrieve article details from the database
$sql = "SELECT * FROM `articles` WHERE id = '$id_article'";
$res = mysqli_query($conn, $sql);
$article = $res->fetch_assoc();

// Retrieve other articles from the same category (excluding the current article and articles from the same user)
$sql2 = "SELECT * FROM `articles` WHERE categorie = '{$article['categorie']}' AND id != '$id_article' AND id_frs != '$id_user' LIMIT 4";
$qlq_articles = $conn->query($sql2);

// Retrieve information about the article's supplier
$sqlf = "SELECT * FROM `utilisateur` WHERE id_user = '{$article['id_frs']}'";
$resf = mysqli_query($conn, $sqlf);
$fournisseur = $resf->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['article_id']) && isset($_POST['quantite'])) {
        // Retrieve article ID and quantity from the form
        $article_id = $_POST['article_id'];
        $quantite = $_POST['quantite'];

        // Set default values for dates
        $date_debut = NULL;
        $date_fin = NULL;

        // Check if date inputs are provided
        if (isset($_POST['deb']) && isset($_POST['fin'])) {
            // If dates are provided, use them
            $date_debut = $_POST['deb'];
            $date_fin = $_POST['fin'];

            // Check if date_fin < date_debut
            if (strtotime($date_fin) < strtotime($date_debut)) {
                // Show pop-up message
                echo "<script>alert('La date de fin doit être supérieure ou égale à la date de début de l\'événement.');</script>";
                // Redirect user to same article page without adding the items to cart
                echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location.php?id=' . $article_id . '"; }, 200);</script>';
                exit();
            }

            // Check if date_debut < current date
            if (strtotime($date_debut) < time()) {
                // Show pop-up message
                echo "<script>alert('La date debut doit etre superieure a la date courante.');</script>";
                // Redirect user to same article page without adding the items to cart
                echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location.php?id=' . $article_id . '"; }, 200);</script>';
                exit();
            }
        }

        // Check if the article exists
        $check_article_query = "SELECT * FROM articles WHERE id = '$article_id'";
        $check_article_result = mysqli_query($conn, $check_article_query);

        if (mysqli_num_rows($check_article_result) > 0) {
            // Check if the combination of user id, article id, date_debut, and date_fin already exists in the cart
            $check_query = "SELECT * FROM panier WHERE id_user = '$id_user' AND id = '$article_id' AND date_debut = '$date_debut' AND date_fin = '$date_fin' AND id_event= '0'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) == 0) {
                // Combination does not exist in cart, insert a new row
                $insert_query = "INSERT INTO panier (id_user, id, quantite, date_debut, date_fin, date_ajout) VALUES ('$id_user', '$article_id', '$quantite', '$date_debut', '$date_fin', NOW())";
                mysqli_query($conn, $insert_query);
            } else {
                // Combination already exists in cart, update quantity by adding the input quantity
                $update_query = "UPDATE panier SET quantite = quantite + $quantite WHERE id_user = '$id_user' AND id = '$article_id' AND date_debut = '$date_debut' AND date_fin = '$date_fin'";
                mysqli_query($conn, $update_query);
                echo "<script>alert('Cet article est déjà dans le panier, la quantite a ete mise a jour.');</script>";
            }
        } else {
            // Show a pop-up error message if the article ID doesn't exist
            echo "<script>alert('Article ID doesn\'t exist');</script>";
        }
    } else {
        // Handle invalid or missing article ID or quantity
        echo "<script>alert('Invalid or missing article ID or quantity');</script>";
    }

    // Redirect the user back to the same page after processing the request
    echo '<script>window.setTimeout(function(){ window.location.href = "planification.php"; },20);</script>';
    exit;
}
