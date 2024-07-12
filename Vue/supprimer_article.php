<?php
// Inclusion du fichier index.php pour les configurations initiales et la récupération des données
require_once 'index.php';

// Vérification si l'ID de l'article à supprimer est passé en GET
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    
    // Instanciation du DAO des articles
    $articleDao = new ArticleDao();

    // Suppression de l'article
    $success = $articleDao->supprimerArticle($articleId);

    if ($success) {
        // Redirection vers la page d'accueil ou une autre page après suppression
        header("Location: liste_categories.php");
        exit();
    } else {
        echo '<p>Erreur lors de la suppression de l\'article.</p>';
    }
} else {
    echo '<p>Aucun ID d\'article spécifié pour la suppression.</p>';
}
?>
