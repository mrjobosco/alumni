<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 30/10/2016
 * Time: 06:35
 */

include_once 'core/init.php';
if(Input::exists()){

    $user = new User(Input::get('id'));

         $user->deleteUser();

        echo 'done';

}

?>
