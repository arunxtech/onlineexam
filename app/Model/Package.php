<?php

class Package extends AppModel
{
    public $hasAndBelongsToMany = array('Exam');
}

?>