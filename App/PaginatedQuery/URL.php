<?php
namespace App\PaginatedQuery;

use Exception;

class URL {

    public static function getInt(string $name, ?int $default =  null): ?int
    {
        if(!isset($_GET[$name])) return $default;
        if($_GET[$name] === 0) return 0;
        if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
            throw new Exception("Cette page n'existe pas", 1);
            
        }
        return (int)$default;
    }
}