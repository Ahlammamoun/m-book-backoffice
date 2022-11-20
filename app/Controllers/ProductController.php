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




}