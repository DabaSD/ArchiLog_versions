<?php
    // Définition de la classe Categorie

    class Categorie {

        private $id; // Identifiant de la catégorie

        private $libelle; // Libellé de la catégorie


        // Constructeur de la classe

        public function __construct($id, $libelle) {

            $this->id = $id;
            $this->libelle = $libelle;
        }

        // Getter pour l'id

        public function getId() {
            return $this->id;
        }

        // Getter pour le libellé

        public function getLibelle() {
            return $this->libelle;
        }

        // Setter pour l'id

        public function setId($id) {
            $this->id = $id;
        }

        // Setter pour le libellé
        
        public function setLibelle($libelle) {
            $this->libelle = $libelle;
        }
    }
?>