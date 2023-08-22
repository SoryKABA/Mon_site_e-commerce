<?php

namespace App\Modele;

use App\Core\Modele\Modele;

class SizeModele extends Modele{

    private $name;
    private $id;
    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function getId(): ?string
    {
        return $this->id ?? null;
    }
}