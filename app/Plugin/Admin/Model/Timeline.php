<?php

class Timeline extends AppModel
{
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like', 'field' => 'Timeline.title'));
    public $validate = array('title' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom', 'required' => true, 'allowEmpty' => false, 'message' => 'Only Alphabets')));


//    public function UserWiseGroup($userGroupWiseId)
//    {
//        $Timeline = ClassRegistry::init('Timeline');
//        $Timeline->bindModel(array('hasAndBelongsToMany' => array('Group' => array('className' => 'Group',
//            'joinTable' => 'subject_groups',
//            'foreignKey' => 'subject_id',
//            'associationForeignKey' => 'group_id',
//            'conditions' => "SubjectGroup.group_id IN($userGroupWiseId)"))));
//    }
}

?>