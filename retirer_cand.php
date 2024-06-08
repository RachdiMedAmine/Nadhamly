<?php
include "config.php";

$id_eq=$_GET['id_equipe'];
$id_f=$_GET['id_frs'];
$id_c=$_GET['id_candidat'];
//var_dump($id_eq);
$update=mysqli_query($conn, "update `candidatures` set statut='viré' where id_equipe='$id_eq'AND id_frs='$id_f' AND id_candidat='$id_c';") or die('requête échouée');

if ($update) {
    
    $message4='Personnel viré!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: green;'>";
    header("Location: details_equipe_perso.php?id={$id_eq}");
    $_SESSION['success_message'] = 'Personnel viré!';
    
  }
  else {
    $message4='Votre demande de virer ce personnel a echoué!';
    
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: red;'>";
    header('location:demandes.php');
    $_SESSION['error_message'] = 'Votre demande de virer ce personnel a echoué!';
  }

?>