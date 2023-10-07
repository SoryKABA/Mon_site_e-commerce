<?php


namespace App\Controller\Admin;

use App;
use App\HTML\Form;
use Valitron\Validator;
use App\Objection\Objection;
use App\Modele\CategoryModele;
use App\Controller\Admin\AppController;

class CategoriesController extends AppController {

    public function index()  {
        $user = App::getInstance()->getTable('user')->find($_SESSION['auth']);
        $categories = App::getInstance()->getTable('category')->all();

        $this->render('admin.categories.index', compact('user', 'categories'));    
    }

    public function add() {
        
        $category = new CategoryModele();
        $errors = [];

        if (!empty($_POST)) {
            $v = new Validator($_POST);
            Validator::lang('fr');
            $v->rule('required', ['name']);
            $v->rule('lengthBetween', 'name', 5, 100);
            Objection::objet($category, $_POST, 'name');
            if ($v->validate()) {
                $this->loadModel('category')->createCategory($category);
            }else {
                $errors[] = $v->errors();
                
            }
        }

        $form = new Form($category, $errors);

        $this->render('admin.categories.new', compact('form'));
    }

    public function edit() {
        
        $errors = [];
        $id = (int)$_GET['id'];
        $category = $this->loadModel('category')->find($id);
        if (!empty($_POST)) {
            $v = new Validator($_POST);
            Validator::lang('fr');
            $v->rule('required', 'name');
            $v->rule('lengthBetween', 'name', 5, 100);
            Objection::objet($category, $_POST, 'name');
            
            if ($v->validate()) {
                $this->loadModel('category')->updateCategory($category);
            }else {
                $errors[] = $v->errors();
                
            }
            //dd($errors);
        }

        $form = new Form($category, $errors);
        $this->render('admin.categories.new', compact('form', 'category'));
    }

    public function delete() {

        if (!empty($_POST)) {

            $app = $this->loadModel('category');
            $category = $app->find((int)$_POST['id']);
            $ok = $app->deleteCategory($category);
            if ($ok) {
                 $this->index();
            }
         }
         
    }

    public function categoryposts() {
        
        $category = $this->loadModel('category')->find($_GET['id']);
        $posts = $this->loadModel('post')->findPosts($_GET['id'])[0];
        $paginatedQuery = $this->loadModel('post')->findPosts($_GET['id'])[1];

        $this->render('admin.categories.categoryposts', compact('category', 'posts', 'paginatedQuery'));
    }
}