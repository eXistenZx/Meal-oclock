<?php

namespace MealOclock\Controllers;

class AdminCoreController extends CoreController {

    public function __construct( $router ) {

        // On appel le constructeur parent
        parent::__construct( $router );

        // On regarde si l'utilisateur peut accéder à cette page
        // On regarde SI l'utilisateur n'est pas connecté OU
        // SI il n'est pas administrateur
        if ( !$this->user || !$this->user->is_admin ) {

            // On fait une redirection grâce à la méthode
            // "redirect" qu'on a codé dans CoreController
            $this->redirect('home');
        }
    }
}
