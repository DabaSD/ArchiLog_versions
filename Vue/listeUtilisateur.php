<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="listeUtilisateur.css">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <header>
        <h1>Liste des utilisateurs</h1>
    </header>
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur->getNom()) ?></td>
                    <td><?= htmlspecialchars($utilisateur->getEmail()) ?></td>
                    <td><?= htmlspecialchars($utilisateur->getRole()) ?></td>
                    <td>
                        <a href="?action=editUtilisateurForm&id=<?= $utilisateur->getId() ?>">Modifier</a>
                        <a href="?action=supprimerUtilisateur&id=<?= $utilisateur->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="button-container">
        <a href="?action=accueil" class="btn-retour">Retour</a>
        <a href="?action=addUtilisateurForm" class="btn-ajouter">Ajouter un utilisateur</a>
    </div>
</body>
</html>