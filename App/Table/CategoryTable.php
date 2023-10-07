<?php 

namespace App\Table;

use App\Core\Table\Table;
use App\Modele\CategoryModele;

class CategoryTable extends Table{

    protected $table = "categories";

    public function findCategoryByPosts($id_category)
    {
        return $this->query("
            SELECT c.*, p.* 
            FROM categories c
            LEFT JOIN post p ON c.id = p.id
            WHERE c.id = ?
        ", [$id_category]);
    }


    public function createCategory(CategoryModele $category)
    {
        $ok = $this->create([
            'names' => $category->getName()
        ]);
        $category->setId($ok);
        if ($ok) {
            header(('Location: ?page=category&created=1'));
            http_response_code(301);
            exit();
        }
    }

    public function deleteCategory(CategoryModele $category)
    {
        $ok = $this->delete($category->getid());
        if ($ok) {
            $this->query("DELETE FROM post WHERE id_category = ?", [$category->getId()]);
            return $ok ?? false;
        }
    }

    public function updateCategory(CategoryModele $category)
    {
        $ok = $this->update([
            'names' => $category->getName()
        ], $category->getId());

        if ($ok) {
            header('Location: ?page=category');
            exit();
        }
    }
    
}