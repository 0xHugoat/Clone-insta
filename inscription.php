<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Clone Insta</title>
    <link rel="stylesheet" href="./css/style-inscription.css">
</head>
<body>
    <main class="auth-container">
        <section class="auth-visual" aria-label="Aperçu du site">
            <div class="preview preview-one"><img src="assets/accueil.png" alt="Page d'accueil du site"></div>
            <div class="preview preview-two"><img src="assets/profil.png" alt="Page de profil du site"></div>
            <div class="preview preview-three"><img src="assets/publication.png" alt="Page de publication du site"></div>
        </section>
        <section class="auth-box">
            <h1>Créer un compte</h1>
            <p class="auth-subtitle">Rejoins la communauté.</p>
            <form action="traitement.php" method="POST" enctype="multipart/form-data">
                <label for="pseudo">Votre pseudo</label>
                <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo..." autocomplete="username" required>
                <label for="mot_de_passe">Votre mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe..." autocomplete="new-password" required>
                <button type="submit" name="create_profil">S'inscrire</button>
            </form>
            <p class="auth-login">Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
        </section>
    </main>
</body>
</html>