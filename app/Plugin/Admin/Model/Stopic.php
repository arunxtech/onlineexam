<?php

class Stopic extends AppModel
{
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable');
    public $belongsTo = array('Subject', 'Topic');
    public $filterArgs = array('keyword' => array('type' => 'like', 'field' => 'Stopic.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom', 'required' => true, 'allowEmpty' => false, 'message' => 'Only letters and numbers allowed'),
        'isUnique' => array('rule' => 'isUnique', 'message' => 'Sub Topic  already exist'))
    );
}

?>