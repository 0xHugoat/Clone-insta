<?php
session_start();

require_once('./connexion_bdd/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = trim($_POST['pseudo'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if ($pseudo === '' || $mot_de_passe === '') {
        exit("Veuillez remplir tous les champs.");
    }

    // Rechercher le pseudo dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE pseudo = :pseudo";

    $request = $db->prepare($sql);

    $request->execute([
        ':pseudo' => $pseudo
    ]);

    $utilisateur = $request->fetch(PDO::FETCH_ASSOC);

    // Vérifier le pseudo et le mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {

        // Connecter l'utilisateur
        session_regenerate_id(true);

        $_SESSION['utilisateurs_id'] = $utilisateur['id'];

        // Rediriger vers l'accueil
        header('Location: profil.php');
        exit();

    } else {
        echo "Pseudo ou mot de passe incorrect.";
    }
}
?>