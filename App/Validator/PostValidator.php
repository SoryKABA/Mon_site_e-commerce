<?php

namespace App\Validator;

use App\Table\PostTable;

class PostValidator extends Validator {

    public function __construct($data, PostTable $table)
    { 
        parent::__construct($data);
        $this->validate->rule('required', array_keys($data));
        $this->validate->rule('numeric', 'price');
        $this->validate->rule('lengthBetween', 'nom', 5, 100);
        $this->validate->rule('lengthBetween', 'content', 5, 1000);
        $this->validate->rule(function($field, $value) use ($table)
        {
            return !$table->exists($field, $value);
        }, 'nom', 'Ce produit existe déjà dans la base');
    }

   
}