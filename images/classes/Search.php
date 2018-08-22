<?php

/**
 * Created by PhpStorm.
 * User: joey
 * Date: 26/10/2016
 * Time: 08:21
 */
class Search
{



    private function cutUp($string){

        $words = explode(" ", strtolower($string));



        $new_words =[];

        $words_not_to_use = ['a','is','this','when','how','please','will','why','what','the','of','our','do','you','your','who'];

        foreach ($words as $word){
            if(!in_array($word, $words_not_to_use)){

                array_push($new_words,$word);

            }

        }

        return $new_words;
    }


    private function getQuestions($word){

        $questions = new Questions();
        $all = $questions->activeRecord()->search(['question', '\'%'.$word.'%\'']);

        return $all;
    }

    private function getTopics($word){
        $topics = new Topic();
        $all = $topics->activeRecord()->search(['name', '\'%'.$word.'%\'']);

        return $all;

    }

    private function sieveResults($string){

        $results = [];

        foreach ($this->cutUp($string) as $item){

            $all_questions = $this->getQuestions($item);
            foreach ($all_questions as $question){

                if (!in_array($question->id, $results)){

                    array_push($results, $question->id);
                }

            }

        }


        return $results;
    }


    private function sieveResultsTopics($string){

        $results = [];

        foreach ($this->cutUp($string) as $item){

            $all_questions = $this->getTopics($item);
            foreach ($all_questions as $question){

                if (!in_array($question->id, $results)){

                    array_push($results, $question->id);
                }

            }

        }


        return $results;
    }

    public function getResultsQuestions($string){

       return $this->sieveResults($string);
    }

    public function getResultsTopics($string){

        return $this->sieveResultsTopics($string);

    }
}
?>