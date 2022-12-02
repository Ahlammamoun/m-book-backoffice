<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     *
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
     static public function find($id)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject('App\Models\Category');

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     *
     * @return Category[]
     */
    //static permet de faire appel à findAll dans le controller sans avoir à instancier un objet et untiliser une variable vide
    static public  function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

        return $results;
    }

    /**
     * Récupérer les catégories mises en avant sur la home
     *
     * @return Category[]
     */
    public static function findHomeBackofficeCategoriesSelection()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            ORDER BY updated_at DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');

        return $categories;
    }

    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        //On met des côtes pour les chaînes de caractères dans les VALUES
        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES (:name, :subtitle, :picture)
            
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':subtitle', $this->getSubtitle(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->getPicture(), PDO::PARAM_STR);

        $pdoStatement->execute();
        // Execution de la requête d'insertion (exec, pas query)
        $insertedRows = $pdoStatement->rowCount();

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }


    public function update()
    {

        $pdo = Database::getPDO();
        $sql =   ("
        UPDATE `category`
        SET
            name = :name,
            subtitle = :subtitle,
            picture = :picture,
            home_order = :home_order,
            updated_at = NOW()
        WHERE id = :id
    ");
        $pdoStatement = $pdo->prepare($sql);



        $pdoStatement->bindValue(':id', $this->getId(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':subtitle', $this->getSubtitle(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->getPicture(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':home_order', $this->getHomeOrder(), PDO::PARAM_INT);


        $pdoStatement->execute();

        $updatedRows = $pdoStatement->rowCount();

        return ($updatedRows > 0);
    }

    public function delete()
    {
        $pdo = Database::getPDO();
        $sql = '
            DELETE FROM category
            WHERE id = :id
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();

        return ($deletedRows > 0);
    }
}
