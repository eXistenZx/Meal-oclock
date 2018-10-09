<?php

namespace MealOclock\Controllers;

class MainController extends CoreController {

    // Affiche la page d'accueil
    public function home() {

        // On récupère la liste des communautés
        // afin de pouvoir les transmettre au template
        $results = \MealOclock\Models\CommunityModel::findAll();

        // On affiche le template "home.php"
        echo $this->templates->render(
            'main/home',
            [
                'title' => 'Liste des communautés',
                'devil' => 666,
                'communities' => $results
            ]
        );
    }

    // Affiche les CGU
    public function cgu() {

        echo $this->templates->render('main/cgu');
    }

    // Affiche la page 404
    public function error404() {

        echo $this->templates->render('main/404');
    }
}
