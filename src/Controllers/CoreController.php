<?php

namespace MealOclock\Controllers;

class CoreController {

    // Va contenir l'objet Plates
    protected $templates;
    protected $router;
    protected $user;

    public function __construct( $router ) {

        // On enregistre le router dans notre objet
        $this->router = $router;

        // On enregistre l'utilisateur dans le controller
        $this->user = \MealOclock\Models\UserModel::getUser();

        // On instancie notre moteur de templates
        // On lui indique où se trouvent tous nos templates
        // --------------------------
        // /var/www/html
        // /MealOclock/Controllers/MainController.php
        // /League/Plates/Engine.php
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../Views/');

        // $basePath = '/oclock/temp/mealoclock';
        $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

        // On ajoute les données disponibles dans tous les templates
        $this->templates->addData([
            'baseUrl' => $basePath,
            // 'leNomDeLaDonnee' => 'LaValeur'
            'router' => $this->router,
            'user' => $this->user
        ]);
    }

    // Fait une redirection HTTP
    public function redirect( $routeName, $params=[] ) {

        // On construit une redirection grâce à la méthode
        // "generate" en passant uniquement le nom de la route
        header('Location: ' . $this->router->generate( $routeName, $params ) );
        exit();
    }
}
