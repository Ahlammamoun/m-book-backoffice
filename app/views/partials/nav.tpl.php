<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">m-book</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('category-list') ?>">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('product-list') ?>">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Etats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Langues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tags</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('category-home-selection') ?>">Selection d'acceuil &amp; Footer </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('user-list') ?>">utilisateurs</a>
                </li>
                <li class="nav-item">
                    <?php if (!$isUserLoggedIn) : ?>
                        <a class="nav-link" href="<?= $router->generate('user-login') ?>">Connexion</a>
                    <?php else : ?>
                        <a class="nav-link" href="<?= $router->generate('user-logout') ?>">Déconnexion</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled text-warning">
                <?php if (isset($loggedInUser)){
                 echo 'Bonjour ' . $loggedInUser->getFirstname() . ' (' . $loggedInUser->getRole() . ')';
                } ?>
                </a>
                    </li>
            </ul>
        </div>
    </div>
</nav>