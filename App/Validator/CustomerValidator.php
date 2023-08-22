<?php

namespace App\Validator;

use App\Table\CustomerTable;

class CustomerValidator extends Validator {

    public function __construct($data, CustomerTable $table)
    { 
        parent::__construct($data);
        $this->validate->rule('required', array_keys($data));
        $this->validate->rule('email', 'customermail');
        $this->validate->rule('lengthBetween', 'customername', 5, 100);
        $this->validate->rule('lengthBetween', 'customerpassword', 4, 20);
        $this->validate->rule(function($field, $value) use ($table)
        {
            return !$table->exists($field, $value);
        }, 'userlogin', 'Cet utilisateur existe déjà dans la base');
    }

   
}