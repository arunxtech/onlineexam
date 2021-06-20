<?php

class TopicsController extends AdminAppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Paginator', 'Js' => array('Jquery'));
    public $components = array('Session', 'Paginator', 'search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page' => 1, 'order' => array('Topic.name' => 'asc'));

    public function index()
    {
        try {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = $this->Topic->parseCriteria($this->Prg->parsedParams());
            $this->Paginator->settings['limit'] = $this->pageLimit;
            $this->Paginator->settings['maxLimit'] = $this->maxLimit;
            $this->set('Topic', $this->Paginator->paginate());
            if ($this->request->is('ajax')) {
                $this->render('index', 'ajax'); // View, Layout
            }
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
        }
    }

    public function add()
    {
        $this->loadModel('Subject');
        $subject = $this->Subject->find('list', array('fields' => array('id', 'subject_name'), 'order' => array('subject_name' => 'asc')));
        $this->set('subject', $subject);
        if ($this->request->is('post')) {
            $this->Topic->create();
            try {
                if ($this->Topic->save($this->request->data)) {
                    $this->Session->setFlash(__('Topic Added Successfully'), 'flash', array('alert' => 'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null)
    {
        $this->loadModel('Subject');
        $subject = $this->Subject->find('list', array('fields' => array('id', 'subject_name'), 'order' => array('subject_name' => 'asc')));
        $this->set('subject', $subject);

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids = explode(",", $id);
        $post = array();
        foreach ($ids as $id) {
            $post[] = $this->Topic->findById($id);
        }
        $this->set('Topic', $post);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            try {
                if ($this->Topic->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('Topic has been saved'), 'flash', array('alert' => 'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
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
                foreach ($this->data['Topic']['id'] as $key => $value) {
                    $this->Topic->delete($value);
                }
                $this->Session->setFlash(__('Topic has been deleted'), 'flash', array('alert' => 'success'));
            }
            $this->redirect(array('action' => 'index'));
        } catch (Exception $e) {
            $this->Session->setFlash(__('Delete sub topic first'), 'flash', array('alert' => 'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
