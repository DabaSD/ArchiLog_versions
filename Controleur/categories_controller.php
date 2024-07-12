<?php
require_once '../Model/dao/CategorieDao.php';

// Initialize the CategorieDao
$categorieDao = new CategorieDao();

// Fetch all categories
$categories = $categorieDao->getCategories(); // Assuming getCategories() method fetches all categories

?>


