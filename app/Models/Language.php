<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 *
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class Language extends CoreModel
{
    // Les propriétés représentent les champs
    // Attention il faut que les propriétés aient le même nom (précisément) que les colonnes de la table

    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $footer_order;

    /**
     * Méthode permettant de récupérer un enregistrement de la table Language en fonction d'un id donné
     *
     * @param int $languagedId ID de la langue
     * @return Language
     */
   static public function find($languageId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = '
            SELECT *
            FROM language
            WHERE id = ' . $languageId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $language = $pdoStatement->fetchObject('App\Models\Language');

        // retourner le résultat
        return $language;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table langue
     *
     * @return Language[]
     */
   static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `language`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Language');

        return $results;
    }

    /**
     * Récupérer les 5 langues mises en avant dans le footer
     *
     * @return Brand[]
     */
    public function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM language
            WHERE footer_order > 0
            ORDER BY footer_order ASC
            LIMIT 5
        ';
        $pdoStatement = $pdo->query($sql);
        $languages = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Language');

        return $languages;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table brand
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `language` (name, footer_order)
            VALUES ('{$this->name}', {$this->footer_order})
        ";

        // Execution de la requête d'insertion (exec, pas query)
        $insertedRows = $pdo->exec($sql);

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

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table brand
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     *
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `language`
            SET
                name = '{$this->name}',
                footer_order = {$this->footer_order},
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $pdo->exec($sql);

        // On retourne VRAI, si au moins une ligne ajoutée
        return ($updatedRows > 0);
    }
    public function delete(){


    }

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
     * Get the value of footer_order
     *
     * @return  int
     */
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @param  int  $footer_order
     */
    public function setFooterOrder(int $footer_order)
    {
        $this->footer_order = $footer_order;
    }
}
