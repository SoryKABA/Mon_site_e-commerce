<?php

namespace App\Objection;

use DateTime;

class Objection {
    
    public static function objet($object, $data, $fields)
    {
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
                if ($field === 'create_at') {    
                    $object->setCreateAt((new DateTime('now'))->format('Y-m-d H:i:s'));
                }
                if ($field === 'picture') {
                    $object->setPicture($_FILES['picture']['name']);
                }
                $object->$method($data[$field]);
            }
        }else {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $fields)));
            $object->$method($data[$fields]);
        }
    }
}