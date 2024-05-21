<?php
    // Importation des classes nécessaires
    require_once '../Dao/ConnexionManager.php';
    require_once '../Dao/ArticleDao.php'; 
    require_once '../Dao/CategorieDao.php'; 

    // Définition de la classe Controller
    class Controller {

        // Constructeur de la classe
        public function __construct() {
        
        }

        // Méthode pour afficher la page d'accueil

        public function showAccueil() {

            $articleDao = new ArticleDao(); // Création d'un nouvel objet ArticleDao

            $categoryDao = new CategorieDao(); // Création d'un nouvel objet CategorieDao

            $articles = $articleDao->getArticles(); // Récupération de tous les articles

            $categories = $categoryDao->getCategories(); // Récupération de toutes les catégories

            require '../Vue/accueil.php'; // Inclusion de la vue accueil
        }



        // Méthode pour afficher un article spécifique


        public function showArticle($id){
            $articleDao = new ArticleDao(); // Création d'un nouvel objet ArticleDao

            $categoryDao = new CategorieDao(); // Création d'un nouvel objet CategorieDao

            $article = $articleDao->getArticleById($id); // Récupération de l'article par son id

            $categories = $categoryDao->getCategorieById(); // Récupération de la catégorie par son id

            require '../Vue/accueil.php'; // Inclusion de la vue accueil
        }



        // Méthode pour afficher une catégorie spécifique


        public function showCategorie($id){
            
            $articleDao = new ArticleDao(); // Création d'un nouvel objet ArticleDao

            $categoryDao = new CategorieDao(); // Création d'un nouvel objet CategorieDao

            $articles = $articleDao->getArticlesByCategorieId($id); // Récupération des articles par l'id de la catégorie

            $categories = $categoryDao->getCategories($id); // Récupération des catégories par leur id

            require '../Vue/accueil.php'; // Inclusion de la vue accueil
        }
    }
?>