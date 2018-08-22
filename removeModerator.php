<?php

include_once 'core/init.php';

if (Input::exists()){


    $user_id = Input::get('id');

    $user = new User();

    $user->activeRecord()->relate(['id'   =>  $user_id]);

    $user->activeRecord()->update([

        'user_type' =>  4
    ]);

    echo 'Done';


}



?>