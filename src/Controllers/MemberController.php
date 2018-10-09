<?php

namespace MealOclock\Controllers;

class MemberController extends CoreController {

    // Affiche la liste des membres
    public function list() {

        $list = \MealOclock\Models\UserModel::findAll();
        echo $this->templates->render('member/list', [
            'users' => $list
        ]);
    }

    // Affiche la page de profil d'un membre
    public function read() {

        echo $this->templates->render('member/read');
    }

    // Permet de mettre à jour les informations
    // de son propre profil
    public function update() {

        echo $this->templates->render('member/update');
    }
}
