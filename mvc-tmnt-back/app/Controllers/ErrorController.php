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
        header('HTTP/1.0 404 Not Found');
        $this->show('error/err404');
    }
    /**
     * Méthode gérant l'affichage de la page 404
     *
     * @return void
     */
    public function err403()
    {
        http_response_code(403);
        $this->show('error/err403');
    }
}
