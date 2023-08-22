<?php

namespace App\Validator;

use Valitron\Validator as ValitronValidator;

abstract class Validator {

    public $data = [];
    public $validate;
    public function __construct(array $data)
    {
        $this->data = $data;
        ValitronValidator::lang('fr');
        $this->validate = new ValitronValidator($this->data);
    }

    public function validate()
    {
        return $this->validate->validate();
    }

    public function errors()
    {
        return $this->validate->validate();
    }
}