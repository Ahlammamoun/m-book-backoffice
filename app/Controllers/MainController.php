<?php

namespace App\Controllers;

use App\Models\{Category, Product};


// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {

   
        $CategoryHomeBackoffice = Category::findHomeBackofficeCategoriesSelection();
        $ProductHomeBackoffice = Product::findHomeBackofficeProductsSelection();

    
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home',[
            'category_home_back_office' => $CategoryHomeBackoffice,
            'product_home_back_office' => $ProductHomeBackoffice,
        ]);

        //dump($CategoryHomeBackoffice);
    }













}
