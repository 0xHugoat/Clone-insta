<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $photo = trim($_POST['modifierPhoto'] ?? '');
        $pseudo = trim($_POST['modifierPseudo'] ?? '');
        $description = trim($_POST['modifierBio'] ?? '');

        if ($pseudo === '' || $description === '' || $photo === '') {
            exit("Veuillez remplir les champs obligatoires.");
        }

        // Modifier image
        $nom = $_FILES['modifierPhoto']['name'];
        $tmp = $_FILES['modifierPhoto']['tmp_name'];
        $destination = "uploads/" . $nom;

        move_uploaded_file($tmp, $destination);

        $request = $db->query("UPDATE profils SET photo = '$destination'");

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
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="createPost">
        <div class="headTitreModif">
            <a href="./profil.php"><img src="./assets/Vector.png" alt=""></a>
            <h1 class="titreSettings">Créer votre propre post</h1>
        </div>
        <form action="modification-profil.php" method="POST" enctype="multipart/form-data">

            <div class="test">
                <div class="modifierPhoto">

                    <img src="<?= htmlspecialchars($user_post['photo']) ?>" alt="Photo">

                    <label for="modifierPhotoInput" class="btnPhoto">
                        Ajouter une photo
                    </label>

                    <input type="file" name="modifierPhoto" id="modifierPhotoInput" accept="image/*">

                </div>
            </div>

            <div class="textAreaBio">
                <textarea name="modifierBio" placeholder="Votre description de ce post...."></textarea>
            </div>

            <div class="bouttonRouge">
                <a href="deconnexion.php">Se déconnecter</a> <!--boutton pour se deconnecter et le redirige sur les inscriptions -->
                <a href="./inscription.php">Supprimer le compte</a> <!--boutton pour supprimer le compte et le redirige sur les inscriptions /////    name:supprimerCompte -->
            </div>

            <div class="enregistrerInformations">
                <input type="submit" value="Enregistrer" name="enregistrerInformations">
            </div>

        </form>
    </div>
    
</body>
</html>