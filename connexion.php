<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Clone Insta</title>
    <link rel="stylesheet" href="./css/style-inscription.css">
</head>
<body>
    <main class="auth-container">
        <section class="auth-visual" aria-label="Aperçu de Clone Insta">
            <div class="preview preview-one"><img src="assets/accueil.png" alt="Capture de l'accueil"></div>
            <div class="preview preview-two"><img src="assets/profil.png" alt="Capture du profil"></div>
            <div class="preview preview-three"><img src="assets/publication.png" alt="Capture d'une publication"></div>
        </section>
        <section class="auth-box">
            <h1>Bon retour !</h1>
            <p class="auth-subtitle">Connecte-toi à ton compte.</p>
            <form action="traitement-connexion.php" method="POST">
                <label for="pseudo">Votre pseudo</label>
                <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo..." required>
                <label for="mot_de_passe">Votre mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe..." required>
                <button type="submit">Se connecter</button>
            </form>
            <p class="auth-login">Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
        </section>
    </main>
</body>
</html>