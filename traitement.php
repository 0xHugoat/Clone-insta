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

    $id_utilisateur = $db->lastInsertId();

    $stmt = $db->prepare("
        INSERT INTO profils
        (id_utilisateur, photo, description, likes, followers)
        VALUES
        (:id, :photo, :description, 0, 0)
    ");

    $stmt->execute([
        ':id' => $id_utilisateur,
        ':photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSqta2IJ3mdGZGeAYp4RrmM0LB6UKRt2PVShf_3Q5QYTC-ZYDSL4wFS6E&s=10',
        ':description' => 'Ma description'
    ]);

}


    
    header('Location: connexion.php');
    exit();


?>