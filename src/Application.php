<?php

namespace MealOclock;

class Application {

    public function __construct() {

        // -----------------------------
        // Etapes du fichier de config
        // -----------------------------
        // 1. On crée un fichier "config.ini" (qu'on met dans .gitgnore)
        // 2. On écrit toutes nos config dans ce fichier
        // 3. Dans notre code, on lit le fichier avec "parse_ini_file" pour récupérer les infos
        // 4. On transmet ces informations là où on en a besoin
        // -----------------------------
        // On récupère les configs de l'application
        $config = parse_ini_file(__DIR__ . '/../config.ini');

        // On transmet les informations de connexion
        // de notre BDD à notre classe Database
        \MealOclock\Utils\Database::setConfig( $config );

        // On crée le routeur
        $this->router = new \AltoRouter();

        // On ignore une partie de l'URL
        // On récupère donc la partie de l'URL qui
        // est fixe grâce à $_SERVER['BASE_URI']
        $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';
        // $basePath = '/oclock/temp/mealoclock';

        // On renseigne la partie de l'URL fixe
        $this->router->setBasePath($basePath);

        // On lance le mapping
        $this->mapping();
    }

    public function mapping() {

        // On mappe toutes nos URL
        // La page d'accueil
        $this->router->map('GET', '/', ['MainController', 'home'], 'home');

        // ---------------------------
        // Communities
        // ---------------------------
        // La page d'une communauté
        $this->router->map('GET', '/communities/[:slug]', ['CommunityController', 'read'], 'communities');

        // ---------------------------
        // Events
        // ---------------------------
        // Liste des évènements
        $this->router->map('GET', '/events', ['EventController', 'list'], 'events');
        // Page d'un évènement
        $this->router->map('GET', '/events/[i:id]', ['EventController', 'read'], 'event');

        $this->router->map('GET', '/events/[i:id]/signupdate', ['EventController', 'signupdate'], 'events_signupdate');
        $this->router->map('GET', '/events/create', ['EventController', 'create'], 'events_create');

        $this->router->map('POST', '/events/search', ['EventController', 'search'], 'events_search');
        // /admin/event/123/update
        // /profile/event/123/update
        $this->router->map('GET', '/[admin|profile:domain]/events/[i:id]/update', ['EventController', 'update'], 'events_update');

        // ---------------------------
        // Pages statiques
        // ---------------------------
        $this->router->map('GET', '/cgu', ['MainController', 'cgu'], 'cgu');

        // ---------------------------
        // Admin
        // ---------------------------
        $this->router->map('GET', '/admin', ['AdminController', 'home'], 'admin');
        $this->router->map('GET', '/admin/communities', ['AdminCommunityController', 'list'], 'admin_communities');
        $this->router->map('GET', '/admin/communities/create', ['AdminCommunityController', 'create'], 'admin_communities_create');
        $this->router->map('GET', '/admin/communities/[i:id]/update', ['AdminCommunityController', 'update'], 'admin_communities_update');
        // Suppression d'une communauté
        $this->router->map('GET', '/admin/communities/[i:id]/delete', ['AdminCommunityController', 'delete'], 'admin_communities_delete');

        $this->router->map('GET', '/admin/events', ['AdminEventController', 'list'], 'admin_events');
        // Suppression d'un évènement
        $this->router->map('GET', '/admin/events/[i:id]/delete', ['AdminEventController', 'delete'], 'admin_events_delete');
        $this->router->map('GET', '/admin/events/[i:id]/update', ['AdminEventController', 'update'], 'admin_events_update');

        $this->router->map('GET', '/admin/members', ['AdminMemberController', 'list'], 'admin_members');
        // Suppression d'un membre
        $this->router->map('GET', '/admin/members/[i:id]/delete', ['AdminMemberController', 'delete'], 'admin_member_delete');
        $this->router->map('GET', '/admin/members/[i:id]/update/status', ['AdminMemberController', 'status'], 'admin_member_status');
        $this->router->map('GET', '/admin/members/[i:id]/update/role', ['AdminMemberController', 'role'], 'admin_member_role');

        // ---------------------------
        // Connexion
        // ---------------------------
        // Page de création de compte
        $this->router->map('GET|POST', '/signup', ['UserController', 'create'], 'signup');
        // Page de connexion
        $this->router->map('GET|POST', '/login', ['UserController', 'login'], 'login');
        // Page de déconnexion
        $this->router->map('GET', '/logout', ['UserController', 'logout'], 'logout');
        // Page d'oubli de mot de passe
        $this->router->map('GET', '/forgot_password', ['UserController', 'forgot'], 'forgot_password');
        // Page de saisie d'un nouveau mot de passe
        $this->router->map('GET', '/update_password', ['UserController', 'update'], 'update_password');

        // ---------------------------
        // Profil
        // ---------------------------
        // Page de profil
        $this->router->map('GET', '/profile', ['MemberController', 'read'], 'profile');
        // Page de modification des informations du profil
        $this->router->map('GET', '/profile/update', ['MemberController', 'update'], 'profil_update');
        $this->router->map('GET', '/members', ['MemberController', 'list'], 'member_list');
    }

    public function run () {

        // Je récupère les données de Altorouter
        $match = $this->router->match();

        if (!$match) {

            // On a pas trouvé la route, on indique le nouveau chemin
            // $controller = new \MealOclock\Controllers\MainController();
            // $controller->error404();
            // exit();
            $controllerName = "\MealOclock\Controllers\MainController";
            $methodName = 'error404';
        }
        else {

            // Je regarde quel controller et quelle
            // méthode je dois exécuter
            // On pense à ajouter le namespace devant
            // le nom de la classe et à échapper le
            // dernier "\" pour ne pas perturber notre code
            $controllerName = "\MealOclock\Controllers\\" . $match['target'][0];
            $methodName = $match['target'][1];
        }

        // J'exécute la bonne et méthode
        // $controller = new MealOclock\Controllers\MainController();
        $controller = new $controllerName( $this->router );
        // On en profite pour transmettre les paramètres
        // contenus dans notre URL (si il y en a)
        $controller->$methodName( $match['params'] );
    }
}
