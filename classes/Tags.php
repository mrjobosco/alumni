<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 17/09/2016
 * Time: 15:35
 */
class Tags
{
    private $_db, $_activeRecord, $_error;
    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_activeRecord = new ActiveRecord(self::tableName());
    }

    public static function tableName(){
        return 'tags';
    }


    public function activeRecord(){
        return $this->_activeRecord;
    }

    public function allTags(){

        return $this->_activeRecord->read()->results();

    }


    public function extractAndInsert($tags, $question_id){

        $tag = explode(", ", $tags);
        $quesTag  = new QuestionTag();

       $all_tags =  $this->_activeRecord->read()->results();

        $new_tags = array();

        $i = 0;
        foreach ($all_tags as $t) {
        foreach ($tag as $ts){

                $ts  = trim($ts);
                if ($ts == $t->name) {

                    $this_tag = new Tags();
                    $this_tag->activeRecord()->relate(['name' => $t->name]);
                    $this_tag->activeRecord()->update([

                        'count'     =>  ($t->count) + 1

                    ]);
                    $quesTag->activeRecord()->create([
                        'question_id'   =>  $question_id,
                        'tag_id'        =>  $t->id

                    ]);

                    array_push($new_tags, $ts);

                }
            }

        }

//       die(var_dump($new_tags));


        foreach ($tag as $t){

            if (!in_array($t, $new_tags)){

                $this->_activeRecord->create([

                    'name'           =>  trim($t),
                    'description'   => "",
                    'count'         => 1
                ]);
                $tt = new Tags();
                $tt->activeRecord()->relate(['name' =>  trim($t)]);

                $quesTag->activeRecord()->create([
                    'question_id'   =>  $question_id,
                    'tag_id'        =>  $tt->activeRecord()->data()->id

                ]);

            }


        }


    }



    public function extractAndInsertTopics($tags, $topic_id){

        $tag = explode(", ", $tags);
        $topicTag  = new TopicTag();

        $all_tags =  $this->_activeRecord->read()->results();

        $new_tags = array();

        $i = 0;
        foreach ($all_tags as $t) {
            foreach ($tag as $ts){

                $ts  = trim($ts);
                if ($ts == $t->name) {

                    $this_tag = new Tags();
                    $this_tag->activeRecord()->relate(['name' => $t->name]);
                    $this_tag->activeRecord()->update([

                        'count'     =>  ($t->count) + 1

                    ]);
                    $topicTag->activeRecord()->create([
                        'topic_id'   =>  $topic_id,
                        'tags_id'        =>  $t->id

                    ]);

                    array_push($new_tags, $ts);

                }
            }

        }

//       die(var_dump($new_tags));


        foreach ($tag as $t){

            if (!in_array($t, $new_tags)){

                $this->_activeRecord->create([

                    'name'           =>  trim($t),
                    'description'   => "",
                    'count'         => 1
                ]);
                $tt = new Tags();
                $tt->activeRecord()->relate(['name' =>  trim($t)]);

                $topicTag->activeRecord()->create([
                    'topic_id'   =>  $topic_id,
                    'tags_id'        =>  $tt->activeRecord()->data()->id

                ]);

            }


        }


    }

    public function delete(){

        $this->_activeRecord->delete(['id'  =>  $this->_activeRecord->getId()]);
    }

}




?>