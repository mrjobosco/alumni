<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 06/10/2016
 * Time: 06:16
 */
class Topic
{


    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'topic';
    }

    public function activeRecord(){
        return $this->_activeRecord;
    }




    public function allTopics($id){

        return $this->_activeRecord->hasMany(self::tableName(), ['category_id'  =>  $id]);

    }

    public function myTopics(User $user){

        return $this->_activeRecord->hasMany(Topic::tableName(),['creator_id' => $user->activeRecord()->getId()]);

    }

    public function getThreadCount($id){

        return count($this->_activeRecord->hasMany(Threads::tableName(), ['topic_id'    =>  $id]));

    }


    public function getThread(){
        return  $this->_activeRecord->hasMany(Threads::tableName(), ['topic_id'    =>  $this->_activeRecord->getId()]);

    }

    public function getRepliesCount($id){

        $count = 0;
        if ( count($this->_activeRecord->hasMany(Threads::tableName(), ['topic_id'    =>  $id]))){

            $all_post = $this->_activeRecord->hasMany(Threads::tableName(), ['topic_id'    =>  $id]);

            foreach ($all_post as $post){

                $this_post = new Threads();
                $count = $count + $this_post->repliesCount($post->id);
            }
            return $count;
        }
        return $count;

    }

    public function delete(){

        $all_topics_views = $this->_activeRecord->hasMany(TopicViews::tableName(),['topic_id'   =>  $this->_activeRecord->getId()]);
        $all_tags = $this->_activeRecord->hasMany(TopicTag::tableName(),['topic_id'   =>  $this->_activeRecord->getId()]);
        $all_threads = $this->_activeRecord->hasMany(Threads::tableName(),['topic_id'   =>  $this->_activeRecord->getId()]);

        foreach ($all_topics_views as $topics_view){

            $views = new TopicViews();
            $views->activeRecord()->relate(['id'    =>  $topics_view->id]);
            $views->delete();
        }

        foreach ($all_tags as $tag){

            $tags = new TopicTag();
            $tags->activeRecord()->relate(['id'    =>  $tag->id]);
            $tags->delete();
        }

        foreach ($all_threads as $thread){

            $threads = new Threads();
            $threads->activeRecord()->relate(['id'    =>  $thread->id]);
            $threads->delete();
        }





            $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }


}



