<?php
    // Importation des classes nécessaires
    require_once '../Model/dao/ConnexionManager.php'; 
    require_once '../Model/domaine/Categorie.php'; 



    // Définition de la classe CategorieDao
    class CategorieDao {
        private $connexion; 

        // Constructeur de la classe
        public function __construct() {

            // Récupération de la connexion à la base de données
            $this->connexion = ConnexionManager::getConnexion();
        }




        // Méthode pour récupérer une catégorie par son id

        public function getCategorieById($id) {

            // Préparation de la requête SQL
            $sql = "SELECT * FROM categorie WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);

            // Liaison de l'id à la requête SQL
            $stmt->bindValue(':id', $id);

            // Exécution de la requête
            $stmt->execute();

            // Récupération de la catégorie
            $row = $stmt->fetch();

            // Retour de la catégorie sous forme d'objet Categorie
            return new Categorie($row['id'], $row['libelle']);
        }



        // Méthode pour récupérer toutes les catégories

        public function getCategories() {

            // Préparation de la requête SQL
            $sql = "SELECT * FROM categorie";
            $stmt = $this->connexion->query($sql);

            // Récupération de toutes les catégories
            $rows = $stmt->fetchAll();
            $categories = array();

            // Pour chaque catégorie, création d'un objet Categorie et ajout à la liste des catégories
            foreach ($rows as $row) {
                $categories[] = new Categorie($row['id'], $row['libelle']);
            }
            // Retour de la liste des catégories
            return $categories;
        }
    }
?>