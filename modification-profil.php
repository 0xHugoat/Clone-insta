<?php

session_start();
require_once('./connexion_bdd/connexion.php');

if (!isset($_SESSION['utilisateurs_id'])) {
    header('Location: connexion.php');
    exit();
}

$id = $_SESSION['utilisateurs_id'];

// Récupérer les informations du profil
$request = $db->prepare("
    SELECT profils.*, utilisateurs.pseudo
    FROM profils
    INNER JOIN utilisateurs
    ON profils.id_utilisateur = utilisateurs.id
    WHERE profils.id_utilisateur = :id
");

$request->execute([
    ':id' => $id
]);

$user_post = $request->fetch();

if (!$user_post) {
    exit("Profil introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = trim($_POST['modifierPseudo'] ?? '');
    $description = trim($_POST['modifierBio'] ?? '');

    if ($pseudo === '' || $description === '') {
        exit("Veuillez remplir les champs obligatoires.");
    }

    // Modifier image
    $nom = $_FILES['modifierPhoto']['name'];
    $tmp = $_FILES['modifierPhoto']['tmp_name'];
    $destination = "uploads/" . $nom;

    if ($_FILES['modifierPhoto']['error'] === UPLOAD_ERR_NO_FILE) {
        $destination = $user_post["photo"];
    }

    move_uploaded_file($tmp, $destination);

    $request = $db->query("UPDATE profils SET photo = '$destination' WHERE id_utilisateur = '$id'");

    // Modifier le pseudo
    $sql = "UPDATE utilisateurs SET pseudo = :pseudo WHERE id = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':pseudo' => $pseudo,
        ':id' => $id
    ]);

    // Modifier la description
    $sql = "UPDATE profils SET description = :description WHERE id_utilisateur = :id";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':description' => $description,
        ':id' => $id
    ]);

    header('Location: modification-profil.php');
    exit();
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
    <div class="modificationProfil">
        <div class="headTitreModif">
            <a href="./profil.php"><img src="./assets/Vector.png" alt=""></a>
            <h1 class="titreSettings">Modifier le profil</h1>
        </div>
        <form action="modification-profil.php" method="POST" enctype="multipart/form-data">

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
                <input
                    type="text"
                    name="modifierPseudo"
                    value="<?= htmlspecialchars($user_post['pseudo']) ?>">
            </div>

            <div class="textAreaBio">
                <textarea name="modifierBio"><?= htmlspecialchars($user_post['description']) ?></textarea>
            </div>

            <div class="bouttonRouge">
                <a href="deconnexion.php">Se déconnecter</a> <!--boutton pour se deconnecter et le redirige sur les inscriptions -->
                <a href="delete-compte.php">Supprimer le compte</a> <!--boutton pour supprimer le compte et le redirige sur les inscriptions /////    name:supprimerCompte -->
            </div>

            <div class="enregistrerInformations">
                <input type="submit" value="Enregistrer" name="enregistrerInformations">
            </div>

        </form>
    </div>
</body>

</html>