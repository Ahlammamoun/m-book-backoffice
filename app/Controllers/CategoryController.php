<?php


namespace App\Controllers;

use App\Models\Category;
use App\Models\CoreModel;

class CategoryController extends CoreController
{



    public function list()
    {
        //on récupère les données de la requête findAll du model category

        //on fait appel à la métode static findAll sans instancier d'objet, 
        //car elle est liée à la class puisque le code de la méthode ne fait 
        //pas référence à un objet courant $this
        $categoryList = Category::findAll();
        //dump($categoryList);

        $this->show('category/list', [
            'category_list' => $categoryList,

        ]);

        /*on peut également faire plus rapide
    $this->show('category/list',[
        'category_list' => Category::findAll()
    ]);*/
    }
    /**
     * méthode qui gère la page contenant le formulaire d'ajout d'une categorie
     *
     * @return void
     */

    public function add()
    {

        $this->show('category/add');
    }



    /**
     * méthode qui gère la page recevant les données du formulaire d'ajout d'une categorie
     *
     * @return void
     */

    public function create()
    {
        global $router;
        //dump($_POST);
        //on récupère les infos envoyées par le formulaire

        //vérifit qu'il y a une valeur
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

        //autre façon de faire
        /*if(isset($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $name = null;
    }*/
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture');



        //on créer un objet category on lui assigne nos valeurs
        $categoryToInsert = new Category();
        $categoryToInsert->setName($name);
        $categoryToInsert->setSubtitle($subtitle);
        $categoryToInsert->setPicture($picture);


        //dump($categoryToInsert);
        //on insert les données en bdd
        if ($categoryToInsert->save()) {
            //si l'ajout en bdd est ok , on redirige vers la liste des catégories
            header('Location: ' . $router->generate('category-list'));
        };

        //dump($categoryToInsert);

    }

    public function update($categoryId)
    {

        $category = Category::find($categoryId);
        //dump($category);
        $this->show('category/edit', [
            'category' => $category,
        ]);
    }

    public function updatePost($categoryId)
    {
        global $router;
        //dump($_POST);
        //je récupère et filtre les données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_SPECIAL_CHARS);
        $picture = filter_input(INPUT_POST, 'picture');


        //je récupère l'objet à mettre à jour
        $categoryToUpdate = Category::find($categoryId);
        //dump($categoryToUpdate);


        //je change les valeurs des propriétés de l'objet categorie
        $categoryToUpdate->setName($name);
        $categoryToUpdate->setSubtitle($subtitle);
        $categoryToUpdate->setPicture($picture);


        if ($categoryToUpdate->save()) {
            //si l'ajout en bdd est ok , on redirige vers la liste des catégories
            header('Location: ' . $router->generate('category-list'));
        };
    }
}
