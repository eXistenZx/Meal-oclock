<?php

namespace MealOclock\Models;

class CommunityModel extends CoreModel {

    // Les propriétés qui nous servent
    // à construire nos requêtes SQL
    protected static $tableName = 'communities';
    protected static $orderBy = 'name';

    protected $id;
    protected $name;
    protected $description;
    protected $image;
    protected $slug;
    protected $creator_id;

    // Retourne la liste des communautés
    // public static function findAll() {
    //
    //     // On récupère la connexion à la BDD
    //     $conn = \MealOclock\Utils\Database::getDB();
    //
    //     // On crée la requête SQL de récupération des données
    //     $sql = 'SELECT * FROM communities ORDER BY name';
    //
    //     // On exécute la requête
    //     $stmt = $conn->query($sql);
    //
    //     // On récupère tous les résultats
    //     return $stmt->fetchAll(\PDO::FETCH_CLASS, '\MealOclock\Models\CommunityModel');
    // }


    public static function findBySlug ($slug) {

        // On récupère la connexion à la BDD
        $conn = \MealOclock\Utils\Database::getDB();

        // SELECT * FROM communities WHERE slug = ""
        $sql = 'SELECT * FROM communities WHERE slug="' . $slug . '"';

        // On exécute la requête
        $stmt = $conn->query($sql);

        // On précise le type de fetch à utiliser
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\MealOclock\Models\CommunityModel');

        // On récupère la première communauté
        // retournée par la requête
        return $stmt->fetch(\PDO::FETCH_CLASS);
    }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Get the value of Image
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of Image
     *
     * @param mixed image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of Slug
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of Slug
     *
     * @param mixed slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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

}
