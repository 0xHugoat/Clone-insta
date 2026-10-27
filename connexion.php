<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>
<body>
    <form action="traitement-connexion.php" method="POST">
        <label for="pseudo">Votre pseudo</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo..." required>

        <label for="mot_de_passe">Votre mot de passe</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>

        <button type="submit" name="connexion">Se connecter</button>
    </form>
</body>
</html>