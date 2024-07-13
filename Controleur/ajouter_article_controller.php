<?php
require_once '../Model/dao/ArticleDao.php';
require_once '../Model/dao/CategorieDao.php';
require_once '../Controleur/controller.php';

$error = '';

// Instanciation du DAO des articles et des catégories
$articleDao = new ArticleDao();
$categorieDao = new CategorieDao();

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorieId = $_POST['categorie'];
    
    // Récupération de la date de création automatique
    $dateCreation = date('Y-m-d H:i:s'); // Utilisation de la date et heure actuelles

    // Validation des données (vous pouvez ajouter une validation ici)

    // Ajout du nouvel article dans la base de données
    $success = $articleDao->ajouterArticle($titre, $contenu, $categorieId, $dateCreation);

    if ($success) {
        // Récupération de l'identifiant de l'article nouvellement inséré
        $articleId = $articleDao->getLastInsertedId(); // À adapter selon votre méthode dans ArticleDao
        
        // Redirection vers la page de détail de l'article après l'ajout
        header("Location: index.php?action=article&id=" . $articleId);
        exit();
    } else {
        $error = "Erreur lors de l'ajout de l'article.";
    }
}

// Récupération de la liste des catégories pour affichage dans le formulaire
$categories = $categorieDao->getCategories();

// Affichage de l'erreur s'il y en a une
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>
