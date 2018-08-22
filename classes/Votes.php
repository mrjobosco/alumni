<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 18/09/2016
 * Time: 09:48
 */
class Votes
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'votes';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }


    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }

}



?>