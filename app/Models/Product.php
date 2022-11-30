<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Une instance de Product = un produit dans la base de données
 * Product hérite de CoreModel
 */
class Product extends CoreModel
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private float $price;
    /**
     * @var int
     */
    private int $rate;
    /**
     * @var int
     */
    private int $status;
    /**
     * @var int
     */
    private int $language_id;
    /**
     * @var int
     */
    private int $category_id;
    /**
     * @var int
     */
    private int $etat_id;


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
     * Get the value of description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */
    public function setPicture(string $picture)
    {
        $this->picture     = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */
    public function setPrice(float $price)
    {
        $this->price       = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */
    public function setRate(int $rate)
    {
        $this->rate        = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */
    public function setStatus(int $status)
    {
        $this->status      = $status;
    }

    /**
     * Get the value of language_id
     *
     * @return  int
     */
    public function getLanguageId()
    {
        return $this->language_id;
    }

    /**
     * Set the value of language_id
     *
     * @param  int  $language_id
     */
    public function setLanguageId(int $language_id)
    {
        $this->language_id = $language_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of etat_id
     *
     * @return  int
     */
    public function getEtatId()
    {
        return $this->etat_id;
    }

    /**
     * Set the value of etat_id
     *
     * @param  int  $etat_id
     */
    public function setEtatId(int $etat_id)
    {
        $this->etat_id     = $etat_id;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Product en fonction d'un id donné
     *
     * @param int $productId ID du produit
     * @return Product
     */
    public static function find($productId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM product
            WHERE id = ' . $productId;

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $pdoStatement = $pdo->query($sql);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $result = $pdoStatement->fetchObject('App\Models\Product');

        return $result;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table product
     *
     * @return Product[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $results;
    }



    /**
     * Récupérer les produits mises en avant sur la home
     *
     * @return Category[]
     */
    public static function findHomeBackofficeProductsSelection()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM product
            ORDER BY updated_at DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $products = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');

        return $products;
    }


    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        //On met des côtes pour les chaînes de caractères dans les VALUES
        $sql = "
            INSERT INTO `product` (name, description, picture, price, rate, status, language_id, category_id, etat_id )
            VALUES (:name, :description, :picture, :price, :rate, :status, :language_id, :category_id, :etat_id)
            
        ";

        // Execution de la requête d'insertion (exec, pas query)
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->getPicture(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':price', $this->getPrice(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':rate', $this->getRate(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':language_id', $this->getLanguageId(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':category_id', $this->getCategoryId(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':etat_id', $this->getEtatId(), PDO::PARAM_INT);

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



        
    }


    public function delete()
    {
        $pdo = Database::getPDO();
        $sql = '
            DELETE FROM product
            WHERE id = :id
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $deletedRows = $pdoStatement->rowCount();

        return ($deletedRows > 0);
    }








}