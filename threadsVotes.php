<?php
include_once "core/init.php";

$user = new User();
if(Input::exists()){

    $post_id = Input::get('id');
    $value = Input::get('value');

    $vote = new ThreadsVote();
    $post = new Threads();
    $post->activeRecord()->relate(['id' =>  $post_id]);

    if(!$vote->activeRecord()->hasOneCondition(ThreadsVote::tableName(), ['user_id' =>  $user->activeRecord()->getId()],'AND', ['post_id'    =>   $post_id])){



        $vote->activeRecord()->create([
            'post_id'        =>      $post_id,
            'user_id'       =>      $user->activeRecord()->getId(),
            'status'        =>      1
        ]);

        $post->activeRecord()->update([
            'votes'     =>      $post->activeRecord()->data()->votes + ($value)
        ]);

        echo  $post->activeRecord()->data()->votes + ($value);
    }else{

        echo  $post->activeRecord()->data()->votes;
    }



}


?>