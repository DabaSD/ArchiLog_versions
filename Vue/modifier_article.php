<?php
// Inclure le contrôleur pour récupérer $article et $categories
require_once '../Controleur/modifier_article_controller.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/modifier_article.css">
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Modifier l'article</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $articleId); ?>">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <?php if(isset($article) && $article !== null)   { ?>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($article->getTitre()); ?>" required>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <?php if(isset($article) && $article !== null)  { ?>
                        <textarea class="form-control" id="contenu" name="contenu" rows="5" required><?php echo htmlspecialchars($article->getContenu()); ?></textarea>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <select class="form-control" id="categorie" name="categorie" required>
                        <?php
                        if (!empty($categories)) {
                            foreach ($categories as $categorie) {
                                if(isset($article) && $article !== null)   {
                                    $selected = ($categorie->getId() == $article->getCategorie()) ? 'selected' : '';
                                    echo "<option value='" . $categorie->getId() . "' $selected>" . htmlspecialchars($categorie->getLibelle()) . "</option>";
                                }
                            }
                        } else {
                            echo "<option value=''>Aucune catégorie trouvée</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <a href="index.php?action=article&id=<?php echo $articleId; ?>" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
