<?php

namespace App\Modele;

use App\Core\Modele\Modele;

class UserModele extends Modele{

    private $id;
    private $username;
    private $userlogin;
    private $statut;
    private $password;

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of userlogin
     */ 
    public function getUserlogin()
    {
        return $this->userlogin;
    }

    /**
     * Set the value of userlogin
     *
     * @return  self
     */ 
    public function setUserlogin($userlogin)
    {
        $this->userlogin = $userlogin;

        return $this;
    }
}