<?php

namespace App\Controller\Admin;
use App;
use App\HTML\Form;
use Valitron\Validator;
use App\Modele\PostModele;

use App\Objection\Objection;
use App\Validator\PostValidator;
use App\PaginatedQuery\PaginatedQuery;
use App\Controller\Admin\AppController;

class PostsController extends AppController {

    public function index() {
        
        $user = $this->loadModel('user')->find($_SESSION['auth']);
        $posts = $this->loadModel('post')->allWithCategoriAndSIze()[0];
        $paginated = $this->loadModel('post')->allWithCategoriAndSIze()[1];
        $this->render('admin.posts.index', compact('user', 'posts', 'paginated'));
    }

    public function add() {
        
        $post = new PostModele();
        $errors = [];
        $table = $this->loadModel('post');

        if (!empty($_POST)) {
            $p = new PostValidator($_POST, $table);
            Objection::objet($post, $_POST, ['nom', 'picture', 'content', 'price', 'id_category', 'id_size']);
            
            if ($p->validate()) {
                //dd($_POST);
                if ($this->loadModel('post')->createPost($post)) {
                    header("Location: admin.php?index&created=1");
                    http_response_code(301);
                    exit();
                }
            }else {
                $errors[] = $p->errors();
                dd($errors);
                
            }
            //dd($errors);
        }

        $categories = $this->loadModel('category')->all();
        $sizes = $this->loadModel('size')->all();

        $form = new Form($post, $errors);
        $this->render('admin.posts.new', compact('categories', 'form', 'sizes'));
    }

    public function edit() {
        
        $errors = [];
        $id = (int)$_GET['id'];
        $post = $this->loadModel('post')->find($id);
        $table = $this->loadModel('post');
        if (!empty($_POST)) {
            $v = new Validator($_POST);
            Validator::lang('fr');
            $v->rule('required', ['nom', 'content', 'price', 'id_category', 'id_size']);
            $v->rule('numeric', 'price');
            $v->rule('lengthBetween', 'nom', 5, 100);
            $v->rule('lengthBetween', 'content', 5, 10000);
            Objection::objet($post, $_POST, ['nom', 'content', 'price', 'id_category', 'id_size']);
            if ($v->validate()) {
                $this->loadModel('post')->updatePost($post);
            }else {
                $errors[] = $v->errors();
                
            }
            //dd($errors);
        }

        $categories = $this->loadModel('category')->all();
        $sizes = $this->loadModel('size')->all();

        $form = new Form($post, $errors);
        $this->render('admin.posts.new', compact('categories', 'form', 'sizes'));
    }

    public function delete() {

        $post = $this->loadModel('post');
        if (!empty($_POST)) {

            $ok = $post->delete((int)$_POST['id']);
            if ($ok) {
                 $this->index();
            }
         }
    }

    public function profil() {
        
    }
}