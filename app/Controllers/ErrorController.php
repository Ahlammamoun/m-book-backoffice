<?php

namespace App\Controllers;

// Classe gérant les erreurs (404, 403)
class ErrorController extends CoreController
{
    /**
     * Méthode gérant l'affichage de la page 404
     *
     * @return void
     */
    public function err404()
    {
        // On envoie le header 404
        // Cette ligne pourrait être enlevée car AltoDispatcher
        // ajoute déjà le header 404 Not Found si AltoRouter
        // n'a pas trouvé de route pour l'URL demandée
        header('HTTP/1.0 404 Not Found');

        // Puis on gère l'affichage
        $this->show('error/err404');
    }
}
