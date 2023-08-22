<?php

namespace App\HTML;

use App\Modele\PostModele;

class Form {

    private $data;
    private $errors = [];
    public function __construct($data, $errors = [])
    {
        $this->data = $data;
        $this->errors = $errors;
        //dd($this->errors);
    }

    public function input($name, $label, $type = 'text')
    {
        $value = $this->getValue($name) ?? null;
        
        return <<<HTML
        <div class="form-group my-2">
            <label for="" class="form-label">{$label} :</label>
            <input type="{$type}" name="{$name}" value="{$value}" class="{$this->bootstrapValidator($name)}">
            {$this->feedValidator($name)}
        </div>
HTML;
    }

    public function bootstrapValidator(string $key) {

        $validator = 'form-control';
        if (isset($this->errors[$key])) {
            $validator .= ' is-invalid';
        }
        return $validator;
    }

    public function feedValidator(string $key) 
    {
        if (!empty($this->errors) && isset($this->errors)) {
            
            foreach($this->errors as $error){
                if (isset($error[$key])) {
                    if (is_array($error[$key])) {
                        $errors = implode('<br>', $error[$key]);
                    }else {
                        $errors = $error[$key];
                    }
                    return "<div class='invalid-feedback'>" .$errors."</div>";
                }
                
            }
        }
    }

    public function getValue($name) : ?string
    {
        if (is_array($this->data)) {
            return $this->data[$name] ?? null;
        }
        $key = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        return $this->data->$key() ?: '';
    }

    public function textarea($name, $label)
    {
        
        return <<<HTML
        <div class="form-group">
            <label for="" class="form-label">{$label} :</label>
            <textarea name="{$name}" class="{$this->bootstrapValidator($name)}">{$this->getValue($name)}</textarea>
            {$this->feedValidator($name)}
        </div>
HTML;
    }

    public function  select($name, $label, $options)
    {

        $fields = [];
        if (is_array($options)) {
            foreach ($options as $key => $option) {
                $selected = $option == $this->data->getStatut() ?? null;
                $fields[] = "<option value='{$option}' $selected>{$option}</option>";
            }
        }else {

            $key = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
            foreach ($options as $option) {
                $selected = (int)$option->getId() === $this->data->$key() ? 'selected' : null;
                $fields[] = "<option value='{$option->getId()}' $selected>{$option->getName()}</option>";
            }
        }
        $selectHtml = implode('', $fields);
        return <<<HTML
            <div class="form-group">
            <label for="" class="form-label">{$label}</label>
            <select name="{$name}" id="" class="{$this->bootstrapValidator($name)}">
                {$selectHtml}
            </select>
            {$this->feedValidator($name)}
        </div>
HTML;
    }
}

/**
 * 
 * 
 * <div class="form-group">
            <label for="" class="form-label">Le contenu du produit</label>
            <textarea type="text" name="content"  class="form-control" placeholder="Le contenu du produit"></textarea>
        </div>
        <div class="form-group">
            <label for="" class="form-label">Le prix du produit :</label>
            <input type="text" name="price" class="form-control" placeholder="Le prix du produit">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Les catégories</label>
            <select name="id_category" id="" class="form-select">
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->names ?></option>
                <?php endforeach ?>
            </select>
        </div>
 */