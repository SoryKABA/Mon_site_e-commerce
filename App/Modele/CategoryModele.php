<?php

namespace App\Modele;

use App\Core\Modele\Modele;

class CategoryModele extends Modele{

    private $names;
    private $id;

    public function getUrl()  
    {
        return 'index.php?page=category&id=' . $this->id;
    }

    public function getName(): ?string
    {
        return $this->names ?? null;
    }

    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    public function setName(string $names)
    {
        $this->names = $names;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}