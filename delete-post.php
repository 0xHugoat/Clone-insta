<?php

    require_once('./connexion_bdd/connexion.php');
    session_start();

    $request = $db->query('DELETE FROM posts WHERE id = '. $_SESSION['id_post']);

    header('Location: profil.php');
    exit();
?>