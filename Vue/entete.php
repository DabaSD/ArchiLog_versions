<header>
    <!-- Début de la barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <!-- Titre de la barre de navigation -->
            <a class="navbar-brand" href="#">ACTUALITÉS POLYTECHNICIENNES</a>

            <!-- Bouton pour afficher le menu de navigation sur les petits écrans -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <!-- Lien vers la page d'accueil -->
                    <li class="nav-item">
                        <a class="nav-link" id="accueil-link" href="index.php?action=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=showutilisateurs">Utilisateurs</a>
                    </li>


                    <!-- Vérification si la variable $categories est définie -->
                    <?php if (isset($categories)): ?>

                        <!-- Boucle sur chaque catégorie dans le tableau $categories -->
                        <?php foreach ($categories as $categorie) : ?>
                            
                            <!-- Lien vers la page de la catégorie avec l'ID correctement encodé -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=categorie&id=<?= $categorie->getId()?>"><?= $categorie->getLibelle() ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
