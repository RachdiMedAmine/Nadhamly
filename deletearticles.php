<?php
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["articles_id"])) {
    $ArticleId = $_POST["articles_id"];
    $sql = "DELETE FROM articles WHERE id = '$ArticleId'";
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
