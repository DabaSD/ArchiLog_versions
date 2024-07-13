<?php
require_once '../Model/dao/ArticleDao.php'; // Include the ArticleDao class

// Initialize the ArticleDao
$articleDao = new ArticleDao();

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $article = $articleDao->getArticleById($articleId); // Use the method from ArticleDao
    if (!$article) {
        // Handle case where article with given ID is not found
        die("Article not found");
    }
} else {
    // Handle case where no ID is provided in the URL parameter
    die("No article ID specified");
}

?>
