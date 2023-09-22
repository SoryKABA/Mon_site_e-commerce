<?php

namespace App\Core\Table;

use App\Core\Database\Database;
use DateTime;

class Table {
    protected $table;
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $class = explode('\\', get_called_class());
            $class = end($class);
            $table = str_replace('Table', '', $class);
            $this->table = $table;
        }
    }

    public function query($statement, $attribute = null, $one = false)
    {
        if ($attribute) {
            return $this->db->prepare($statement, $attribute, str_replace('Table', 'Modele', get_class($this)), $one);
        }else {
            return $this->db->query($statement, str_replace('Table', 'Modele', get_class($this)), $one);
        }
    }

    public function countQuery($statement, $attribute = null)
    { 
        if ($attribute !== null) {
            return $this->db->queryCount($statement, $attribute);
        }
        return $this->db->queryCount($statement);
    }

    public function all()
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }
    
    public function delete(int $id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function exists($field, $value) 
    {
        return $this->query("SELECT * FROM {$this->table} WHERE $field = ?", [$value], true);
        
    }

    public function update($data, int $id)
    {
        $fields = [];
        $attribute = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $query = $this->query("UPDATE {$this->table} SET ". implode(', ', $fields) . " WHERE id = :id", array_merge($data, ['id' => $id]));
        if (!$query) {
            throw new \Exception("Erreur d'enregistrement", 1);
            
        }
    }

    public function create(array $data)
    {
        $fields = [];
        $attribute = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $query = $this->query("INSERT INTO {$this->table} SET ". implode(', ', $fields), $data);
        if (!$query) {
            throw new \Exception("Erreur d'enregistrement", 1);
            
        }
    }
}