<?php
require 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    // Redirect the user to the login page or handle as needed
    header("Location: login.php");
    exit;
}

// Delay the execution for 2000 milliseconds before retrieving the article ID from the URL
echo '<script>window.setTimeout(function() {';
    echo 'window.location.href = "current_page.php?id=" + ' . $_GET['id'] . ';'; // Replace 'current_page.php' with the name of your PHP file
    echo '}, 200);</script>';

// Get the logged-in user's ID
$id_user = $_SESSION['id_user'];

// Get the article ID and dates from the form submission
if (isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    $motif_query = "SELECT motif FROM articles WHERE id = '$article_id'";
    $motif_result = mysqli_query($conn, $motif_query);
    $motif_row = mysqli_fetch_assoc($motif_result);
    $motif = $motif_row['motif'];

    // Set default values for dates
    $date_debut = NULL;
    $date_fin = NULL;

    if ($motif == 'Location' && isset($_POST['deb']) && isset($_POST['fin'])) {
        // If motif is 'Location' and dates are provided, use them
        $date_debut = $_POST['deb'];
        $date_fin = $_POST['fin'];
    }

    // Check if the article exists
    $check_article_query = "SELECT * FROM articles WHERE id = '$article_id'";
    $check_article_result = mysqli_query($conn, $check_article_query);

    if (mysqli_num_rows($check_article_result) > 0) {
        // Check if the article is already in the cart for the user
        $check_query = "SELECT * FROM panier WHERE id_user = '$id_user' AND id = '$article_id' AND id_event= '0' ";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // Article not in cart, insert a new row
            $insert_query = "INSERT INTO panier (id_user, id, quantite, date_debut, date_fin, date_ajout) VALUES ('$id_user', '$article_id', 1, '$date_debut', '$date_fin', NOW())";
            mysqli_query($conn, $insert_query);
        } else {
            // Article already in cart, display pop-up message
            echo "<script>alert('Cet article est déjà dans le panier.');</script>";
        }
    } else {
        // Show a pop-up error message if the article ID doesn't exist
        echo "<script>alert('L'identifiant de l'article n'existe pas');</script>";
    }
} else {
    // Handle invalid or missing article ID
    echo "<script>alert('Identifiant d'article invalide ou manquant');</script>";
}

// Redirect the user back to the same page after processing the request
echo '<script>window.setTimeout(function(){ window.location.href = "planification.php"; }, 200);</script>';
exit;

?>
