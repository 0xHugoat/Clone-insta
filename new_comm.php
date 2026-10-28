<?php 
    require_once("connexion_bdd/connexion.php");

    session_start();

    $request = $db->query("INSERT INTO comments (id_utilisateur, id_post, commentaire) VALUES('". $_SESSION["utilisateurs_id"] ."','". $_SESSION["id_post"] ."','". $_POST["commentaire"] ."')");
?>