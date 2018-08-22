<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 18/09/2016
 * Time: 02:07
 */
class Post
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'post';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }


    public function repliesCount($id){

        return count($this->_activeRecord->hasMany(Reply::tableName(), ['post_id' => $id]));

    }

    public function delete(){

        $all_votes = $this->_activeRecord->hasMany(Votes::tableName(),['post_id'   =>  $this->_activeRecord->getId()]);
        $all_reply = $this->_activeRecord->hasMany(Reply::tableName(),['post_id'   =>  $this->_activeRecord->getId()]);


        foreach ($all_votes as $vote){

            $votes = new Votes();
            $votes->activeRecord()->relate(['id'    =>  $vote->id]);
            $votes->delete();
        }
        foreach ($all_reply as $replies){

            $reply = new Reply();
            $reply->activeRecord()->relate(['id'    =>  $replies->id]);
            $reply->delete();
        }


        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}

?>