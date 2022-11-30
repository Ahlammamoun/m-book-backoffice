<?php

namespace App\Models;


// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
// abstract bloque l'instanciation de la class Coremodel
abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }


    //si l'entité existe en bdd on update autrement on insert
    public function save()
    {
        if ($this->getId() > 0) {
            //on update
            return $this->update();
        } else {
            //il n'y a pas d'id jamais entré en bdd
            return $this->insert();
        }
    }

    abstract public function insert();
    abstract public function update();
}
