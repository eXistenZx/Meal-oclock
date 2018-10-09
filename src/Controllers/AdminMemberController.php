<?php

namespace MealOclock\Controllers;

class AdminMemberController extends AdminCoreController {

    // Affiche la liste des membres
    public function list() {

        $list = \MealOclock\Models\UserModel::findAll();
        echo $this->templates->render('admin/member/list', ['members' => $list]);
    }

    // Permet de supprimer un membre
    public function delete( $params ) {

        // On récupère l'ID du membre
        $id = $params['id'];

        // On recherche la communauté à supprimer
        $member = \MealOclock\Models\UserModel::find( $id );
        // Appeler la méthode de suppression
        $member->delete();

        // On redirige vers la liste des communautés
        $this->redirect( 'admin_members' );
    }

    // Permet de modifier le status d'un membre
    // => on ne l'utilisera peut être pas...
    public function status() {

    }

    // Permet de modifier le role d'un membre
    // => pour le faire devenir admin
    public function role() {

    }
}
