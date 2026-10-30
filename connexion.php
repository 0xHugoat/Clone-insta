<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>

<body>
    <div class="auth-container">
    <div class="auth-box">

        <h1>Se connecter</h1>

        <form action="traitement-connexion.php" method="POST" enctype="multipart/form-data">


            <label for="pseudo">Votre pseudo</label>
            <input type="text" id="pseudo" name="pseudo"
                placeholder="Entrez votre pseudo..." required>



            <label for="password">Votre mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe"
                placeholder="Entrez votre mot de passe..."
                required>

            <button type="submit" name="connexion">
                Se connecter
            </button>

        </form>


    </div>
    </div>
</body>

</html>