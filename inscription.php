<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Inscription - MiniChat</title>
</head>

<body>

    <div class="auth-container">
        <div class="auth-box">

            <h1>Créer un compte</h1>

            <form action="traitement.php" method="POST" enctype="multipart/form-data">


                <label for="pseudo">Votre pseudo</label>
                <input type="text" id="pseudo" name="pseudo"
                    placeholder="Entrez votre pseudo..." required>



                <label for="password">Votre mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe"
                    placeholder="Entrez votre mot de passe..."
                    autocomplete="new-password" required>

                <button type="submit" name="create_profil">
                    S'inscrire
                </button>

            </form>

            <p>
                Déjà un compte ?
                <a href="connexion.php">Se connecter</a>
            </p>

        </div>
    </div>

</body>

</html>