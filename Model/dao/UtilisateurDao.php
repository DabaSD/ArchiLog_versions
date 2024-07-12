<?php
// Importation des classes nécessaires
require_once '../Model/dao/ConnexionManager.php';
require_once '../Model/domaine/Utilisateur.php';

class UtilisateurDao {
    private $connexion;

    public function __construct() {
        // Récupération de la connexion à la base de données
        $this->connexion = ConnexionManager::getConnexion();
    }

    // Méthode pour ajouter un utilisateur
    public function ajouterUtilisateur(Utilisateur $utilisateur) {
        $sql = "INSERT INTO utilisateur (nom, email, role, mot_de_passe) VALUES (:nom, :email, :role, :mot_de_passe)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':nom', $utilisateur->getNom());
        $stmt->bindValue(':email', $utilisateur->getEmail());
        $stmt->bindValue(':role', $utilisateur->getRole());
        $stmt->bindValue(':mot_de_passe', $utilisateur->getMotDePasse());
        return $stmt->execute();
    }

    // Méthode pour récupérer un utilisateur par son ID
    public function getUtilisateurById($id) {
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Utilisateur($data['id'], $data['nom'], $data['email'], $data['role'], $data['mot_de_passe']);
        }
        return null;
    }

    // Méthode pour mettre à jour un utilisateur
    public function mettreAJourUtilisateur(Utilisateur $utilisateur) {
        $sql = "UPDATE utilisateur SET nom = :nom, email = :email, role = :role, mot_de_passe = :mot_de_passe WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $utilisateur->getId());
        $stmt->bindValue(':nom', $utilisateur->getNom());
        $stmt->bindValue(':email', $utilisateur->getEmail());
        $stmt->bindValue(':role', $utilisateur->getRole());
        $stmt->bindValue(':mot_de_passe', $utilisateur->getMotDePasse());
        return $stmt->execute();
    }

    // Méthode pour supprimer un utilisateur
    public function supprimerUtilisateur($id) {
        $sql = "DELETE FROM utilisateur WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les utilisateurs
    public function getAllUtilisateurs() {
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        $utilisateurs = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utilisateurs[] = new Utilisateur($data['id'], $data['nom'], $data['email'], $data['role'], $data['mot_de_passe']);
        }
        return $utilisateurs;
    }
}

