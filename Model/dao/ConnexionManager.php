<?php
    // Définition de la classe ConnexionManager
    class ConnexionManager {

        private $connexion; 
        private static $instance = null; // Instance unique de la classe (Singleton)



        // Constructeur de la classe

        public function __construct() {

            // Création d'une nouvelle connexion PDO
            $this->connexion = new PDO(
                "mysql:host=localhost;dbname=mglsi_news", // Chaîne de connexion
                "mglsi_user", // Nom d'utilisateur
                "passer" // Mot de passe
            );



            // Configuration de la connexion

            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activation des exceptions

            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut

            $this->connexion->exec("SET NAMES 'UTF8'"); // Encodage en UTF-8
        }


        
        // Méthode pour obtenir la connexion

        public static function getConnexion() {

            // Si l'instance n'existe pas encore, on la crée
            if (self::$instance == null) {
                self::$instance = new ConnexionManager();
            }

            // On retourne la connexion
            return self::$instance->connexion;
        }
    }
?>