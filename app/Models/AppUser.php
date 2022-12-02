<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{

    private $email;
    private $passeword;
    private $firstname;
    private $lastname;
    private $role;
    private $status;




    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of passeword
     */
    public function getPasseword()
    {
        return $this->passeword;
    }

    /**
     * Set the value of passeword
     *
     * @return  self
     */
    public function setPasseword($passeword)
    {
        $this->passeword = $passeword;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lasrname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lasrname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }






    public function find($id)
    {
    }
    public function findAll()
    {
    }

    public function insert()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
