<?php

require_once('./connexion_bdd/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = ($_POST['pseudo'] ?? '');
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);


    if ($pseudo === '' || $mot_de_passe === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    $sql = "INSERT INTO utilisateurs
            (pseudo, mot_de_passe)
            VALUES
            (:pseudo, :mot_de_passe)";

    $stmt = $db->prepare($sql);

    $resultat = $stmt->execute([
        ':pseudo' => $pseudo,
        ':mot_de_passe' => $mot_de_passe

    ]);

}


    
    header('Location: connexion.php');
    exit();


?>