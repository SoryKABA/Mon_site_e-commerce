<?php

namespace App\Validator;

use App\Table\UserTable;

class UserValidator extends Validator {

    public function __construct($data, UserTable $table)
    { 
        parent::__construct($data);
        $this->validate->rule('required', array_keys($data));
        $this->validate->rule('email', 'userlogin');
        $this->validate->rule('lengthBetween', 'username', 5, 100);
        $this->validate->rule('lengthBetween', 'password', 4, 20);
        $this->validate->rule(function($field, $value) use ($table)
        {
            return !$table->exists($field, $value);
        }, 'userlogin', 'Cet utilisateur existe déjà dans la base');
    }

   
}