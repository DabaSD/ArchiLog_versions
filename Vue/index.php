<?php

// Inclusion du fichier Controller.php qui contient la définition de la classe Controller
require_once '../Controleur/Controller.php';

// Création d'une nouvelle instance de la classe Controller
$controller = new Controller();

// Vérification si la variable 'action' est définie dans l'URL
if (isset($_GET['action'])) {
    $action = strtolower($_GET['action']);
    
    // Utilisation d'un switch case pour traiter les différentes actions
    switch ($action) {
        case 'article':
            if (isset($_GET['id'])) {
                $controller->showArticle($_GET['id']);
            } else {
                // Si 'id' n'est pas défini, affichage de la page d'accueil
                echo "ID pour 'article' non défini. Redirection vers l'accueil.";
                $controller->showAccueil();
            }
            break;

        case 'categorie':
            if (isset($_GET['id'])) {
                $controller->showCategorie($_GET['id']);
            } else {
                // Si 'id' n'est pas défini, affichage de la page d'accueil
                echo "ID pour 'categorie' non défini. Redirection vers l'accueil.";
                $controller->showAccueil();
            }
            break;

        default:
            // Si 'action' n'est ni 'article' ni 'categorie', affichage de la page d'accueil
            echo "Action non reconnue. Redirection vers l'accueil.";
            $controller->showAccueil();
            break;
    }
} else {
    // Si 'action' n'est pas définie, affichage de la page d'accueil
    echo "Action non définie. Affichage de la page d'accueil.";
    $controller->showAccueil();
}

?>
