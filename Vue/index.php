<?php
// Inclusion du fichier Controller.php qui contient la définition de la classe Controller
require_once  '../Controleur/Controller.php';

// Création d'une nouvelle instance de la classe Controller
$controller = new Controller();

// Initialisation de la variable $articles
$articles = [];

// Vérification si la variable 'action' est définie dans l'URL
if (isset($_GET['action'])) {
    $action = strtolower($_GET['action']);
    
    // Utilisation d'un switch case pour traiter les différentes actions
    switch ($action) {
        case 'article':
            if (isset($_GET['id'])) {
                $articles = $controller->showArticle($_GET['id']);
            } else {
                // Si 'id' n'est pas défini, affichage de la page d'accueil
                $articles = $controller->showAccueil();
            }
            break;

        case 'categorie':
            if (isset($_GET['id'])) {
                $articles = $controller->showCategorie($_GET['id']);
            } else {
                // Si 'id' n'est pas défini, affichage de la page d'accueil
                $articles = $controller->showAccueil();
            }
            break;

        // Ajout des cas pour la gestion des utilisateurs
        case 'showutilisateurs':
            $utilisateurs = $controller->showUtilisateurs();
            break;

        case 'addutilisateurform':
            $controller->showAddUtilisateurForm();
            break;

        case 'ajouterutilisateur':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->ajouterUtilisateur($_POST['nom'], $_POST['email'], $_POST['role'], $_POST['motDePasse']);
            }
            break;

        case 'editutilisateurform':
            if (isset($_GET['id'])) {
                $controller->showEditUtilisateurForm($_GET['id']);
            }
            break;

        case 'mettreajourutilisateur':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->mettreAJourUtilisateur($_POST['id'], $_POST['nom'], $_POST['email'], $_POST['role'], $_POST['motDePasse']);
            }
            break;

        case 'supprimerutilisateur':
            if (isset($_GET['id'])) {
                $controller->supprimerUtilisateur($_GET['id']);
            }
            break;

        default:
            // Si 'action' n'est ni 'article' ni 'categorie', affichage de la page d'accueil
            $articles = $controller->showAccueil();
            break;
    }
} else {
    // Si 'action' n'est pas définie, affichage de la page d'accueil
    $articles = $controller->showAccueil();
}
?>
