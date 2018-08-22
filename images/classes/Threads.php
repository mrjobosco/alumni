<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 06/10/2016
 * Time: 07:23
 */
class Threads
{


    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'threads';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }


    public function repliesCount($id){

        return count($this->_activeRecord->hasMany(ThreadsReply::tableName(), ['thread_id' => $id]));

    }
    public function delete(){

        $all_thread_votes = $this->_activeRecord->hasMany(ThreadsVote::tableName(),['post_id'   =>  $this->_activeRecord->getId()]);
        $all_thread_reply = $this->_activeRecord->hasMany(ThreadsReply::tableName(),['post_id'   =>  $this->_activeRecord->getId()]);


        foreach ($all_thread_votes as $thread_vote){

            $votes = new ThreadsVote();
            $votes->activeRecord()->relate(['id'    =>  $thread_vote->id]);
            $votes->delete();
        }
        foreach ($all_thread_reply as $thread_replies){

            $reply = new ThreadsReply();
            $reply->activeRecord()->relate(['id'    =>  $thread_replies->id]);
            $reply->delete();
        }



        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }
}