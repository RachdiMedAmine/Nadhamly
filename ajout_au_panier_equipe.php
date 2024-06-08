<?php
require 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION["id_user"])) {
    // Handle not logged in user
    exit("User not logged in.");
}

// Check if 'id' parameter is passed through the URL
if (!isset($_GET['id'])) {
    // Handle missing 'id' parameter
    exit("ID parameter missing.");
}

// Delay the execution for 2000 milliseconds before retrieving the article ID from the URL
echo '<script>window.setTimeout(function() {';
    echo 'window.location.href = "current_page.php?id=" + ' . $_GET['id'] . ';'; // Replace 'current_page.php' with the name of your PHP file
    echo '}, 2000);</script>';

// Get input values
$id_user = $_SESSION["id_user"];
$id_equipe = $_GET['id'];
$date_debut = $_POST['deb'];
$date_fin = $_POST['fin'];
$quantity = 1; // Always set quantity to 1

// Check if date_fin < date_debut
if (strtotime($date_fin) < strtotime($date_debut)) {
    // Show pop-up message
    echo "<script>alert('La date de fin doit être supérieure ou égale à la date de début de l\'événement.');</script>";
    // Redirect user to same article page without adding the items to cart
    echo '<script>window.setTimeout(function(){ window.location.href = "details_equipe.php?id=' . $id_equipe . '"; }, 200);</script>';    
    exit();
}

// Check if date_debut < current date
if (strtotime($date_debut) < time()) {
    // Show pop-up message
    echo "<script>alert('La date debut doit etre superieure a la date courante.');</script>";
    // Redirect user to same article page without adding the items to cart
    echo '<script>window.setTimeout(function(){ window.location.href = "details_equipe.php?id=' . $id_equipe . '"; }, 200);</script>';    
    exit();
}else{
    if (strtotime($date_fin) < time()) {
        // Show pop-up message
        echo "<script>alert('La date de fin de l\'événement ne peut pas être aujourd'hui.');</script>";
        // Redirect user to same article page without adding the items to cart
        echo '<script>window.setTimeout(function(){ window.location.href = "details_art_location_1.php?id=' . $article_id . '"; }, 200);</script>';    
        exit();
}}

// Check if the entry already exists in the table "panier"
$sql_check = "SELECT * FROM panier WHERE id_user = '$id_user' AND id_equipe = '$id_equipe' AND date_debut = '$date_debut' AND date_fin = '$date_fin' AND id_event= '0'";
$result_check = mysqli_query($conn, $sql_check);

// If the entry does not exist, insert it into the "panier" table
if (mysqli_num_rows($result_check) == 0) {

    // Insert the new entry into the "panier" table
    $sql_insert = "INSERT INTO panier ( id_user, id_equipe, date_debut, date_fin, quantite, date_ajout) VALUES ( '$id_user', '$id_equipe', '$date_debut', '$date_fin', '$quantity', NOW())";
    $result_insert = mysqli_query($conn, $sql_insert);

    if ($result_insert) {
        // Entry added successfully, redirect to planification.php
        echo '<script>window.setTimeout(function(){ window.location.href = "planification.php"; }, 200);</script>';
        exit();
    } else {
        // Failed to add entry
        echo "Failed to add entry to cart.";
    }
}
// Redirect the user back to the same page after processing the request
echo '<script>window.setTimeout(function(){ window.location.href = "planification.php"; }, 200);</script>';
exit;
?>
