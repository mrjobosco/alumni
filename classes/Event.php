<?php
/**
 *
 */
class Event
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'events';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

}

?>