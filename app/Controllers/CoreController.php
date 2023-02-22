<?php

namespace App\Controllers;

class CoreController
{

    public function __construct($routeId = '')
    {

        //dump($routeId);

        //on définit dans un tableau les permissions pour les routes nécéssitant une connexion  utilisateur

        $accessControlList = [

            'main-home' => ['admin', 'catalog-manager'],
            'user-add' => ['admin'],
            'user-create' =>  ['admin'],
            'user-list' => ['admin'],
            'user-delete' => ['admin'],
            'category-add' =>  ['admin', 'catalog-manager'],
            'category-create' => ['admin'],
            'category-list' => ['admin'],
            'category-update' => ['admin', 'catalog-manager'],
            'category-update-post' => ['admin', 'catalog-manager'],
            'category-delete' => ['admin', 'catalog-manager'],
            'product-add' =>  ['admin', 'catalog-manager'],
            'product-create' => ['admin', 'catalog-manager'],
            'product-list' => ['admin'],
            'product-update' => ['admin', 'catalog-manager'],
            'product-update-post' => ['admin', 'catalog-manager'],
            'product-delete' => ['admin', 'catalog-manager'],
            'category-home-selection-post' => ['admin'],
            'category-home-selection' => ['admin'],

        ];


        if (array_key_exists($routeId, $accessControlList)) {
            $authorizedRoles = $accessControlList[$routeId];
            $this->checkAuthorization($authorizedRoles);
        }


        CoreController::checkCsrfToken($routeId);
    }
    public static function checkCsrfToken($routeId)
    {
        // Liste des routes nécessitant un token CSRF en POST
        $csrfTokenToCheckInPost = [
            'user-create',
            'category-create',
            'category-home-selection-post',
            // etc...
        ];

        // Si la route actuelle nécessite la vérification d'un token anti-csrf ?
        if (in_array($routeId, $csrfTokenToCheckInPost)) {

            // On récupère le token en POST
            $formToken = filter_input(INPUT_POST, 'token');

            // On récupère le token en SESSION
            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';
            /*if (isset($_SESSION['token'])) {
                $sessionToken = $_SESSION['token'];
            } else {
                $sessionToken = ''; // valeur par défaut
            }*/

            //dump($routeId);
            //dump($formToken);
            //dump($_SESSION);
            //dump($sessionToken);
            if (empty($formToken) || empty($sessionToken) || $formToken !== $sessionToken) {
                // Alors on affiche une 403 Accès interdit
                $errorController = new ErrorController();
                $errorController->err403();
            } else {
                // Sinon tout va bien : accès autorisé
                // on peut alors supprimer le token pour ne pas qu'il puisse resservir une deuxième fois
                unset($_SESSION['token']);
            }
            //dump($_SESSION);
        }
        // Sinon, on ne fait rien, il n'y a rien à vérifier

        // TODO les vérifications pour les routes en GET
        // On pourrait traier les routes en GET et POST mais ça compliquerait encore plus les choses
    }

    protected function redirect($routeId)
    {

        global $router;
        header('Location: ' . $router->generate($routeId));
        exit();
    }

    protected function checkAuthorization($authorizedRoles)
    {


        if (isset($_SESSION['userId'])) {
            $user = $_SESSION['userObject'];

            $role = $user->getRole();
            //dump($role);

            if (in_array($role, $authorizedRoles)) {
                return true;
            } else {

                $errorController = new ErrorController();
                $errorController->err403();
            }
        } else {
            $this->redirect('user-login');
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        $viewData['isUserLoggedIn'] = isset($_SESSION['userId']);
        if (isset($_SESSION['userObject'])) {
            $viewData['loggedInUser'] = $_SESSION['userObject'];
        }


        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}
