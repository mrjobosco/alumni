<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 06/10/2016
 * Time: 02:11
 */
class TopicTag
{

    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'topic_tags';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}