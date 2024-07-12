<?php
    // Importation des classes nécessaires
    require_once  '../Model/dao/ConnexionManager.php';
    require_once  '../Model/dao/ArticleDao.php';
    require_once  '../Model/dao/CategorieDao.php';
    require_once  '../Model/dao/UtilisateurDao.php';
    require_once  '../Model/domaine/Utilisateur.php';

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

        // Affiche la liste des utilisateurs
        function showUtilisateurs() {
            $utilisateurDao = new UtilisateurDao();
            $utilisateurs = $utilisateurDao->getAllUtilisateurs();

            require '../Vue/listeUtilisateur.php';
        }

        // Affiche un formulaire pour ajouter un utilisateur
        function showAddUtilisateurForm() {
            require '../Vue/ajouterUtilisateur.php';
        }

        // Ajoute un utilisateur
        function ajouterUtilisateur($nom, $email, $role, $motDePasse) {
            $utilisateurDao = new UtilisateurDao();
            $utilisateur = new Utilisateur(null, $nom, $email, $role, $motDePasse);
            $resultat = $utilisateurDao->ajouterUtilisateur($utilisateur);
            if ($resultat) {
                header('Location: ?action=showutilisateurs');
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur.";
            }
        }

        // Affiche un formulaire pour modifier un utilisateur
        function showEditUtilisateurForm($id) {
            $utilisateurDao = new UtilisateurDao();
            $utilisateur = $utilisateurDao->getUtilisateurById($id);

            require '../Vue/ajouterUtilisateur.php';
        }

        // Modifie un utilisateur
        function mettreAJourUtilisateur($id, $nom, $email, $role, $motDePasse) {
            $utilisateurDao = new UtilisateurDao();
            $utilisateur = new Utilisateur($id, $nom, $email, $role, $motDePasse);
            $resultat = $utilisateurDao->mettreAJourUtilisateur($utilisateur);
            if ($resultat) {
                header('Location: ?action=showutilisateurs');
            } else {
                echo "Erreur lors de la mise à jour de l'utilisateur.";
            }
        }

        // Supprime un utilisateur
        function supprimerUtilisateur($id) {
            $utilisateurDao = new UtilisateurDao();
            $resultat = $utilisateurDao->supprimerUtilisateur($id);
            if ($resultat) {
                header('Location: ?action=showutilisateurs');
            } else {
                echo "Erreur lors de la suppression de l'utilisateur.";
            }
        }


    }
