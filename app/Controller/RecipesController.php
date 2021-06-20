<?php
App::uses('CakeEmail', 'Network/Email');
class RecipesController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session', 'RequestHandler');
    public $presetVars = true;

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function index() {
        $recipes = $this->Recipe->find('all');
        $this->set(array(
            'recipes' => $recipes,
            '_serialize' => array('recipes')
        ));
    }

    public function view($id) {
        $recipe = $this->Recipe->findById($id);
        $this->set(array(
            'recipe' => $recipe,
            '_serialize' => array('recipe')
        ));
    }

    public function restt_add() {
       
        $this->Recipe->create();
         echo 'hi123' ; die();
        if ($this->Recipe->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function edit($id) {
        $this->Recipe->id = $id;
        if ($this->Recipe->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id) {
        if ($this->Recipe->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}
?>