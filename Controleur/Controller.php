<?php
    // Importation des classes nécessaires
    require_once  '../Model/dao/ConnexionManager.php';
    require_once  '../Model/dao/ArticleDao.php';
    require_once  '../Model/dao/CategorieDao.php';
    require_once  '../Model/dao/UtilisateurDao.php';
    require_once  '../Model/domaine/Utilisateur.php';

    // Définition de la classe Controller
    class Controller {

        private $articleDao;
        private $categorieDao;

        public function __construct() {
            $this->articleDao = new ArticleDao();
            $this->categorieDao = new CategorieDao();
        }


        // Méthode pour afficher la page d'accueil
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


?>
