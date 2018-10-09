<?php

namespace MealOclock\Controllers;

class UserController extends CoreController {

    // Affiche la page de création de compte
    // et permet de créer un compte
    public function create( $params ) {

        // On déclare la variable avant le "if"
        // pour que dans tous les cas elle existe bien
        $errors = [];

        // On regarde si le formulaire a été validé ou pas
        if (!empty($_POST)) {

            // L'utilisateur a validé le formulaire
            // On vérifie les données du formulaire
            $errors = \MealOclock\Models\UserModel::checkData( $_POST );

            // On vérifie si on a des erreurs
            if (count($errors) === 0) {

                // On n'a pas d'erreurs
                // On crée le compte
                $user = new \MealOclock\Models\UserModel();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setAddress($_POST['address']);
                $user->setDescription($_POST['description']);
                $user->save();

                // Tout c'est bien passé
                // On peut rediriger notre utilisateur sur
                // la page de connexion
                // header('Location: /oclock/temp/mealoclock/login');
                //header('Location: ' . $this->router->generate('login') );
                echo 'OK';
                exit();
            }
            else {

                echo json_encode($errors);
                exit();
            }
        }

        echo $this->templates->render('user/create', [ 'errors' => $errors ]);
    }

    // Affiche le formulaire de connexion et
    // gère la connexion
    public function login() {

        $errors = [];

        if (!empty($_POST)) {

            // Un visiteur essaie de se connecter
            // On vérifie l'email + mot de passe
            // pour savoir si le compte existe bien
            $email = $_POST['email'];
            $password = $_POST['password'];

            // On vérifie si le compte existe
            $user = \MealOclock\Models\UserModel::checkAccount( $email, $password );

            if (!$user) {

                // C'est pas bon, on s'arrête là
                $errors[] = 'Le compte n\'existe pas';
            }
            else {

                // On connecte notre utilisateur
                \MealOclock\Models\UserModel::connect( $user );
                header('Location: ' . $this->router->generate('home'));
                exit();
            }
        }

        // On affiche le template
        echo $this->templates->render('user/login', [ 'errors' => $errors ]);
    }

    // Permet de se déconnecter
    public function logout() {

        \MealOclock\Models\UserModel::disconnect();
        header('Location: ' . $this->router->generate('home'));
    }

    // Affiche la page d'oublie de mot de passe
    public function forgot() {

        echo $this->templates->render('user/forgot');
    }

    // Permet de modifier son mot de passe
    public function update() {

        echo $this->templates->render('user/update');
    }
}
