<?php


namespace App\Controllers;

use App\Models\CoreModel;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Language;
use App\Models\Category;
use App\Models\Etat;


class ProductController extends CoreController
{


    public function list()
    {

        $productList = Product::findAll();
        //dump($productList);

        $this->show('product/list', [
            'product_list' => $productList,
        ]);
    }



    /**
     * méthode qui gère la page contenant le formulaire d'ajout d'un produit
     *
     * @return void
     */
    public function add()
    {
       
        $this->show('product/add');
    }


    public function create()
    {
        global $router;
        //dump($_POST);
        //on récupère les infos envoyées par le formulaire

        //vérifit qu'il y a une valeur
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description');
        $picture = filter_input(INPUT_POST, 'picture');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $language_id = filter_input(INPUT_POST, 'language_id', FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $etat_id = filter_input(INPUT_POST, 'etat_id', FILTER_VALIDATE_INT);




        //on créer un objet produit on lui assigne nos valeurs
        $productToInsert = new Product();
        $productToInsert->setName($name);
        $productToInsert->setDescription($description);
        $productToInsert->setPicture($picture);
        $productToInsert->setPrice($price);
        $productToInsert->setRate($rate);
        $productToInsert->setStatus($status);
        $productToInsert->setLanguageId($language_id);
        $productToInsert->setCategoryId($category_id);
        $productToInsert->setEtatId($etat_id);



        //dump($categoryToInsert);
        //on insert les données en bdd
        if ($productToInsert->save()) {
            //si l'ajout en bdd est ok , on redirige vers la liste des catégories
            $this->redirect('product-list');
        };

        //dump($categoryToInsert);

    }


    public function update($productId)
    {

        $product = Product::find($productId);
        $languagesList= Language::findAll();
        $tagsList = Tag::findAll();
        $categoriesList = Category::findAll();
        $etatsList = Etat::findAll();



        //dump($product);
        //dump($tagsList);
        $this->show('product/edit', [
            'product' => $product,
            'tags_list' => $tagsList,
            'languages_list' => $languagesList,
            'categories_list' => $categoriesList,
            'etats_list' => $etatsList,
        ]);
    }




    public function updatePost($productId)
    {
        global $router;
      
        //je récupère et filtre les données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description');
        $picture = filter_input(INPUT_POST, 'picture');
        $price = filter_input(INPUT_POST, 'price');
        $rate = filter_input(INPUT_POST, 'rate');
        $status = filter_input(INPUT_POST, 'status');
        $category_id = filter_input(INPUT_POST, 'category_id');
        $language_id = filter_input(INPUT_POST, 'language_id');
        $etat_id = filter_input(INPUT_POST, 'etat_id');
       // $category_id = filter_input(INPUT_POST, 'category_id');
        dump($_POST);

        //je récupère l'objet à mettre à jour
        $productToUpdate =  Product::find($productId);
        dump($productToUpdate);


        //je change les valeurs des propriétés de l'objet categorie $product->setName($name);
        $productToUpdate->setDescription($description);
        $productToUpdate->setPicture($picture);
        $productToUpdate->setPrice($price);
        $productToUpdate->setRate($rate);
        $productToUpdate->setStatus($status);
        $productToUpdate->setCategoryId($category_id);
        $productToUpdate->setLanguageId($language_id);
        $productToUpdate->setEtatId($etat_id);
       // $productToUpdate->setCategoryId($category_id);
      // dump($productToUpdate);

        if ($productToUpdate->save()) {
            //si l'ajout en bdd est ok , on redirige vers la liste des catégories

            $this->redirect('product-list');
        } else {
            exit("Echec lors de la momdif");
        }


    }

    public function delete($id)
    {

        $productDelete = Product::find($id);

        if ($productDelete->delete()) {
            $this->redirect('product-list');
        } else {
            exit("Echec lors de la suppression");
        }
    }











}
