<?php
require 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    // Redirect the user to the login page or handle as needed
    header("Location: login.php");
    exit;
}

// Get the logged-in user's ID
$id_user = $_SESSION['id_user'];

// Delay the execution for 2000 milliseconds before retrieving the article ID from the URL
echo '<script>window.setTimeout(function() {';
    echo 'window.location.href = "current_page.php?id=" + ' . $_GET['id'] . ';'; // Replace 'current_page.php' with the name of your PHP file
    echo '}, 200);</script>';

// Get the article ID and dates from the form submission
if (isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];

    // Set default values for dates
    $date_debut = NULL;
    $date_fin = NULL;

    if (isset($_POST['deb']) && isset($_POST['fin'])) {
        // If dates are provided, use them
        $date_debut = $_POST['deb'];
        $date_fin = $_POST['fin'];
    }

    // Check if date_debut < current date
    if (strtotime($date_debut) < time()) {
        // Show pop-up message
        echo "<script>alert('La date debut doit etre superieure a la date courante.');</script>";
        // Redirect user to same article page without adding the items to cart
        echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location_1.php?id=' . $article_id . '"; }, 200);</script>';
        exit();
    } else {
        if (strtotime($date_fin) < time()) {
            // Show pop-up message
            echo "<script>alert('La date de fin de l\'événement ne peut pas être aujourd'hui.');</script>";
            // Redirect user to same article page without adding the items to cart
            echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location_1.php?id=' . $article_id . '"; }, 200);</script>';
            exit();
        }
    }
    // Check if date_fin < date_debut
    if (strtotime($date_fin) < strtotime($date_debut)) {
        // Show pop-up message
        echo "<script>alert('La date de fin doit être supérieure ou égale à la date de début de l\'événement.');</script>";
        // Redirect user to same article page without adding the items to cart
        echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location_1.php?id=' . $article_id . '"; }, 200);</script>';
        exit();
    }



    // Check if the article exists
    $check_article_query = "SELECT * FROM articles WHERE id = '$article_id'";
    $check_article_result = mysqli_query($conn, $check_article_query);

    if (mysqli_num_rows($check_article_result) > 0) {
        // Check if the row with same values already exists in the panier table
        $check_query = "SELECT * FROM panier WHERE id_user = '$id_user' AND id = '$article_id' AND DATE(date_ajout) = CURDATE() AND DATE(date_debut) = '$date_debut' AND DATE(date_fin) = '$date_fin' AND id_event= '0'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // Article not in cart, insert a new row
            $insert_query = "INSERT INTO panier (id_user, id, quantite, date_debut, date_fin, date_ajout) VALUES ('$id_user', '$article_id', 1, '$date_debut', '$date_fin', NOW())";
            mysqli_query($conn, $insert_query);
        } else {
            // Article already in cart, show a pop-up message
            echo "<script>alert('Article deja dans le panier pour cette date');</script>";
        }
    } else {
        // Show a pop-up error message if the article ID doesn't exist
        echo "<script>alert('Article ID doesn\'t exist');</script>";
    }
} else {
    // Handle invalid or missing article ID
    // You can handle this case differently, such as logging an error
    // or displaying a generic error message on the page
    echo "<script>alert('Invalid or missing article ID');</script>";
}

// Redirect the user back to the same page after processing the request
echo '<script>window.setTimeout(function(){ window.location.href = "planification.php"; }, 200);</script>';
exit;
