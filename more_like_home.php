<?php
    session_start();

    require_once("connexion_bdd/connexion.php");

    $request = $db->query("SELECT id_utilisateur FROM posts WHERE id = " . (int)$_GET['id_post']);
    $post = $request->fetch();

    $request = $db->query('SELECT id FROM likes_post WHERE id_utilisateur = '. $_SESSION['utilisateurs_id'] .' AND id_post = '. (int)$_GET['id_post']);
    $alreadyLike = $request->fetch();

    if (!$alreadyLike) {
        $request = $db->query('INSERT INTO likes_post (id_utilisateur, id_post) VALUES('. $_SESSION['utilisateurs_id'] .', '. (int)$_GET['id_post'] .')');
        $request = $db->query('UPDATE posts SET nb_like = nb_like + 1 WHERE id = ' . (int)$_GET['id_post']);
        $request = $db->query('UPDATE profils SET likes = likes + 1 WHERE id_utilisateur = ' . $post['id_utilisateur']);
    }
    else {
        $request = $db->query('DELETE FROM likes_post WHERE id_utilisateur = '. $_SESSION['utilisateurs_id'] .' AND id_post = '. (int)$_GET['id_post']);
        $request = $db->query('UPDATE posts SET nb_like = nb_like - 1 WHERE id = ' . (int)$_GET['id_post']);
        $request = $db->query('UPDATE profils SET likes = likes - 1 WHERE id_utilisateur = ' . $post['id_utilisateur']);
    }
?>