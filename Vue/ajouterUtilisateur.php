<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/ajouterUtilisateur.css">
    <title><?= isset($utilisateur) ? "Modifier" : "Ajouter" ?> un utilisateur</title>
</head>
<body>
    <header>
        <h1><?= isset($utilisateur) ? "Modifier" : "Ajouter" ?> un utilisateur</h1>
    </header> 
    <form action="?action=<?= isset($utilisateur) ? "mettreAJourUtilisateur&id=" . $utilisateur->getId() : "ajouterUtilisateur" ?>" method="POST">
        <?php if (isset($utilisateur)): ?>
            <input type="hidden" name="id" value="<?= $utilisateur->getId() ?>">
        <?php endif; ?>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required value="<?= isset($utilisateur) ? htmlspecialchars($utilisateur->getNom()) : "" ?>"><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required value="<?= isset($utilisateur) ? htmlspecialchars($utilisateur->getEmail()) : "" ?>"><br><br>

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required><br><br>

        <label for="role">Rôle :</label>
        <select id="role" name="role" required>
            <option value="administrateur" <?= isset($utilisateur) && $utilisateur->getRole() == "administrateur" ? "selected" : "" ?>>Administrateur</option>
            <option value="editeur" <?= isset($utilisateur) && $utilisateur->getRole() == "editeur" ? "selected" : "" ?>>Éditeur</option>
            <option value="visiteur" <?= isset($utilisateur) && $utilisateur->getRole() == "visiteur" ? "selected" : "" ?>>Visiteur</option>
        </select><br><br>

        <button type="submit"><?= isset($utilisateur) ? "Modifier" : "Ajouter" ?> l'utilisateur</button>
    </form>
</body>
</html>