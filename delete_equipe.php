<?php
include 'config.php';
session_start();

if(isset($_GET['id'])){

    $id_equipe=$_GET['id'];
    
    $sql="delete from `equipes` where id = '$id_equipe'";
    $res=mysqli_query($conn,$sql);

    if($res){
        $_SESSION['success_message'] = 'Suppression avec succés!';
        header('location:contact.php');
        echo "<div class='alert alert-danger' style=' padding: 5px 5px;
        border: 1px solid transparent;
        border-radius: .25rem; color: black; background-color: green;'>";
       header('location:profile.php');
    }
    else{
        echo"Echec de la suppression!";
    }

}


?>