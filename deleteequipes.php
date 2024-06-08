<?php
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["equipes_id"])) {
    $EquipeId = $_POST["equipes_id"];
    $sql = "DELETE FROM equipes WHERE id = '$EquipeId'";
    $article = mysqli_query($conn,$sql);
   // $stmt = mysqli_prepare($conn, $sql);
    if ($article) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($conn);
} else {
    echo "error: id parameter not provided";
}
?>
