<?php
include "config.php";

$id_eq=$_GET['id_equipe'];
$id_f=$_GET['id_frs'];
$id_c=$_GET['id_candidat'];
//var_dump($id_eq);
$update=mysqli_query($conn, "update `candidatures` set statut='démission' where id_equipe='$id_eq'AND id_frs='$id_f' AND id_candidat='$id_c';") or die('requête échouée');

if ($update) {
    
    $message4='Démission avec succés!';
   
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: green;'>";
    header("Location: profile.php");
    $_SESSION['success_message'] = 'Démission avec succés!';
    
  }
  else {
    $message4='Votre démission a échouée!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: red;'>";
    header('location:profile.php');
    $_SESSION['error_message'] = 'Votre démission a échouée!';
  }

?>