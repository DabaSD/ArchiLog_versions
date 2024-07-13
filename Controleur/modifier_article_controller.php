<?php
require_once '../Model/dao/ArticleDao.php';
require_once '../Model/dao/CategorieDao.php';
require_once '../Controleur/controller.php';

// Vérification de l'existence du paramètre d'ID d'article
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Instanciation du DAO des articles et des catégories
    $articleDao = new ArticleDao();
    $categorieDao = new CategorieDao();

    // Récupération des détails de l'article à modifier
    $article = $articleDao->getArticleById($articleId);

    // Vérification si l'article existe
    if ($article) {
        // Récupération de la liste des catégories
        $categories = $categorieDao->getCategories();

        // Vérification de la soumission du formulaire de modification
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $categorie = $_POST['categorie'];

            // Mise à jour de l'article dans la base de données
            $success = $articleDao->updateArticle($articleId, $titre, $contenu, $categorie);

            if ($success) {
                // Redirection vers la page de détail de l'article après la mise à jour
                header("Location: index.php?action=article&id=" . $articleId);
                exit();
            } else {
                $error = "Erreur lors de la mise à jour de l'article.";
            }
        }
    } else {
        $error = "Article non trouvé.";
    }
} else {
    $error = "Identifiant d'article non spécifié.";
}

?>
