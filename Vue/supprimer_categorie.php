<?php
require_once '../Model/dao/CategorieDao.php';

$categorieDao = new CategorieDao();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($categorieDao->supprimerCategorie($id)) {
        header('Location: liste_categories.php');
        exit();
    } else {
        die("Failed to delete category.");
    }
} else {
    die("No category ID specified.");
}
?>
