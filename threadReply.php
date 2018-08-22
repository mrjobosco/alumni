<?php

include_once 'core/init.php';
$user = new User();

if(!$user->isLoggedIn()){
    Session::flash('login', 'Login to participate');
    echo 'false';
    die();

}

if (Input::exists()){



    $post_id = Input::get('id');
    $comment = Input::get('reply');

    $reply = new ThreadsReply();

    $reply->activeRecord()->create([

        'thread_id'       =>  $post_id,
        'reply'         =>  $comment,
        'creator_id'    =>  $user->activeRecord()->getId(),
        'create_time'   =>  time()


    ]);

}

?>