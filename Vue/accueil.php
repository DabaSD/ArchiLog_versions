<?php
  // Inclusion du fichier index.php qui contient les configurations initiales et la récupération des données
  require_once('index.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <!-- Définition du codage des caractères et du viewport pour le responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusion des styles CSS de Bootstrap et du fichier de style personnalisé -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css" />

    <!-- Titre de la page -->
    <title>ACTUALITÉS POLYTECHNICIENNES</title>

</head>

<body>

    <!-- Inclusion de l'entête du site -->
    <?php require_once 'entete.php'; ?>

    <!-- Conteneur principal pour les articles -->
    <div class="container mt-4" id="articlesContainer">

      <!-- Vérification si la variable $articles est définie, est un tableau et contient des éléments -->
      <?php if(isset($articles) && is_array($articles)) { ?>

        <!-- Boucle sur chaque article dans le tableau $articles -->
        <?php foreach ($articles as $article) { ?>

          <!-- Création d'une carte pour chaque article -->
          <div class="row">
              <div class="col-md-12 mb-4">
                  <div class="card custom-card">
                      <div class="card-body">

                          <!-- Affichage du titre, de la date de création et du contenu de l'article -->
                          <h5 class="card-title"><?php echo $article->getTitre(); ?></h5>
                          <h6 class="card-subtitle mb-2 text-muted" small-date><?php echo $article->getDateCreation(); ?></h6>
                          <p class="card-text"><?php echo $article->getContenu(); ?></p>
                      </div>
                  </div>
              </div>
          </div>
        <?php } ?>

      <!-- Si la variable $articles n'est pas définie, n'est pas un tableau ou est un tableau vide, affichage d'un message indiquant qu'aucun article n'a été trouvé -->
      <?php } else { ?>
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="card custom-card">
              <div class="card-body">
                <h5 class="card-title">Aucun article</h5>
                <p class="card-text">Aucun article n'a été trouvé</p>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    
    <!-- Inclusion des scripts JavaScript pour le fonctionnement de Bootstrap et un script personnalisé -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>