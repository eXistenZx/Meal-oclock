<?php

namespace MealOclock\Models;

class EventModel extends CoreModel {

    // Les propriétés qui nous servent
    // à construire nos requêtes SQL
    protected static $tableName = 'events';
    protected static $orderBy = 'event_date DESC';

    protected $id;
    protected $title;
    protected $description;
    protected $event_date;
    protected $limit_person;
    protected $address;
    protected $cash;
    protected $creator_id;
    protected $community_id;

    // public static function findAll() {
    //
        // // On récupère la connexion à la BDD
        // $conn = \MealOclock\Utils\Database::getDB();
        //
        // // On construit la requête SQL qui récupère
        // // tous les évènements en BDD
        // $sql = 'SELECT * FROM events ORDER BY event_date DESC';
        //
        // // On exécute la requête
        // $stmt = $conn->query($sql);
        //
        // // On récupère les résultats de la requête
        // return $stmt->fetchAll(\PDO::FETCH_CLASS, '\MealOclock\Models\EventModel');
    // }

    // Retourne un évènement à partir de son ID
    public static function findById( $eventId ) {

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Utils\Database::getDB();

        // On construit la requête SQL
        $sql = 'SELECT * FROM events WHERE id=' . $eventId;

        // On exécute la requête
        $stmt = $conn->query($sql);

        // On indique la classe à utiliser pour
        // l'instanciation des résultats
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\MealOclock\Models\EventModel');

        // On récupère le résultat de la requête
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }

    public static function findByTitle( $search ) {

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Utils\Database::getDB();

        // On construit la requête SQL qui récupère
        // tous les évènements en BDD
        $sql = 'SELECT * FROM events WHERE title LIKE "%'.$search.'%"';

        // On exécute la requête
        $stmt = $conn->query($sql);

        // On récupère les résultats de la requête
        // return $stmt->fetchAll(\PDO::FETCH_CLASS, '\MealOclock\Models\EventModel');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
     * Get the value of Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Get the value of Event Date
     *
     * @return mixed
     */
    public function getEventDate( $format='Y-m-d H:i:s' )
    {
        $date = new \DateTime($this->event_date);
        return $date->format( $format );
    }

    /**
     * Set the value of Event Date
     *
     * @param mixed event_date
     *
     * @return self
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;

        return $this;
    }

    /**
     * Get the value of Limit Person
     *
     * @return mixed
     */
    public function getLimitPerson()
    {
        return $this->limit_person;
    }

    /**
     * Set the value of Limit Person
     *
     * @param mixed limit_person
     *
     * @return self
     */
    public function setLimitPerson($limit_person)
    {
        $this->limit_person = $limit_person;

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
     * Get the value of Cash
     *
     * @return mixed
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set the value of Cash
     *
     * @param mixed cash
     *
     * @return self
     */
    public function setCash($cash)
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * Get the value of Creator Id
     *
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creator_id;
    }

    /**
     * Set the value of Creator Id
     *
     * @param mixed creator_id
     *
     * @return self
     */
    public function setCreatorId($creator_id)
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    /**
     * Get the value of Community Id
     *
     * @return mixed
     */
    public function getCommunityId()
    {
        return $this->community_id;
    }

    /**
     * Set the value of Community Id
     *
     * @param mixed community_id
     *
     * @return self
     */
    public function setCommunityId($community_id)
    {
        $this->community_id = $community_id;

        return $this;
    }

}
