<?php
require_once '../Model/dao/ConnexionManager.php';
require_once '../Model/domaine/Article.php';

class ArticleDao {
    private $connexion;

    public function __construct() {
        $this->connexion = ConnexionManager::getConnexion();
    }

    public function getArticleById($id) {
        $sql = "SELECT * FROM article WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        return new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
    }

    public function getArticles($limit, $offset) {
        $query = "SELECT * FROM article ORDER BY dateCreation DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Utilisation de FETCH_ASSOC pour récupérer un tableau associatif
    
        $articles = [];
        foreach ($rows as $row) {
            // Création d'un nouvel objet Article en utilisant les données du tableau associatif
            $articles[] = new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
        }
    
        return $articles;
    }

    public function getTotalArticlesCount() {
        $query = "SELECT COUNT(*) as total FROM article";
        $stmt = $this->connexion->query($query);
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }

    public function getArticlesByCategorieId($id, $limit, $offset) {
        $sql = "SELECT * FROM article WHERE categorie = :id ORDER BY dateCreation DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Utilisation de FETCH_ASSOC pour récupérer un tableau associatif
    
        $articles = [];
        foreach ($rows as $row) {
            // Création d'un nouvel objet Article en utilisant les données du tableau associatif
            $articles[] = new Article($row['id'], $row['titre'], $row['contenu'], $row['categorie'], $row['dateCreation'], $row['dateModification']);
        }
    
        return $articles;
    }

    public function getTotalArticlesCountByCategorie($categorieId) {
        $query = "SELECT COUNT(*) as total FROM article WHERE categorie = :categorieId";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }


    public function updateArticle($id, $titre, $contenu, $categorie) {
        $sql = "UPDATE article SET titre = :titre, contenu = :contenu, categorie = :categorie, dateModification = NOW() WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':contenu', $contenu);
        $stmt->bindValue(':categorie', $categorie);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    
    public function ajouterArticle($titre, $contenu, $categorie, $dateCreation) {
        $sql = "INSERT INTO article (titre, contenu, categorie, dateCreation) VALUES (?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$titre, $contenu, $categorie, $dateCreation]);

        // Vérifiez si l'insertion a réussi
        if ($stmt->rowCount() > 0) {
            // Récupération de l'ID de l'article inséré
            return $this->connexion->lastInsertId();
        } else {
            return false;
        }
    }

    public function getLastInsertedId() {
        return $this->connexion->lastInsertId();
    }
}
?>
