<?php
require 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION["id_user"])) {
    // Handle not logged in user
    exit("User not logged in.");
}

// Get article id and date ajout from POST request
$articleId = $_POST['id_equipe']; // Change from 'id' to 'id_equipe'
$dateAjout = $_POST['date_ajout'];

// Assuming id_user is obtained from session or somewhere else
$idUser = $_SESSION['id_user'];

// SQL query to delete item from 'panier' table
$sql = "DELETE FROM panier WHERE id_user = '$idUser' AND id_equipe = '$articleId' AND date_ajout = '$dateAjout'"; // Change from 'id' to 'id_equipe'

if ($conn->query($sql) === TRUE) {
    header("Location: panier.php" );
    exit;
} else {
    // Return error message
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
