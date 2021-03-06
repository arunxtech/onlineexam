<?php

class Mail extends AppModel
{
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like', 'field' => 'Mail.subject'));
    public $validate = array('subject' => array('alphaNumeric' => array('rule' => '/^[a-z0-9 .-]*$/i', 'required' => true, 'allowEmpty' => false, 'message' => 'Only letters and numbers allowed')),
    );
}

?>