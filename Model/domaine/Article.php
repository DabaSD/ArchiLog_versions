<?php
    // Définition de la classe Article


    class Article {
        private $id; // Identifiant de l'article
        private $titre; // Titre de l'article
        private $contenu; // Contenu de l'article
        private $categorie; // Catégorie de l'article
        private $dateCreation; // Date de création de l'article
        private $dateModification; // Date de modification de l'article



        // Constructeur de la classe

        public function __construct($id, $titre, $contenu, $categorie, $dateCreation, $dateModification) {
            $this->id = $id;
            $this->titre = $titre;
            $this->contenu = $contenu;
            $this->categorie = $categorie;
            $this->dateCreation = $dateCreation;
            $this->dateModification = $dateModification;
        }

        // Getters

        public function getId() {
            return $this->id;
        }

        public function getTitre() {
            return $this->titre;
        }

        public function getContenu() {
            return $this->contenu;
        }

        public function getCategorie() {
            return $this->categorie;
        }

        public function getDateCreation() {
            return $this->dateCreation;
        }

        public function getDateModification() {
            return $this->dateModification;
        }

        // Setters

        public function setId($id) {
            $this->id = $id;
        }

        public function setTitre($titre) {
            $this->titre = $titre;
        }

        public function setContenu($contenu) {
            $this->contenu = $contenu;
        }

        public function setCategorie($categorie) {
            $this->categorie = $categorie;
        }

        public function setDateCreation($dateCreation) {
            $this->dateCreation = $dateCreation;
        }

        public function setDateModification($dateModification) {
            $this->dateModification = $dateModification;
        }
    }
?>