<?php

class EmailtemplatesController extends AdminAppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Tinymce', 'Js' => array('Jquery'));
    public $components = array('Session', 'Paginator', 'search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page' => 1, 'order' => array('Emailtemplate.name' => 'asc'));

    public function index()
    {
        try {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = $this->Emailtemplate->parseCriteria($this->Prg->parsedParams());
            $this->Paginator->settings['limit'] = $this->pageLimit;
            $this->Paginator->settings['maxLimit'] = $this->maxLimit;
            $this->set('Emailtemplate', $this->Paginator->paginate());
            if ($this->request->is('ajax')) {
                $this->render('index', 'ajax'); // View, Layout
            }
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->Emailtemplate->create();
            try {
                $this->request->data['Emailtemplate']['description'] = str_replace("$this->siteDomain/admin/Emailtemplates/", "", $this->request->data['Emailtemplate']['description']);
                if ($this->Emailtemplate->save($this->request->data)) {
                    $this->Session->setFlash(__('Email template has been saved'), 'flash', array('alert' => 'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids = explode(",", $id);
        $post = array();
        foreach ($ids as $id) {
            $post[] = $this->Emailtemplate->findByid($id);
        }
        $this->set('Emailtemplate', $post);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            try {
                foreach ($this->request->data as $k => $value) {
                    $this->request->data[$k]['Emailtemplate']['description'] = str_replace("$this->siteDomain/admin/", "", $this->request->data[$k]['Emailtemplate']['description']);
                }
                if ($this->Emailtemplate->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('Email template has been saved'), 'flash', array('alert' => 'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError', true);
        } else {
            $this->layout = 'tinymce-absolute';
            $this->set('isError', false);
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function deleteall()
    {
        try {
            if ($this->request->is('post')) {
                foreach ($this->data['Emailtemplate']['id'] as $key => $value) {
                    $this->Emailtemplate->deleteAll(array('Emailtemplate.id' => $value, 'Emailtemplate.type' => NULL));
                }
                $this->Session->setFlash(__('Email template has been deleted'), 'flash', array('alert' => 'success'));
            }
            $this->redirect(array('action' => 'index'));
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function view($id = null)
    {
        $this->layout = null;
        if (!$id) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Emailtemplate->findById($id);
        $this->set('post', $post);
    }
}
