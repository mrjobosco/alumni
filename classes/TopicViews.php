<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 22/10/2016
 * Time: 13:46
 */
class TopicViews
{

    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'topic_views';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}

?>