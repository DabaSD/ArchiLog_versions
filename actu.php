<!DOCTYPE html>
<html>
<head>
    <title>Actualités</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="actu.css">
</head>
<body>

    <header>
        <h1>ACTUALITES POLYTECHNICIENNES</h1>
    </header>

    <nav>
        <a href="?cat=sante " class="nav-button">Santé</a>
        <a href="?cat=sport" class="nav-button">Sport</a>
        <a href="?cat=education" class="nav-button">Éducation</a>
        <a href="?cat=politique" class="nav-button">Politique</a>
    </nav>

    <h1 class="title">Les dernières actualités</h1>
    <?php
    $servername = "localhost";
    $username = "mglsi_user";
    $password = "passer";
    $dbname = "news";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les articles
    $sql = "SELECT * FROM article";
    $result = $conn->query($sql);

    // Boucle pour afficher chaque article
    if ($result->num_rows > 0) {
        while($article = $result->fetch_assoc()) {
            echo '<div class="article">';
            echo '<h2>' . $article["titre"] . '</h2>'; // Utilisez "titre" pour le titre de l'article
            echo '<p>' . $article["contenu"] . '</p>'; // Utilisez "contenu" pour le contenu de l'article
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

// Récupérer la catégorie de l'URL
$cat = isset($_GET['cat']) ? $_GET['cat'] : null;

// Récupérer les articles
$sql = "SELECT * FROM article";
if ($cat) {
    // Si une catégorie est définie, ajoutez une clause WHERE à la requête SQL
    $sql .= " WHERE categorie = '" . mysqli_real_escape_string($conn, $cat) . "'";
}
$result = $conn->query($sql);

// Boucle pour afficher chaque article
if ($result->num_rows > 0) {
    while($article = $result->fetch_assoc()) {
        echo '<div class="article">';
        echo '<h2>' . $article["titre"] . '</h2>'; // Utilisez "titre" pour le titre de l'article
        echo '<p>' . $article["contenu"] . '</p>'; // Utilisez "contenu" pour le contenu de l'article
        echo '</div>';
    }
} else {
    echo "0 results";
}

    $conn->close();
?>
</body>
</html>