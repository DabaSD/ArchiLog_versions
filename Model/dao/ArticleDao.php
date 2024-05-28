<?php
    // Importation des classes nécessaires
    require_once '../Model/dao/ConnexionManager.php'; 
    require_once  '../Model/domaine/Article.php'; 
    require_once  '../Model/domaine/Categorie.php'; 



    // Définition de la classe ArticleDao
    
    class ArticleDao {
        
        private $connexion; // Variable pour stocker la connexion à la base de données

        // Constructeur de la classe
        public function __construct() {

            // Récupération de la connexion à la base de données
            $this->connexion = ConnexionManager::getConnexion();

        }


        // Méthode pour récupérer un article par son id

        public function getArticleById($id) {

            // Préparation de la requête SQL
            $sql = "SELECT * FROM article WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);

            // Liaison de l'id à la requête SQL
            $stmt->bindValue(':id', $id);

            // Exécution de la requête
            $stmt->execute();

            // Récupération de l'article
            $row = $stmt->fetch();

            // Retour de l'article sous forme d'objet Article
            return new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
        }

        // Méthode pour récupérer tous les articles

        public function getArticles() {

            // Préparation de la requête SQL
            $sql = "SELECT * FROM article";
            $stmt = $this->connexion->query($sql);

            // Récupération de tous les articles
            $rows = $stmt->fetchAll();
            $articles = array();

            // Pour chaque article, création d'un objet Article et ajout à la liste des articles
            foreach ($rows as $row) {
                $articles[] = new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
            }

            // Retour de la liste des articles
            return $articles;
        }



        // Méthode pour récupérer tous les articles d'une catégorie spécifique

        public function getArticlesByCategorieId($id) {

            // Préparation de la requête SQL
            $sql = "SELECT * FROM article WHERE categorie = :id";
            $stmt = $this->connexion->prepare($sql);

            // Liaison de l'id de la catégorie à la requête SQL
            $stmt->bindValue(':id', $id);

            // Exécution de la requête
            $stmt->execute();

            // Récupération de tous les articles de la catégorie
            $rows = $stmt->fetchAll();
            $articles = array();

            // Pour chaque article, création d'un objet Article et ajout à la liste des articles
            foreach ($rows as $row) {
                $articles[] = new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
            }

            // Retour de la liste des articles de la catégorie
            return $articles;
        }

    }
?>