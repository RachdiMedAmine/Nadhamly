<?php
include "config.php";

$id_eq=$_GET['id_equipe'];
$id_f=$_GET['id_frs'];
$id_c=$_GET['id_candidat'];
$sql="delete from `candidatures` where id_equipe = '$id_eq' AND id_candidat = '$id_c' AND id_frs = '$id_f'";
$delete=mysqli_query($conn,$sql);


if ($delete) {
    
    $message4='Demande rejetée!';
    $_SESSION['success_message'] = 'Demande rejetée!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: green;'>";
    header('location:demandes.php');
   
    
  }
  else {
    $message4='Le rejet de l\'invitation a echoué!';
    $_SESSION['error_message'] = 'Le rejet de l\'invitation a echoué!';
    echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: red;'>";
    header('location:demandes.php');
  }

?>