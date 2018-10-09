<?php

namespace MealOclock\Controllers;

class CommunityController extends AdminCoreController {

    // Affiche le détails d'une communauté
    public function read ( $params ) {

        // Quelle est la communauté à afficher ?
        // On récupère l'information de l'URL
        $slug = $params['slug']; // ex : no-lactose

        // On va chercher cette communauté dans la BDD
        $community = \MealOclock\Models\CommunityModel::findBySlug( $slug );

        echo $this->templates->render(
            'community/read',
            [
                'community' => $community
            ]
        );
    }
}
