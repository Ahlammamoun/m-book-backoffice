<?php




// POINT D'ENTRÉE UNIQUE :
// FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';

/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va
$router = new AltoRouter();

// AltoRouter a besoin de connaître le répertoire (après le nom de domaine)
// dans lequel on travaille pour analyser la bonne partie de l'URL
// Mais comme on utilise le serveur intégré à PHP
// notre racine est '/' et par défaut c'est la valeur utiliser pour
// le base path d'AltoRouter, c'est pourquoi pas besoin de faire
// appel à setBasePath() contrairement à notre projet de S05

// On se contente d'initialiser $_SERVER['BASE_URI'] à '/' car cette valeur
// est utilisée dans le CoreController
$_SERVER['BASE_URI'] = '/';

// On doit déclarer toutes les "routes" à AltoRouter,
// afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : informations contenant
//      - le nom de la méthode à utiliser pour répondre à cette route
//      - le nom du controller contenant la méthode
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController' // On indique le FQCN de la classe
    ],
    'main-home'
);


//route pour la page liste de categories
$router->map(
    'GET',
    '/category/list',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-list'
);
//route pour la page qui affiche le form ajout d'une categorie
$router->map(
    'GET',
    '/category/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-add'
);


//route pour la page recevant et traitant les données envoyées par le formulaire d'ajout d'une catégorie
$router->map(
    'POST',
    '/category/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-create'
);

//route d'affichage du formulaire d'update d'une catégory 
$router->map(
    'GET',
    '/category/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-update'
);
//route qui gere les donnees du form update des categories
$router->map(
    'POST',
    '/category/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-update-post'
);
$router->map(
    'GET',
    '/category/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\CategoryController' // On indique le FQCN de la classe
    ],
    'category-delete'
);



//page liste de produit
$router->map(
    'GET',
    '/product/list',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-list'
);
//page qui affiche le form ajout d'un produit
$router->map(
    'GET',
    '/product/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-add'
);


//gère les donnée du form produit
$router->map(
    'POST',
    '/product/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-create'
);
//route d'affichage du form d'update un produit
$router->map(
    'GET',
    '/product/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-update'
);

//route qui gere les donnees du form update des produits
$router->map(
    'POST',
    '/product/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-update-post'
);

$router->map(
    'GET',
    '/product/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\ProductController' // On indique le FQCN de la classe
    ],
    'product-delete'
);


//route pour le formulaire de connexion
$router->map(
    'GET',
    '/user/login',
    [
        'method' => 'login',
        'controller' => '\App\Controllers\UserController' // On indique le FQCN de la classe
    ],
    'user-login'
);

//route qui traite les infos envoyé par le formulaire
$router->map(
    'POST',
    '/user/login',
    [
        'method' => 'loginPost',
        'controller' => '\App\Controllers\UserController' // On indique le FQCN de la classe
    ],
    'user-login-post'
);


/*Dispatch */

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
// ATTENTION :
// - en S05, avec notre dispatch "maison", les informations extraites de l'URL
// étaient fournie à la méthode du contrôleur dans un tableau associatif
// - en S06 avec AltoDispatcher, celui-ci fournit les informations extraites
// de l'URL avec un paramètre par information.
// => si j'ai une seule information dynamique dans l'URL, par exemple un id
// alors le premier paramètre de la méthode du contrôleur sera directement
// cet id
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();
