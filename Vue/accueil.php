<?php
// Inclusion du fichier index.php qui contient les configurations initiales et la récupération des données
require_once 'index.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition du codage des caractères et du viewport pour le responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Inclusion des styles CSS de Bootstrap et du fichier de style personnalisé -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css"/>

    <!-- Inclusion de SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">

    <!-- Inclusion de SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

    <!-- Titre de la page -->
    <title>ACTUALITÉS POLYTECHNICIENNES</title>
</head>
<body>

    <!-- Inclusion de l'entête du site -->
    <?php require_once 'entete.php'; ?>

    <div class="container mt-4">

        <!-- Bouton Ajouter un article -->
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="ajouter_article.php" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Ajouter un article</a>
                <a href="liste_categories.php" class="btn btn-primary ml-2"><i class="fas fa-list mr-2"></i>Gérer les catégories</a>
                <a href="index.php?action=showutilisateurs" class="btn btn-primary ml-2"><i class="fas fa-list mr-2"></i>Gérer les utilisateurs</a>

            </div>
        </div>

        <!-- Conteneur principal pour les articles -->
        <div class="row mt-4">
            <div class="col-md-12">
                <?php if(isset($articles) && is_array($articles) && !empty($articles)) { ?>
                    <?php foreach ($articles as $article) { ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="article_detail.php?action=article&id=<?php echo $article->getId(); ?>">
                                        <?php echo $article->getTitre(); ?>
                                    </a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted small"><?php echo $article->getDateCreation(); ?></h6>
                                <p class="card-text"><?php echo $article->getContenu(); ?></p>
                                <div class="mt-3">
                                    <a href="modifier_article.php?id=<?php echo $article->getId(); ?>" class="btn btn-warning mr-2"><i class="fas fa-edit"></i> Modifier</a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $article->getId(); ?>)"><i class="fas fa-trash-alt"></i> Supprimer</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Pagination -->
                    <nav aria-label="Navigation des articles">
                        <ul class="pagination justify-content-center">
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Précédent</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">Suivant &raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

                <?php } else { ?>
                    <div class="alert alert-info" role="alert">
                        Aucun article trouvé.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Script JavaScript pour la confirmation de suppression -->
    <script>
        function confirmDelete(articleId) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cet article ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirection vers la page de suppression avec l'ID de l'article à supprimer
                    window.location.href = 'supprimer_article.php?id=' + articleId;
                }
            });
        }
    </script>

    <!-- Inclusion des scripts JavaScript pour le fonctionnement de Bootstrap et un script personnalisé -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Inclusion des icônes FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
