<?php
// Importation des classes nécessaires
require_once '../Model/dao/ConnexionManager.php'; 
require_once '../Model/domaine/Categorie.php'; 

class CategorieDao {
    private $connexion; 

    // Constructeur de la classe
    public function __construct() {
        $this->connexion = ConnexionManager::getConnexion();
    }

    // Méthode pour récupérer une catégorie par son id
    public function getCategorieById($id) {
        $sql = "SELECT * FROM categorie WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        return new Categorie($row['id'], $row['libelle']);
    }

    // Méthode pour récupérer toutes les catégories
    public function getCategories() {
        $sql = "SELECT * FROM categorie";
        $stmt = $this->connexion->query($sql);
        $rows = $stmt->fetchAll();
        $categories = array();
        foreach ($rows as $row) {
            $categories[] = new Categorie($row['id'], $row['libelle']);
        }
        return $categories;
    }

    public function ajouterCategorie($libelle) {
        $sql = "INSERT INTO categorie (libelle) VALUES (:libelle)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCategorie($id, $libelle) {
        $query = "UPDATE categorie SET libelle = :libelle WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':libelle', $libelle);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function supprimerCategorie($id) {
        $query = "DELETE FROM categorie WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
