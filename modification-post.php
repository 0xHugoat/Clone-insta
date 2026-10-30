<?php
    require_once("connexion_bdd/connexion.php");
    session_start();

    $request = $db->query('SELECT * FROM posts WHERE id = '. $_SESSION['id_post']);
    $post = $request->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $description = trim($_POST['modifierBio'] ?? '');

        // Modif du post
        $nom = $_FILES['modifierPhoto']['name'];
        $tmp = $_FILES['modifierPhoto']['tmp_name'];
        $destination = "uploads/" . $nom;

        move_uploaded_file($tmp, $destination);

        if ($_FILES['modifierPhoto']['error'] === UPLOAD_ERR_NO_FILE) {
            $destination = $post["photo"];
        }

        $request = $db->query("UPDATE posts SET description = '". $description ."', photo = '". $destination ."' WHERE id_utilisateur = '". $_SESSION["utilisateurs_id"] ."' AND  id = ". $_SESSION["id_post"]);

        header('Location: profil.php');
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
            <h1 class="titreSettings">Modifier votre post s'il ne vous plait pas</h1>
        </div>
        <form action="modification-post.php" method="POST" enctype="multipart/form-data">

            <div class="test">
                <div class="modifierPhoto">

                    <img src="<?= htmlspecialchars($post['photo']) ?>" alt="Photo">

                    <label for="modifierPhotoInput" class="btnPhoto">
                        Ajouter une photo
                    </label>

                    <input type="file" name="modifierPhoto" id="modifierPhotoInput" accept="image/*">

                </div>
            </div>

            <div class="textAreaBio">
                <textarea name="modifierBio"><?= htmlspecialchars($post['description']) ?></textarea>
            </div>

            <div class="bouttonRouge">
                <a href="delete-post.php">Supprimer le post</a> <!--boutton pour supprimer le compte et le redirige sur les inscriptions /////    name:supprimerCompte -->
            </div>

            <div class="enregistrerInformations">
                <input type="submit" value="Enregistrer" name="createPost">
            </div>

        </form>
    </div>
    
</body>
</html>