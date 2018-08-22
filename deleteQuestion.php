<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 30/10/2016
 * Time: 06:35
 */

include_once 'core/init.php';
if(Input::exists()){

    $topic = new Questions();
    $topic->activeRecord()->relate(['id'    =>  Input::get('id')]);
    $topic->delete();

    echo 'done';

}

?>
