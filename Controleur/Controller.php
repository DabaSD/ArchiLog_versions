<?php
require_once '../Model/dao/ConnexionManager.php';
require_once '../Model/dao/ArticleDao.php'; 
require_once '../Model/dao/CategorieDao.php'; 

class Controller {
    private $articleDao;
    private $categorieDao;

    public function __construct() {
        $this->articleDao = new ArticleDao();
        $this->categorieDao = new CategorieDao();
    }

    public function showAccueil($limit = 4, $page = 1) {
        $offset = ($page - 1) * $limit; // Offset pour la pagination
    
        // Récupération des articles paginés
        $articles = $this->articleDao->getArticles($limit, $offset);
        $totalArticles = $this->articleDao->getTotalArticlesCount();
        $totalPages = ceil($totalArticles / $limit);
    
        // Récupération de toutes les catégories
        $categories = $this->categorieDao->getCategories();
    
        // Retourner un tableau associatif avec les données nécessaires pour la vue accueil.php
        return [
            'articles' => $articles,
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page // Assurez-vous que $page est bien défini et transmis
        ];
    }
    

    // Méthode pour afficher un article spécifique
    public function showArticle($id) {
        $article = $this->articleDao->getArticleById($id); // Récupération de l'article par son id

        // Vérifier si l'article existe
        if ($article) {
            require '../Vue/article_detail.php'; // Inclusion de la vue pour afficher les détails de l'article
        } else {
            // Gérer le cas où l'article n'est pas trouvé (redirection, message d'erreur, etc.)
            echo "L'article demandé n'existe pas.";
        }
    }

    public function showCategorie($id, $limit = 4, $page = 1) {
        $articleDao = new ArticleDao();
        $categoryDao = new CategorieDao();
    
        $offset = ($page - 1) * $limit;
    
        // Récupération des articles par catégorie avec pagination
        $articles = $articleDao->getArticlesByCategorieId($id, $limit, $offset);
        $totalArticles = $articleDao->getTotalArticlesCountByCategorie($id);
        $totalPages = ceil($totalArticles / $limit);
    
        $categories = $categoryDao->getCategories();
    
        // Retourner un tableau associatif avec les données nécessaires pour la vue accueil.php
        return [
            'articles' => $articles,
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ];
    }
    
    


    public function getCategories() {
        $categoryDao = new CategorieDao();
        return $categoryDao->getCategories();
    }


    public function showArticleDetails($id) {
        $article = $this->articleDao->getArticleById($id); // Récupération de l'article par son id
    
        // Vérifier si l'article existe
        if ($article) {
            return $article;
        } else {
            // Gérer le cas où l'article n'est pas trouvé
            echo "L'article avec l'identifiant $id n'existe pas.";
            return null; // Retourner null si l'article n'est pas trouvé
        }
    }
    
}
?>
