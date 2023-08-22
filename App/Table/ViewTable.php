<?php

namespace App\Table;
use App\Core\Table\Table;
use App\Modele\ViewModele;

class ViewTable extends Table{

    protected $table = "vues";

    public function updateViews()
    {
        foreach ($this->all() as $vue) {
            
            $this->update(
                ['nombre_vues' => $vue->getNombreVues() +1],
                1
            );
        }
    }

    public function showViews()
    {
        return $this->query("SELECT nombre_vues FROM {$this->table}");
    }
}