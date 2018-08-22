<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 17/09/2016
 * Time: 15:34
 */
class Questions
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'questions';
    }


    public function activeRecord(){
        return $this->_activeRecord;
    }


    public function allQuestions(){

        return $this->_activeRecord->read()->results();

    }

    public function myQuestions(User $user){

        return $this->_activeRecord->hasMany(Questions::tableName(),['author_id' => $user->activeRecord()->getId()]);

    }

    public function getPostCount($id){

        return count($this->_activeRecord->hasMany(Post::tableName(), ['question_id'    =>  $id]));

    }


    public function getPost(){
      return  $this->_activeRecord->hasMany(Post::tableName(), ['question_id'    =>  $this->_activeRecord->getId()]);

    }

    public function getRepliesCount($id){

        $count = 0;
        if ( count($this->_activeRecord->hasMany(Post::tableName(), ['question_id'    =>  $id]))){

            $all_post = $this->_activeRecord->hasMany(Post::tableName(), ['question_id'    =>  $id]);

            foreach ($all_post as $post){

                $this_post = new Post();
                $count = $count + $this_post->repliesCount($post->id);
            }
            return $count;
        }
        return $count;

    }

    public function delete(){
        $all_views = $this->_activeRecord->hasMany(Views::tableName(),['question_id'   =>  $this->_activeRecord->getId()]);
        $all_tags = $this->_activeRecord->hasMany(QuestionTag::tableName(),['question_id'   =>  $this->_activeRecord->getId()]);
        $all_posts = $this->_activeRecord->hasMany(Post::tableName(),['question_id'   =>  $this->_activeRecord->getId()]);

        foreach ($all_views as $view){

            $views = new Views();
            $views->activeRecord()->relate(['id'    =>  $view->id]);
            $views->delete();
        }

        foreach ($all_tags as $tag){

            $tags = new QuestionTag();
            $tags->activeRecord()->relate(['id'    =>  $tag->id]);
            $tags->delete();
        }

        foreach ($all_posts as $post){

            $posts = new Post();
            $posts->activeRecord()->relate(['id'    =>  $post->id]);
            $posts->delete();
        }





        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);

}


}




?>