<?php
// Inclusion du fichier Controller.php qui contient la définition de la classe Controller
require_once  '../Controleur/Controller.php';

// Création d'une nouvelle instance de la classe Controller
$controller = new Controller();

$action = isset($_GET['action']) ? $_GET['action'] : 'accueil';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$articlesData = [];

// Vérification si la variable 'action' est définie dans l'URL
if (isset($_GET['action'])) {
    $action = strtolower($_GET['action']);
    
    // Utilisation d'un switch case pour traiter les différentes actions
    switch ($action) {
        case 'article':
            if (isset($_GET['id'])) {
                $article = $controller->showArticle($_GET['id']);
                $articlesData = [
                    'articles' => [$article],
                    'totalPages' => 1,
                    'currentPage' => 1,
                    'categories' => [] 
                ];
            } else {
                $articlesData = $controller->showAccueil(4, $page);
            }
            break;
    
        case 'categorie':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $articlesData = $controller->showCategorie($id, 4, $page);
            } else {
                $articlesData = $controller->showAccueil(4, $page);
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
            $articlesData = $controller->showAccueil(4, $page);
            break;
    }

    // Inclure les fichiers d'entête et d'accueil uniquement pour les actions autres que la gestion des utilisateurs
    if (!in_array($action, ['showutilisateurs', 'addutilisateurform', 'ajouterutilisateur', 'editutilisateurform', 'mettreajourutilisateur', 'supprimerutilisateur'])) {
        $articles = $articlesData['articles'];
        $totalPages = $articlesData['totalPages'];
        $currentPage = $articlesData['currentPage'];
        $categories = $articlesData['categories'];

        require_once 'entete.php';
        require_once 'accueil.php';
    }

} else {
    // Si 'action' n'est pas définie, affichage de la page d'accueil
    $articlesData = $controller->showAccueil(4, $page);
    $articles = $articlesData['articles'];
    $totalPages = $articlesData['totalPages'];
    $currentPage = $articlesData['currentPage'];
    $categories = $articlesData['categories'];

    require_once 'entete.php';
    require_once 'accueil.php';
}

?>
