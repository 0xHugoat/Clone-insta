<?php

    require_once("connexion_bdd/connexion.php");
    
    session_start();

    $request = $db->query("SELECT utilisateurs.pseudo, profils.* FROM profils INNER JOIN utilisateurs ON profils.id_utilisateur = utilisateurs.id WHERE profils.id_utilisateur = ". (int)$_SESSION['utilisateurs_id']);
    $user = $request->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>

    <section>
        <div>
            <img src="<?php echo $user["photo"]; ?>" alt="image">
            <p><?php echo $user["pseudo"]; ?></p>
            <p><?php echo $user["likes"]; ?></p>
            <p><?php echo $user["followers"]; ?></p>
            <p><?php echo $user["description"]; ?></p>
        </div>
        <div>
            <?php
                $request = $db->query('SELECT * FROM posts WHERE id_utilisateur = '. $_SESSION['utilisateurs_id']);
                $posts = $request->fetchAll();

                foreach ($posts as $post) {
                    echo '
                            <div>
                                <div>
                                    <img src="'. $user["photo"] .'" alt="image">
                                    <div>
                                        <p class="pseudo">'. $user["pseudo"] .'</p>
                                        <p class="datetime">'. $post["date"] .'</p>
                                    </div>
                                </div>
                                <div>
                                    <img src="'. $post["photo"] .'" alt="image">
                                    <p>'. $post["description"] .'</p>
                                    <div>
                                        <a>Commentaires</a>
                                        <p>Like : <p>'. $post["nb_like"] .'</p></p>
                                    </div>
                                </div>
                            </div>
                    ';
                }
            ?>
        </div>
    </section>
    
</body>
</html>