<?php

class SmstemplatesController extends AdminAppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Js' => array('Jquery'));
    public $components = array('Session', 'Paginator', 'search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page' => 1, 'order' => array('Smstemplate.name' => 'asc'));

    public function index()
    {
        try {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = $this->Smstemplate->parseCriteria($this->Prg->parsedParams());
            $this->Paginator->settings['limit'] = $this->pageLimit;
            $this->Paginator->settings['maxLimit'] = $this->maxLimit;
            $this->set('Smstemplate', $this->Paginator->paginate());
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
            $this->Smstemplate->create();
            try {
                if ($this->Smstemplate->save($this->request->data)) {
                    $this->Session->setFlash(__('SMS template has been saved'), 'flash', array('alert' => 'success'));
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
            $post[] = $this->Smstemplate->findByid($id);
        }
        $this->set('Smstemplate', $post);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            try {
                if ($this->Smstemplate->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('SMS template has been saved'), 'flash', array('alert' => 'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError', true);
        } else {
            $this->layout = null;
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
                foreach ($this->data['Smstemplate']['id'] as $key => $value) {
                    if ($value != 0)
                        $this->Smstemplate->deleteAll(array('Smstemplate.id' => $value, 'Smstemplate.type' => NULL));
                }
                $this->Session->setFlash(__('SMS template has been deleted'), 'flash', array('alert' => 'success'));
            }
            $this->redirect(array('action' => 'index'));
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
