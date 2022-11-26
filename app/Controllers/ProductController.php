<?php


namespace App\Controllers;

use App\Models\CoreModel;
use App\Models\Product;

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
    $price= filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
    $language_id= filter_input(INPUT_POST, 'language_id', FILTER_VALIDATE_INT);
    $category_id= filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $etat_id= filter_input(INPUT_POST, 'etat_id', FILTER_VALIDATE_INT);




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
    if ($productToInsert->save()){
        //si l'ajout en bdd est ok , on redirige vers la liste des catégories
        header('Location: ' . $router->generate('product-list'));
    };

    //dump($categoryToInsert);






}


public function update($productId)
{

  
    $this->show('product/edit', [
        
    ]);

   
}

public function updatePost($productId)
{
    
   
}

}