<?php
namespace App\PaginatedQuery;

use Exception;

class URL {

    public static function sortAble(array $data, $params)
    {
        return http_build_query(array_merge($data, $params));
    }

    public static function urlHelper(array $data, string $param, int $value )
    {
        return http_build_query(array_merge($data, [$param => $value]));
    }
    
}