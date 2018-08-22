<?php
/**
 *
 */
class News
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'news';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }

}

?>