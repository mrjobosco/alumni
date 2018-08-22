<?php
include_once "core/init.php";

$user = new User();
if(Input::exists()){

    $post_id = Input::get('id');
    $value = Input::get('value');

    $vote = new Votes();
    $post = new Post();
    $post->activeRecord()->relate(['id' =>  $post_id]);

    if(!$vote->activeRecord()->hasOneCondition(Votes::tableName(), ['user_id' =>  $user->activeRecord()->getId()],'AND', ['post_id'    =>   $post_id])){



        $vote->activeRecord()->create([
            'post_id'        =>      $post_id,
            'user_id'       =>      $user->activeRecord()->getId(),
            'status'        =>      1
        ]);

        $post->activeRecord()->update([
            'votes_up'     =>      $post->activeRecord()->data()->votes_down + ($value)
        ]);

        echo  $post->activeRecord()->data()->votes_down + ($value);
    }else{

        echo  $post->activeRecord()->data()->votes_down;
    }



}


?>