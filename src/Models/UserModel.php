<?php

namespace MealOclock\Models;

class UserModel extends CoreModel {

    // Les propriétés qui nous servent
    // à construire nos requêtes SQL
    protected static $tableName = 'users';
    protected static $orderBy = 'lastname';

    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $photo;
    protected $address;
    protected $description;
    protected $is_admin;

    // Enregistre les données en BDD
    public function save () {

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Utils\Database::getDB();

        // On construit la requête SQL
        $sql = 'INSERT INTO users (firstname, lastname, email, password, address, description) VALUES (:firstname, :lastname, :email, :password, :address, :description)';

        // On fait les remplacements de valeurs
        $stmt = $conn->prepare($sql);
        // On remplace les :valeurs par les véritables valeurs
        $stmt->bindValue(':firstname', $this->firstname, \PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $this->lastname, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, \PDO::PARAM_STR);
        $stmt->bindValue(':address', $this->address, \PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, \PDO::PARAM_STR);

        // On exécute la requête
        $error = $stmt->execute();
        // var_dump($conn->errorInfo());

        // On fait un dernier truc...
    }

    public function getIdentity() {

        return $this->firstname .' '. $this->lastname;
    }

    // Vérifie si le compte existe, et retourne les données du compte
    public static function checkAccount( $email, $password ) {

        // On récupère toutes les données de l'utilisateur
        // qui possède cette adresse mail. Si il n'existe
        // pas, ça nous retourne "false"
        $user = self::findByMail( $email );

        if ($user) {

            // On a bien un utilisateur qui correspond
            // password_verify($typedPassword, $dbPassword)
            $isOk = password_verify($password, $user->getPassword());

            if ($isOk) {

                // Le mot de passe est le bon, on continue
                return $user;
            }
            else {

                // Mauvais mot de passe, on arrête
                return false;
            }
        }
        else {

            // Adresse mail inconnue
            return false;
        }
    }

    // Crée la session de l'utilisateur
    public static function connect( $user ) {

        // On va stocker en SESSION, les différentes
        // informations dont on aura besoin
        // Ce "$_SESSION['user']" va nous servir à
        // savoir si l'utilisateur est connecté ou pas
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'is_admin' => (bool) $user->getIsAdmin(),
            'address' => $user->getAddress()
        ];
    }

    // Déconnecte l'utilisateur
    public static function disconnect() {

        // On supprime les donnée de l'utilisateur en session
        unset($_SESSION['user']);
        // On supprime même tout ce qui reste dans les sessions
        // Concrêtement ça supprime le cookie
        session_destroy();
    }

    // Indique si l'utilisateur est connecté ou pas
    public static function isConnected() {

        // if (isset($_SESSION['user'])) {
        //     return true;
        // }
        // else {
        //     return false;
        // }

        return isset( $_SESSION['user'] );
    }

    // Retourne les informations de l'utilisateur
    public static function getUser() {

        // Si l'utilisateur n'est pas connecté, on
        // retounre la valeur "false"
        if (!isset($_SESSION['user'])) return false;

        // $_SESSION['user']['firstname']
        // $_SESSION['user']->firstname
        return (object) $_SESSION['user'];
    }

    // Vérifie les données de création de compte
    public static function checkData( $data ) {

        // On liste les erreurs
        $errors = [];

        // On regarde si les champs suivants sont bien présents
        // firstname, lastname, email, password, confirm_password
        $mandatoryFields = [
            'firstname' => "Tu dois renseigner ton prénom !",
            'lastname' => "Tu as oublié ton nom de famille ?",
            'email' => "Attention, tu as oublié de saisir ton email...",
            'password' => "Saisis bien un mot de passe",
            'confirm_password' => "Confirme bien ton mot de passe"
            // 'champstruc' => "Confirme bien ton mot de passe"
        ];

        // On check les champs obligatoires
        foreach ($mandatoryFields as $field => $msg) {

            if (empty($data[$field])) {

                $errors[] = $msg;
            }
        }

        // On vérifie le format de l'email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $errors[] = "L'adresse mail n'est pas valide";
        }

        // Est ce que le mot de passe est bien égale au mot
        // de passe confirmé
        if ($data['password'] !== $data['confirm_password']) {

            $errors[] = "La confirmation du mot de passe n'est pas bonne";
        }

        // On vérifie si l'adresse mail n'est pas déjà utilisée
        // On recherche si un utilisateur possède cette adresse ou pas
        $user = self::findByMail( $data['email'] );

        if ($user !== false) {

            $errors[] = "Cette adresse mail est déjà prise";
        }

        // On retourne la liste des erreurs
        return $errors;
    }

    public static function findByMail( $email ) {

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Utils\Database::getDB();

        // On construit une requête SQL
        $sql = 'SELECT * FROM users WHERE email LIKE :email';

        // On prépare notre requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);

        // On exécute la requête
        $stmt->execute();

        // On récupère le résultat
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }


    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of Firstname
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of Firstname
     *
     * @param mixed firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of Lastname
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of Lastname
     *
     * @param mixed lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {

        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Get the value of Photo
     *
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of Photo
     *
     * @param mixed photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of Address
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of Address
     *
     * @param mixed address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Is Admin
     *
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Set the value of Is Admin
     *
     * @param mixed is_admin
     *
     * @return self
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }

}
