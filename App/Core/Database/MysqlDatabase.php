<?php

namespace App\Core\Database;
use PDO;
class MysqlDatabase extends Database {

    private function getPDO()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=blog_commerce;charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\Throwable $th) {
            die("Echec de connexion à la base de données".$th->getMessage());
        }

        return $pdo;
    }

    public function query($statement, $class, $one = false)
    {
        $query = $this->getPDO()->query($statement);
        $query->setFetchMode(PDO::FETCH_CLASS, $class);
        if ($one) {
           $data = $query->fetch();
        }else {
            $data = $query->fetchAll();
        }
        return $data;
    }

    public function queryCount($statement, $attribute = null) 
    {
        
        if ($attribute) {
            $query = $this->getPDO()->prepare($statement);  
            $query->execute($attribute);
        }else {
            $query = $this->getPDO()->query($statement);
        }
        $query->setFetchMode(PDO::FETCH_NUM);
        $data = $query->fetch()[0];
        return $data;
    }

    public function prepare($statement, $attribute, $class = null, $one = false)
    {
        $query = $this->getPDO()->prepare($statement);
        $resultat = $query->execute($attribute);

        if (strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'DELETE') === 0) {
                return $resultat;
        }
        if ($class) {
            $query->setFetchMode(PDO::FETCH_CLASS, $class);  
        }else {
            $query->setFetchMode(PDO::FETCH_OBJ);
        }
        if ($one) {
           $data = $query->fetch();
        }else {
            $data = $query->fetchAll();
        }
        return $data;
    }
}