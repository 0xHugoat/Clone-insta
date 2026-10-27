<?php

    require_once("connexion_bdd/connexion.php");
    
    session_start();

    $request = $db->query("SELECT utilisateurs.pseudo, profils.* FROM profils INNER JOIN utilisateurs ON profils.id_utilisateur = utilisateurs.id WHERE profils.id_utilisateur = ". (int)$_SESSION['utilisateurs_id']);
    $user = $request->fetch();

    if (isset($_GET["post"])) {
        $_SESSION["id_post"] = (int)$_GET["post"];
        header('Location: post.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Profil</title>
</head>
<body class="profil">
    <div id="menu" class="menu">
        <nav>
            <a href="">Recherche</a>
            <a href="#home">Acceuil</a>
            <a href="">Mes likes</a>
            <a href="#home">Profil</a>
            <a href="#home">Créer</a>
        </nav>
    </div>

    <section>
        <div class="profil-user">
            <div class="profil-user-img">
                <img class="image" src="<?php echo $user["photo"]; ?>" alt="image">
                <div class="profil-user-pseudo">
                    <p class="bold-text pseudo"><?php echo $user["pseudo"]; ?></p>
                    <a href="modification-profil.php"><img src="./assets/setting-lines 1.png" alt=""></a>
                    <div class="profil-user-stats">
                        <div>
                            <p class="bold-text"><?php echo $user["likes"]; ?></p>
                            <p>Posts</p>
                        </div>
                        <div class="mid-stat">
                            <p class="bold-text"><?php echo $user["followers"]; ?></p>
                            <p>followers</p>
                        </div>
                        <div>
                            <p class="bold-text"><?php echo $user["likes"]; ?></p>
                            <p>likes</p>
                        </div>
                    </div>
                </div>
            </div>
            <p><?php echo $user["description"]; ?></p>
        </div>
        <hr>
        <div class="posts-user">
            <?php
                $request = $db->query('SELECT * FROM posts WHERE id_utilisateur = '. $_SESSION['utilisateurs_id']);
                $posts = $request->fetchAll();

                foreach ($posts as $post) {
                    echo '
                            <a href="?post='.$post["id"].'"  class="card-post">
                                <img src="'. $post["photo"] .'" alt="image">
                            </a>
                    ';
                }
            ?>
        </div>
    </section>
    
</body>
</html>