<?php 
include 'config.php';
session_start();
$id_equipe = $_GET['id'];

// Récupérer les informations de l'équipe
$sql = "SELECT * FROM `equipes` WHERE id='$id_equipe'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

// Récupérer les ID nécessaires
$id_frs = $row['id_frs'];
$id_candidat = $_SESSION['id_user'];
$id_equipe = $row['id'];

// Vérifier s'il existe déjà une candidature 
$existing_query = "SELECT * FROM `candidatures` WHERE id_frs='$id_frs' AND id_equipe='$id_equipe' AND id_candidat='$id_candidat'";
$existing_result = mysqli_query($conn, $existing_query);
if(mysqli_num_rows($existing_result) > 0) {
    // Une candidature avec les mêmes attributs existe déjà, vous pouvez gérer cela ici
    header('location:equipes.php');
        $_SESSION['error_message'] = 'Vous avez déjà envoyé une candidature pour cette équipe.';
    
} else {
    // Aucune candidature alors..
    $date = date("Y-m-d H:i:s");
    $insert = mysqli_query($conn, "INSERT INTO `candidatures` (id_frs, id_equipe, id_candidat,date) VALUES ('$id_frs', '$id_equipe', '$id_candidat','$date')") or die('Requête échouée');
    if($insert) {
        header('location:equipes.php');
        $_SESSION['success_message'] = 'Votre demande envoyée avec succès!';
    }
}
?>
