<?php 

namespace App\Table;

use App\Core\Table\Table;
use App\Modele\PostModele;
use DateTime;

class PostTable extends Table{

    protected $table = "post";

    public function findPostWithCategoryAndSize($id) 
    {
        return $this->query("
            SELECT p.id, p.nom, p.picture, p.content, p.price, p.create_at, p.id_category, p.id_size, c.id, c.names, s.id, s.name
            FROM post p
            LEFT JOIN categories c ON p.id_category = c.id
            LEFT JOIN sizes s ON p.id_size = s.id
            WHERE p.id = ?
        ", [$id], true);
    }

    public function findPosts($id)
    {
        return $this->query("
            SELECT p.id post_id, p.nom, p.picture, p.content, p.price, p.create_at, p.id_category, p.id_size, c.id, c.names, s.id, s.name
            FROM post p
            LEFT JOIN categories c ON p.id_category = c.id
            LEFT JOIN sizes s ON p.id_size = s.id
            WHERE p.id_category = ?
        ", [$id]);
    }

    public function findBycategories($id)
    {
        return $this->query("
            SELECT c.*, p.* 
            FROM post p
            LEFT JOIN categories c ON c.id = p.id_category
            WHERE c.id = ?
        ", [$id]);
    
    }
    public function allWithCategoriAndSIze()  
    {
        return $this->query("
            SELECT p.id post_id, p.nom, p.price, p.picture, p.create_at, p.id_category, p.id_size, c.*, s.*
            FROM post p
            LEFT JOIN categories c ON c.id = p.id_category
            LEFT JOIN sizes s ON s.id = p.id_size
            ORDER BY p.id ASC
        ");
    }

    public function createPost(PostModele $post)
    {
        $ok = $this->create([
            'nom' => $post->getNom(),
            'picture' => $post->getPicture(),
            'content' => $post->getContent(),
            'price' => $post->getPrice(),
            'create_at' => $post->getCreateAt()->format('Y-m-d H:i:s'),
            'id_category' => $post->getIdCategory(),
            'id_size' => $post->getIdSize()
        ]);
        $post->setId($ok);
        if ($ok) {
            header(('Location: ?page=index&created=1'));
            exit();
        }
    }

    public function updatePost(PostModele $post)
    {
        $ok = $this->update([
            'nom' => $post->getNom(),
            'picture' => $post->getPicture(),
            'content' => $post->getContent(),
            'price' => $post->getPrice(),
            'create_at' => $post->getCreateAt()->format('Y-m-d H:i:s'),
            'id_category' => $post->getIdCategory(),
            'id_size' => $post->getIdSize()
        ], $post->getId());

        if ($ok) {
            header(('Location: ?page=index&edit=1'));
            exit();
        }
    }



}