<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 06/10/2016
 * Time: 09:03
 */
class ChatEvent
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'chat_event';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function getLastSeen($user1, $user2){
        $data = $this->_activeRecord->hasManyCondition(ChatEvent::tableName(), ['user1' => $user1], 'AND', ['user2' => $user2]);
        return $data->lastCheckedTime;
    }

    public function getCount($id, $id2){
        return $this->_activeRecord->getMany(Chat::tableName(), ['user1', '=', $id], 'AND', ['user2', '=', $id2]);
    }


    public function deleteWhere($where){

        $this->_activeRecord->delete($where);
    }


}