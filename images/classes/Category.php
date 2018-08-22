<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 27/10/2016
 * Time: 08:40
 */
class Category
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'category';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function getQuestions(){

        return $this->_activeRecord->hasMany(Questions::tableName(), ['category_id'    =>  $this->activeRecord()->getId()]);
    }


    public function getTopics(){

        return $this->_activeRecord->hasMany(Topic::tableName(), ['category_id'    =>  $this->activeRecord()->getId()]);
    }


    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}
?>