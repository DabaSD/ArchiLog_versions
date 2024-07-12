<?php
require_once '../Model/dao/CategorieDao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libelle = $_POST['libelle'];

    // Create an instance of CategorieDao
    $categorieDao = new CategorieDao();

    // Add the new category
    $categorieDao->ajouterCategorie($libelle);

    // Redirect to the categories list page
    header('Location: ../Vue/liste_categories.php');
    exit();
}
?>

