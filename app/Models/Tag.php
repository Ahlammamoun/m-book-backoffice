<?php

namespace App\Models;

use App\Utils\Database;
use PDO;


class Tag extends CoreModel
{
    
    private $name;
    /**
     * @var int
     */
   

   static  public function find($tagId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `tag` WHERE `id` =' . $tagId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $tag = $pdoStatement->fetchObject('App\Models\Tag');

        // retourner le résultat
        return $tag;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table etat
     *
     * @return Tag[]
     */
    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `tag`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');

        return $results;
    }



    public static function findAllProductById($productId)
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT tag.id, tag.name, tag.created_at, tag.updated_at FROM `tag`
            JOIN product_has_tag ON tag.id = product_has_tag.tag_id
            WHERE product_has_tag.product_id = ' . $productId . '
        ';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');

        return $results;



    }


    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // on prépare la requete
        $sql = $pdo->prepare("
             INSERT INTO `tag` (name)
             VALUES (:name)
        ");

        // on va associer nos variables
        $sql->bindParam(':name', $this->name);

        // on lance la req
        if ($sql->execute()) {
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
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // on prépare la requete
        $sql = $pdo->prepare("
                UPDATE `tag`
                SET
                    name = :name,
                    updated_at = NOW()
                WHERE id = :id
            ");

        // on va associer nos variables
        $sql->bindParam(':id', $this->id);
        $sql->bindParam(':name', $this->name);

        // on execute et on retourne le résultat (true si ok, false si nok)
        return $sql->execute();
    }

    public function delete() {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // on prépare la requete
    $sql = $pdo->prepare("
            DELETE FROM `tag`
            WHERE id = :id
        ");

        // on va associer nos variables
        $sql->bindParam(':id', $this->id);

        // on execute et on retourne le résultat (true si ok, false si nok)
        return $sql->execute();
    }









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

  
}
