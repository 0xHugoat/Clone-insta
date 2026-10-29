<?php

require_once("connexion_bdd/connexion.php");

session_start();

    $request = $db->query("SELECT utilisateurs.pseudo, profils.* FROM profils INNER JOIN utilisateurs ON profils.id_utilisateur = utilisateurs.id WHERE profils.id_utilisateur = ". (int)$_SESSION['utilisateurs_id']);
    $user = $request->fetch();

if (!isset($_SESSION['utilisateurs_id'])) {
    header('Location: connexion.php');
    exit();
}

$request = $db->query('SELECT * FROM posts ORDER BY date DESC');
$posts = $request->fetchAll();

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
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="home">
    <div id="menu" class="menu">
        <nav>
            <a class="menu_choices" href="./home.php"><img src="assets/Home.png" alt="home"><p>Acceuil</p></a>
            <a class="menu_choices" href="./profil.php"><img src="assets/Profile.png" alt="home"><p>Profil</p></a>
            <a class="menu_choices" href=""><img src="assets/Create.png" alt="home"><p>Créer</p></a>
        </nav>
    </div>

<div class="headMenu">
    <h1>Bienvenue <?= htmlspecialchars($user['pseudo']) ?> !</h1>

    <div class="profil-user-stats">
        <h2><?= htmlspecialchars($user['pseudo']) ?></h2>

        <div>
            <p class="bold-text">
                <?php
                $request = $db->prepare("SELECT COUNT(*) FROM posts WHERE id_utilisateur = :id");
                $request->execute([':id' => $_SESSION['utilisateurs_id']]);
                echo $request->fetchColumn();
                ?>
            </p>
            <p>posts</p>
        </div>

        <div>
            <p class="bold-text"><?= $user['followers'] ?></p>
            <p>followers</p>
        </div>

        <div>
            <p class="bold-text"><?= $user['likes'] ?></p>
            <p>likes</p>
        </div>
    </div>
</div>

<div class="feed">
    <?php foreach ($posts as $post):

        $request = $db->prepare("
            SELECT profils.photo, utilisateurs.pseudo
            FROM profils
            INNER JOIN utilisateurs
            ON profils.id_utilisateur = utilisateurs.id
            WHERE profils.id_utilisateur = :id
        ");

        $request->execute([
            ':id' => $post['id_utilisateur']
        ]);

        $user_post = $request->fetch();

        if (!$user_post) {
            continue;
        }

        $request = $db->prepare("
            SELECT COUNT(*)
            FROM likes_post
            WHERE id_post = :id_post
            AND id_utilisateur = :id_utilisateur
        ");

        $request->execute([
            ':id_post' => $post['id'],
            ':id_utilisateur' => $_SESSION['utilisateurs_id']
        ]);

        $alreadyLike = $request->fetchColumn() > 0;
    ?>

    <div class="publication">

        <a href="?post=<?= (int)$post['id'] ?>" class="card-post">
            <img src="<?= htmlspecialchars($post['photo']) ?>" alt="Publication">
        </a>

        <div class="publication-info">

            <img
                class="publication-avatar"
                src="<?= htmlspecialchars($user_post['photo']) ?>"
                alt="Profil"
            >

            <p class="publication-pseudo">
                <?= htmlspecialchars($user_post['pseudo']) ?>
            </p>

            <img
                class="likeImg"
                src="assets/<?= $alreadyLike ? 'Like.png' : 'Not-Like.png' ?>"
                alt="Like"
            >

            <p class="nbLike">
                <?= (int)$post['nb_like'] ?> j'aime
            </p>

            <p class="publication-date">
                <?= date('d/m/Y', strtotime($post['date'])) ?>
            </p>

        </div>
    </div>

    <?php endforeach; ?>
</div>

</body>

</html>