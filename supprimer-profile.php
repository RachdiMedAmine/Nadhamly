<?php

require 'database.php';
session_start();
$iduser = $_SESSION["id_user"];

if (isset($_POST["supprimer"])) {
    $sql = "DELETE FROM utilisateur WHERE id_user = '$iduser'";
    if (mysqli_query($conn, $sql)) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

?>
