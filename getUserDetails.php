<?php
include_once 'core/init.php';


if(Input::exists()){


    $user = new User();

    $user->activeRecord()->relate(['id'     =>  Input::get('id')]);

    Header("Content-Type: text/xml");

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom-> xmlStandAlone = true;

    $response = $dom->createElement('response');
    $dom->appendChild($response);

    $j = 0;

        $comment = $dom->createElement("child");

        $names		    = $dom->createElement('names');
        $picture 		= $dom->createElement('picture');
        $phone		    	= $dom->createElement('phone_number');
        $year = $dom->createElement('year_of_graduation');
        $department    = $dom->createElement('department');
        $place_of_work    = $dom->createElement('place_of_work');




        $names->appendChild($dom->createTextNode($user->activeRecord()->data()->first_name.' '.$user->activeRecord()->data()->last_name));
        $picture->appendChild($dom->createTextNode($user->activeRecord()->data()->profile_picture));
        $phone->appendChild($dom->createTextNode($user->activeRecord()->data()->phone_number.'.'));

        $year->appendChild($dom->createTextNode($user->activeRecord()->data()->year_of_graduation.'.'));
        $department->appendChild($dom->createTextNode($user->activeRecord()->data()->department.'.'));
        $place_of_work->appendChild($dom->createTextNode($user->activeRecord()->data()->place_of_work.'.'));


        $comment->appendChild($names);
        $comment->appendChild($picture);
        $comment->appendChild($phone);
        $comment->appendChild($year);
        $comment->appendChild($department);
        $comment->appendChild($place_of_work);



        $response->appendChild($comment);

    $xmlString = $dom->saveXML();

    echo $xmlString;


}


?>