<?php
session_start();
if (isset($_POST["logout"])) {
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}
if (isset($_SESSION["pdp"])) {
  $pdp = $_SESSION["pdp"];
} else {
  $pdp = null;
}

require_once "database.php";

function counter($conn,$nom_tableau) {
    $sql = "SELECT COUNT(*) AS total_users FROM $nom_tableau";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalelements = $row['total_users'];
        mysqli_free_result($result);
        return $totalelements;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}




?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Dashboard.css">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    
<script src="https://kit.fontawesome.com/f2745c6c38.js" crossorigin="anonymous"></script>
<style>
        .user-container {
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .user-card {
            transition: transform 0.3s ease-in-out;
        }

        .user-card:hover {
            transform: scale(1.02);
            cursor: pointer;
        }

        .user-icons {
            display: none;
            transition: opacity 0.3s ease-in-out;
        }

        .user-card:hover .user-icons {
            display: flex;
            opacity: 1;
        }

        .user-icons i {
            cursor: pointer;
            margin-right: 10px;
            transition: color 0.3s ease-in-out;
        }

        .user-icons i:hover {
            color: red;
        }
        <style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 999; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.4); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        border: 1px solid #888;
        width: 80%; 
        border-radius: 10px;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 10px 16px;
        border-bottom: 1px solid #dee2e6;
        background-color: #773a00;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-body {
        padding: 10px 16px;
    }

    .modal-footer {
        padding: 10px 16px;
        border-top: 1px solid #dee2e6;
        background-color: #f7f7f7;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .mybtn {
        color: #fff;
        background-color: #773a00 !important;
        border-color: #773a00 !important;
        border-radius: 5px;
        padding: 8px 16px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.5s ease, color 0.5s ease;
    }

    .mybtn:hover {
        background-color: white !important;
        border-color: #773a00 !important;
        border-radius: 5px;
    color: #773a00;
    }


    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="brand"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="index.php">Nadhamly</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item nav-btn" id="btn1" onclick="showUsers()">
                    <a href="#" class="sidebar-link">
                         <i class="fa-solid fa-users"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li class="sidebar-item nav-btn" onclick="showArticles()" id="btn2">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-snowman"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="sidebar-item nav-btn" onclick="showEquipe()" id="btn3">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-people-group"></i>
                        <span>Equipes</span>
                    </a>
                </li>
                <li class="sidebar-item nav-btn" onclick="showRec()" id="btn5">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-comments"></i>
                        <span>Reclamations</span>
                    </a>
                </li>
                <li class="sidebar-item nav-btn" onclick="showStats()" id="btn4">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-chart-simple"></i>
                        <span>statistiques</span>
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <main class="content px-3 py-4 " style="width:100%;">
    <div class="container-fluid" id="main-container">
  <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Utilisateurs</h3>
            <div class="user-container" style="width:70%;height: 500px;overflow:auto;">
                
                <?php
                $sql = "SELECT * FROM utilisateur where role != 'admin'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['pdp'] == NULL) {
                            $pdp = "images/defaultpdp.jpg";
                        } else {
                            $pdp = $row['pdp'];
                        }
                ?>
                        <div class="user-card d-flex align-items-center" data-user-id="<?php echo $row['id_user']; ?>">
                            <img src="<?php echo $pdp; ?>" alt="Profile Image">
                            <div class="user-info">
                                <h5><?php echo $row['nom']; ?></h5>
                                <p><?php echo $row['mail']; ?></p>
                            </div>
                            <div class="user-icons">
                                <i class="ri-delete-bin-fill" onclick="deleteItem(this, 'user')"></i>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Aucun utilisateur trouvé.</p>";
                }
                ?>
            </div>
        </div>
           
    </div>
