<?php

namespace App\Modele;

use App\Core\Modele\Modele;

class ViewModele extends Modele{

    private $nombre_vues;
    private $id;
    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    /**
     * Get the value of nombre_vues
     */ 
    public function getNombreVues()
    {
        return $this->nombre_vues;
    }

    /**
     * Set the value of nombre_vues
     *
     * @return  self
     */ 
    public function setNombreVues($nombre_vues)
    {
        $this->nombre_vues = $nombre_vues;

        return $this;
    }
}