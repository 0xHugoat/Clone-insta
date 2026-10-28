<?php 
    require_once("connexion_bdd/connexion.php");

    session_start();

    $request = $db->query('SELECT id FROM likes_post WHERE id_utilisateur = '. $_SESSION['utilisateurs_id'] .' AND id_post = '. $_SESSION['id_post']);
    $alreadyLike = $request->fetch();


    $request = $db->query('SELECT * FROM posts WHERE id = '. $_SESSION['id_post']);
    $post = $request->fetch();
    $request = $db->query("SELECT profils.*, utilisateurs.pseudo FROM profils INNER JOIN utilisateurs ON profils.id_utilisateur = utilisateurs.id WHERE id_utilisateur = " . $post['id_utilisateur']);
    $user_post = $request->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<script>
    function like() {
        let img = document.getElementById("likeImg");

        let nbLike = document.getElementById("nbLike");
        let nb = parseInt(nbLike.textContent);

        if (img.src.includes("Not-Like.png")) {
            img.src = "assets/Like.png";
            nbLike.textContent = (nb + 1) + " j'aime";
            fetch("more_like.php");
        } else {
            img.src = "assets/Not-Like.png";
            nbLike.textContent = (nb - 1) + " j'aime";
            fetch("more_like.php");
        }
    }
</script>

<body class="post">
    <section>
        <a href="profil.php" class="return"><img src="assets/Vector.png"></a>
        <div class="post_all">
            <img src="<?php echo $post["photo"]; ?>" alt="image" class="img_post">
            <div class="post-description-all">
                <div class="post-user">
                    <img src="<?php echo $user_post["photo"]; ?>" alt="image" class="user">
                    <p><?php echo $user_post["pseudo"]; ?></p>
                </div>
                <div class="description-post">
                    <p><?php echo $post["description"]; ?></p>
                    <div class="likeAndtime">
                        <div class="like">
                            <img id="likeImg" src="assets/<?php echo $alreadyLike ? 'Like.png' : 'Not-Like.png'; ?>" onclick="like()">
                            <p id="nbLike"><?php echo $post['nb_like']; ?> j'aime</p>
                        </div>
                        <p><?php echo date('H:i:s d/m/Y', strtotime($post['date'])); ?></p>
                    </div>
                </div>
                <div class="commentaire">

                </div>
            </div>
        </div>
    </section>
</body>
</html>