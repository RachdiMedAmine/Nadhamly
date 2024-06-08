<?php
include "config.php";

$id_eq = $_GET['id_equipe'];
$id_f = $_GET['id_frs'];
$id_c = $_GET['id_candidat'];
//var_dump($id_eq);
$update = mysqli_query($conn, "update `candidatures` set statut='acceptee' where id_equipe='$id_eq'AND id_frs='$id_f' AND id_candidat='$id_c';") or die('requête échouée');

if ($update) {

  $message4 = 'Demande acceptée!';

  echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: green;'>";
  header('location:demandes.php');
  $_SESSION['success_message'] = 'Demande acceptée!';
} else {
  $message4 = 'L\'acceptation de l\'invitation a echoué!';

  echo "<div class='alert alert-danger' style=' padding: 5px 5px;
    border: 1px solid transparent;
    border-radius: .25rem; color: black; background-color: red;'>";
  header('location:demandes.php');
  $_SESSION['error_message'] = 'L\'acceptation de l\'invitation a echoué!';
}
