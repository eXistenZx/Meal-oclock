<?php

namespace MealOclock\Controllers;

class AdminCommunityController extends AdminCoreController {

    // Affiche la liste des communautés
    public function list() {

        $list = \MealOclock\Models\CommunityModel::findAll();
        echo $this->templates->render('admin/community/list', ['communities' => $list]);
    }

    // Permet de créer une nouvelle communauté
    public function create() {

    }

    // Permet de mettre à jour une commauté
    public function update() {

    }

    // Permet de supprimer une communauté
    public function delete( $params ) {

        // On récupère l'ID de la communauté
        $id = $params['id'];

        // On recherche la communauté à supprimer
        $community = \MealOclock\Models\CommunityModel::find( $id );
        // Appeler la méthode de suppression
        $community->delete();

        // \MealOclock\Models\CommunityModel::delete($id);

        // On redirige vers la liste des communautés
        $this->redirect( 'admin_communities' );
    }
}
