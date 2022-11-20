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




}