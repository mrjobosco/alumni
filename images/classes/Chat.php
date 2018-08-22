<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 06/10/2016
 * Time: 08:40
 */
class Chat
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'chat';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function online(){
        return $this->_activeRecord->hasMany(User::tableName(), ['online' => 1]);
    }

    public function off(){
        return $this->_activeRecord->hasMany(User::tableName(), ['online' => 0]);
    }

    public function getChat($user1, $user2){
        return $this->_activeRecord->hasManyCondition(self::tableName(), ['user2'=> $user2] ,'AND', ['user1' => $user1]);
    }


    public function getAllChat($user1, $user2){
        return $this->_activeRecord->hasManyConditionOr(self::tableName(), [$user1, $user2]);
    }

    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }

    public function deleteWhere($where){

        $this->_activeRecord->delete($where);
    }
}