<?php

namespace App\PaginatedQuery;

class PaginatedQuery {

    private $statement;
    private $queryCount;
    private $page;
    public function __construct($statement, $queryCount, $data)
    {
        $this->statement = $statement;
        $this->queryCount = $queryCount;
    }

    public function getPage($page){
        return (int)($_GET[$page] ?? 1);
    }

    public function getCountQuery() {
        $this->queryCount = ceil($this->queryCount / 12);
        return (int)$this->queryCount;
    }

    public function getItems() 
    {
        
        $offset = ($this->getPage('p') - 1) * 12;
        return $this->statement . " LIMIT 12 OFFSET $offset ";

    }

    private function getConverted($page)
    {

        if (!empty($_GET[$page]) && $_GET[$page] === "1" && !empty($_GET['q']) && !empty($_GET['id'])) {
            header("Location: admin.php?page=categoryposts&id=".$_GET['id']."&q=". $_GET['q']);
            exit();
        }
        if (!empty($_GET[$page]) && $_GET[$page] === "1" && !empty($_GET['q'])) {
            header("Location: admin.php?q=". $_GET['q']);
            exit();
        }
        if (!empty($_GET[$page]) && $_GET[$page] === "1") {
            header("Location: admin.php");
            exit();
        }
    }

    public function nextPage($url, $page)
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $uri2 = $uri . '?' . 'page=' . $url . '&';
        $url1 = $uri2. URL::urlHelper($_GET, $page, $this->getPage($page) + 1); 
        $this->getConverted($page);
        if ($this->getCountQuery() > $this->getPage($page)) {
            return "<a href=". $url1 ." class='btn btn-primary'>Suivant</a>";
        }
    }
    public function previousPage($url, $page)
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $uri2 = $uri . '?' . 'page=' . $url . '&';
        $url1 = $uri2. URL::urlHelper($_GET, $page, $this->getPage($page) - 1);   
        $this->getConverted($page);
        if($this->getPage($page) <= 1) return null;
        if ($this->getPage($page) > 1) {
            return "<a href=". $url1 ." class='btn btn-primary'>Précédent</a>";
        }
    }

    public static function tableHelper(string $sortkey, $label, $data) 
    {
        $sort = $data['sort'] ?? null;
        $dir = $data['dir'] ?? null;
        $icon = "";
        if ($sort === $sortkey) {
            $icon = $dir == 'asc' ? '^' : 'v';
        }
        $url = URL::sortAble($data, ['sort' => $sortkey, 'dir' => $dir === 'asc' && $sort === $sortkey ? 'desc' : 'asc']);
        return <<<HTML
            <a href="?$url" class="text text-decoration-none">$label $icon</a>
HTML;
    }
}