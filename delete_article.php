<?php
include 'config.php';
session_start();

if(isset($_GET['id'])){

    $id_art=$_GET['id'];
    
    $sql="delete from `articles` where id = '$id_art'";
    $res=mysqli_query($conn,$sql);

    if($res){
        $_SESSION['success_message'] = 'Suppression avec succés!';
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
