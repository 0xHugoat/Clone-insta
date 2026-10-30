<?php

    require_once('./connexion_bdd/connexion.php');
    session_start();

    $request = $db->query('DELETE FROM utilisateurs WHERE id = '. $_SESSION['utilisateurs_id']);

    $_SESSION = [];
    session_destroy();

    header('Location: inscription.php');
    exit();
?>