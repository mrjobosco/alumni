<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 18/09/2016
 * Time: 02:16
 */
class Reply
{


    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'replies';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function getReplies($id){

        return $this->_activeRecord->hasMany(Reply::tableName(), ['post_id' => $id ]);
    }

    public function getRepliesCount($id){

        return count($this->_activeRecord->hasMany(Reply::tableName(), ['post_id' => $id ]));

    }

    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}
?>