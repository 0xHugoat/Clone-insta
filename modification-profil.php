<?php

session_start();
require_once('./connexion_bdd/connexion.php');
$_SESSION['utilisateurs_id'];

$request = $db->query("SELECT profils.*, utilisateurs.pseudo FROM profils INNER JOIN utilisateurs ON profils.id_utilisateur = utilisateurs.id WHERE id_utilisateur = " . $_SESSION['utilisateurs_id']);
$user_post = $request->fetch();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = trim($_POST['pseudo'] ?? '');
    $description = trim($_POST['description'] ?? '');


    if ($pseudo === '' || $description === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    $sql = "UPDATE profils SET
                description = :description,
            WHERE id_utilisateur = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':description' => $description,
        ':id' => $_SERVER['utilisateurs_id']
    ]);

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

<body>
    <h1>Modifier le profil</h1>
    <div class="test">
    <div class="modifierPhoto">
        <img src="<?= htmlspecialchars($user_post['photo']) ?>" alt="Photo de profil">

        <h2><?= htmlspecialchars($user_post['pseudo']) ?></h2>

        <label for="modifierPhotoInput" class="btnPhoto">
            Modifier la photo
        </label>

        <input type="file" name="modifierPhoto" id="modifierPhotoInput" accept="image/*">
    </div>
</div>
    <div class="mofidierPseudo">
        <input type="text" name="mofidierPseudo" id="" value="<?= htmlspecialchars($user_post['pseudo']) ?>">
    </div>
    <div class="textAreaBio">
        <textarea name="modifierBio"><?= htmlspecialchars($user_post['description']) ?></textarea>
    </div>
    <div class="bouttonRouge">
        <input type="text" value="Se deconnecter" name="deconnecter"> <!--boutton pour se deconnecter et le redirige sur les inscriptions -->
        <input type="text" value="Supprimer le compte" name="supprimerCompte"> <!--boutton pour supprimer le compte et le redirige sur les inscriptions -->
    </div>
    <div class="enregistrerInformations">
        <input type="submit" value="Enregistrer" name="enregistrerInformations"> <!--boutton pour enregistrer les modifications -->
    </div>
</body>

</html>