<?php

namespace App\Modele;

use App\Core\Modele\Modele;

class CustomerModele extends Modele{

    private $id;
    private $customername;
    private $customermail;
    private $customerpassword;

    

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
    public function getCustomername()
    {
        return $this->customername;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setCustomername($customername)
    {
        $this->customername = $customername;

        return $this;
    }

    /**
     * Get the value of customerpassword
     */ 
    public function getCustomerpassword()
    {
        return $this->customerpassword;
    }

    /**
     * Set the value of customerpassword
     *
     * @return  self
     */ 
    public function setCustomerpassword($customerpassword)
    {
        $this->customerpassword = $customerpassword;

        return $this;
    }

    /**
     * Get the value of customermail
     */ 
    public function getCustomermail()
    {
        return $this->customermail;
    }

    /**
     * Set the value of customermail
     *
     * @return  self
     */ 
    public function setCustomermail($customermail)
    {
        $this->customermail = $customermail;

        return $this;
    }
}