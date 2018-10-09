<?php

namespace MealOclock\Controllers;

class AdminController extends AdminCoreController {

    // Page principale de l'interface d'admin
    public function home() {

        echo $this->templates->render('admin/home');
    }
}