</main>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="js/Dashboard.js"></script>
    <script>
        let container=document.getElementById("main-container");
        function showStats() {
            var htmlContent = `
    <div class="mb-3">
        <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
        <div class="row">
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            Nombre d'utilisateurs
                        </h5>
                        <p class="mb-2 fw-bold">
                            <?php 
                                $nb_utilisateurs = counter($conn,"utilisateur");
                                if ($nb_utilisateurs !== false) {
                                    echo $nb_utilisateurs;
                                }else {
                                    echo"N/A";
                                }
                                
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card  border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            Nombre d'équipes
                        </h5>
                        <p class="mb-2 fw-bold">
                            <?php
                                $nb_equipes = counter($conn,"equipes");
                                if ($nb_equipes !== false) {
                                    echo $nb_equipes;
                                }else {
                                    echo "N/A";
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            Nombre des articles
                        </h5>
                        <p class="mb-2 fw-bold">
                            <?php
                                $nb_articles = counter($conn,"articles");
                                if ($nb_articles !== false) {
                                    echo $nb_articles;
                                }else {
                                    echo "N/A";
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;

// Set the innerHTML of the container to the HTML content
container.innerHTML = htmlContent;

        }
        function showRec() {
            var htmlContent = `
            <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Reclamations</h3>
            <div class="user-container" style="width:70%;height: 500px;overflow:auto;">
                
                <?php
                $sql = "SELECT * FROM crm";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $modal_id = 'rec_' . $row['id'];  
                ?>
                        <div class="user-card d-flex align-items-center" data-crm-id="<?php echo $row['id']; ?>">
                            <div class="user-info">
                                <h5><?php echo $row['objet']; ?></h5>
                                <p><?php echo $row['nom']; ?></p>
                                <p><?php echo $row['mail']; ?></p>
                            </div>

                            <div class="user-icons">
                                <i class="ri-delete-bin-fill" onclick="deleteItem(this, 'crm')"></i>
                                <i class="ri-eye-fill" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>"></i>

                            </div>
                        </div>
                                <div class="modal" id="<?php echo $modal_id; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reclamations</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong style="color:#773a00;">Nom :</strong> <?php echo $row["nom"]?></p>
                                                <p><strong style="color:#773a00;">Email :</strong> <?php echo $row["mail"]?></p>
                                                <p><strong style="color:#773a00;">Numero telephonique :</strong> <?php echo $row["tel"]?></p>
                                                <p><strong style="color:#773a00;">Objet :</strong> <?php echo $row["objet"]?></p>
                                                <h5 style="color:#773a00;"><strong>Message :</strong></h5><p><?php echo $row["message"]?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="mybtn" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                <?php
                    }
                } else {
                    echo "<p>Aucun reclamation.</p>";
                }
                ?>
            </div>
        </div>  
            
            
            `
            container.innerHTML =htmlContent;
        
        }
        function showUsers() {
            var htmlContent1 = `        <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Utilisateurs</h3>
            <div class="user-container" style="width:70%;height: 500px;overflow:auto;">
                
                <?php
                $sql = "SELECT * FROM utilisateur where role != 'admin'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['pdp'] == NULL) {
                            $pdp = "images/defaultpdp.jpg";
                        } else {
                            $pdp = $row['pdp'];
                        }
                ?>
                        <div class="user-card d-flex align-items-center" data-user-id="<?php echo $row['id_user']; ?>">
                            <img src="<?php echo $pdp; ?>" alt="Profile Image">
                            <div class="user-info">
                                <h5><?php echo $row['nom']; ?></h5>
                                <p><?php echo $row['mail']; ?></p>
                            </div>
                            <div class="user-icons">
                                <i class="ri-delete-bin-fill" onclick="deleteItem(this, 'user')"></i>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Aucun utilisateur trouve.</p>";
                }
                ?>
            </div>
        </div>`;
        container.innerHTML =htmlContent1;
        }
        function showEquipe() {
            let htmlContent3 = ` 
            <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Equipes</h3>
            <div class="user-container" style="width:70%;height: 500px;overflow:auto;">
                
                <?php
                $sql = "SELECT * FROM equipes";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['image'] == NULL) {
                            $pdp = "images/defaultpdp.jpg";
                        } else {
                            $pdp = $row['image'];
                        }
                ?>
                        <div class="user-card d-flex align-items-center" data-equipes-id="<?php echo $row['id']; ?>">
                            <img src="<?php echo $pdp; ?>" alt="Profile Image">
                            <div class="user-info">
                                <h5><?php echo $row['libelle']; ?></h5>
                                <p><?php echo $row['categorie']; ?></p>
                            </div>
                            <div class="user-icons">
                                <i class="ri-delete-bin-fill" onclick="deleteItem(this, 'equipes')"></i>
                                <i class="ri-eye-fill" onclick="showDetailsEquipes(this ,'<?php echo $row['id']?>')"></i>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Aucun equipe trouve.</p>";
                }
                ?>
            </div>
        </div> 
            `;
            container.innerHTML =htmlContent3;
        }
        function showArticles() {
            let htmlContent2 = ` 
            <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Services</h3>
            <div class="user-container" style="width:70%;height: 500px;overflow:auto;">
                
                <?php
                $sql = "SELECT * FROM articles";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['image1'] == NULL) {
                            $pdp = "images/defaultpdp.jpg";
                        } else {
                            $pdp = $row['image1'];
                        }
                ?>
                        <div class="user-card d-flex align-items-center" data-articles-id="<?php echo $row['id']; ?>">
                            <img src="<?php echo $pdp; ?>" alt="Profile Image">
                            <div class="user-info">
                                <h5><?php echo $row['libelle']; ?></h5>
                                <p><?php echo $row['categorie']; ?></p>
                            </div>
                            <div class="user-icons">
                                <i class="ri-delete-bin-fill" onclick="deleteItem(this, 'articles')"></i>
                                <i class="ri-eye-fill" onclick="showDetails(this, 'articles', '<?php echo $row['motif']; ?>', '<?php echo $row['dispo']; ?>','<?php echo $row['id'] ?>')"></i>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Aucun service trouve.</p>";
                }
                ?>
            </div>
        </div>  
            `;
            container.innerHTML =htmlContent2;
        }
        function deleteItem(element, entityType) {
    var entityId = element.parentNode.parentNode.getAttribute("data-" + entityType + "-id");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            console.log(response);
            if (response === "success") {
                element.parentNode.parentNode.remove();
            } else {
                console.error("Error deleting " + entityType + ".");
                console.log(response);
            }
        }
    };
    xhr.open("POST", "delete" + entityType + ".php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(entityType + "_id=" + entityId);
    console.log(entityId);
}
        function showDetailsEquipes(element,eid) {
            window.location.href = "details_equipe_perso.php?id="+eid;
        }
        function showDetailsArticles(element,entityType,motif,dispo=1,id=0) {
            if (motif == "Location") {
                if (dispo == "1") {
                    window.location.href = "details_art_" + motif + "_1.php?id=" + id;
                }else {
                    window.location.href = "details_art_" + motif + ".php?id=" + id;
                }
                
            }else if (motif == "Vente") {
                if (dispo == "1") {
                    window.location.href = "details_art_" + motif + "_1.php?id=" + id;
                }
                else {
                    window.location.href = "details_art_" + motif + ".php?id=" + id;
                }
            }
            

        }
</script>
</body>

</html>