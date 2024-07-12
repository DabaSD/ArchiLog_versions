<?php
require_once '../Controleur/Controller.php';

$controller = new Controller();
$action = isset($_GET['action']) ? $_GET['action'] : 'accueil';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$articlesData = [];

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

    default:
        $articlesData = $controller->showAccueil(4, $page);
        break;
}

$articles = $articlesData['articles'];
$totalPages = $articlesData['totalPages'];
$currentPage = $articlesData['currentPage'];
$categories = $articlesData['categories'];

require_once 'entete.php';
require_once 'accueil.php';
?>