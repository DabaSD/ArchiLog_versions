<?php
require_once '../Model/dao/CategorieDao.php';

$categorieDao = new CategorieDao();

if (isset($_POST['id'], $_POST['libelle'])) {
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];

    if ($categorieDao->updateCategorie($id, $libelle)) {
        header('Location: ../Vue/liste_categories.php'); // Assurez-vous que le chemin est correct
        exit();
    } else {
        $error = "Échec de la mise à jour de la catégorie.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categorie = $categorieDao->getCategorieById($id);
} else {
    die("Aucun ID de catégorie spécifié.");
}
?>
