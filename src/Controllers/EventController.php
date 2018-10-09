<?php

namespace MealOclock\Controllers;

class EventController extends CoreController {

    // Affiche la liste des évènements
    public function list() {

        // On récupère la liste des évènements en BDD
        $list = \MealOclock\Models\EventModel::findAll();

        // On transmet la liste au template pour l'afficher
        echo $this->templates->render('event/list', [
            'events' => $list
        ]);
    }

    // Affiche la page d'un évènement
    public function read( $params ) {

        // On récupère l'ID de l'évènement à afficher
        $id = $params['id'];

        // On récupère l'évènement à partir de son ID
        $model = \MealOclock\Models\EventModel::findById( $id );

        // On transmet les informations de l'évènement au template
        echo $this->templates->render('event/read', [
            'event' => $model
        ]);
    }

    // Permet de s'inscrire/désinscrire d'un évènement
    public function signupdate() {

    }

    // Permet de créer un nouvel évènement
    public function create() {

        echo $this->templates->render('event/create');
    }

    // Permet de rechercher des évènements
    public function search() {

        // On récupère la recherche
        $query = $_POST['query'];

        // On recherche tous les évènements qui comporte
        // "$query" dans leur titre
        $results = \MealOclock\Models\EventModel::findByTitle( $query );

        echo json_encode($results);
    }

    // Permet de modifier un évènement
    public function update() {

        echo $this->templates->render('event/update');
    }
}
