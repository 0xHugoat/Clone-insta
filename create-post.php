<?php
    require_once("connexion_bdd/connexion.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $description = trim($_POST['modifierBio'] ?? '');

        if ($_FILES['modifierPhoto']['error'] === UPLOAD_ERR_NO_FILE) {
            die("Veuillez sélectionner une photo.");
        }

        // Ajout du post
        $nom = $_FILES['modifierPhoto']['name'];
        $tmp = $_FILES['modifierPhoto']['tmp_name'];
        $destination = "uploads/" . $nom;

        move_uploaded_file($tmp, $destination);

        $request = $db->query("INSERT INTO posts (id_utilisateur, description, photo, nb_like) VALUES('".$_SESSION["utilisateurs_id"] ."', '". $description ."', '". $destination ."', 0)");

        $_SESSION["id_post"] = $db->lastInsertId();
        header('Location: post.php');
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
        <form action="create-post.php" method="POST" enctype="multipart/form-data">

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

            <div class="enregistrerInformations">
                <input type="submit" value="Enregistrer" name="createPost">
            </div>

        </form>
    </div>
    
</body>
</html>