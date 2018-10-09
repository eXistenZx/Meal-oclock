<?php

namespace MealOclock\Controllers;

class AdminEventController extends AdminCoreController {

    // Affiche la liste des évènements
    public function list() {

        $list = \MealOclock\Models\EventModel::findAll();
        echo $this->templates->render('admin/event/list', ['events' => $list]);
    }

    // Permet de supprimer un évènement
    public function delete( $params ) {

        // On récupère l'ID de la communauté
        $id = $params['id'];

        // On recherche la communauté à supprimer
        $event = \MealOclock\Models\EventModel::find( $id );
        // Appeler la méthode de suppression
        $event->delete();

        // On redirige vers la liste des communautés
        $this->redirect( 'admin_events' );
    }

    // Permet de mettre à jour un évènement
    public function update() {

    }
}
