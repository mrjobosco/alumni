<?php
include_once 'core/init.php';

$chat = new Chat();
$user = new User();
//echo $user->activeRecord()->getId().' '.Input::get('id');


$messages =  $chat->getAllChat($user->activeRecord()->getId(), Input::get('id'));

//echo var_dump($messages);

$content = [];
$updateTime = [];
$postId = [];
$author = [];
$receiver = [];

foreach ($messages as $key) {
    $content[] = $key->content;
    $updateTime[] = $key->updateTime;
    $postId[] = $key->id;
    $author [] = $key->user1;
    $receiver[] = $key->user2;
}

//Header("Content-Type: text/xml");

$dom = new DOMDocument('1.0', 'UTF-8');
$dom-> xmlStandAlone = true;

$response = $dom->createElement('response');
$dom->appendChild($response);

$j = 0;
foreach ($content as $key) {
    $comment = $dom->createElement("child");

    $talk		= $dom->createElement('comment');
    $time 		= $dom->createElement('time');
    $id			= $dom->createElement('postId');
    $authorName = $dom->createElement('authorName');
    $user_id = $dom->createElement('userId');

    $val1 = $dom->createTextNode($content[$j]);
    $val2 = $dom->createTextNode($postId[$j]);
    $val3 = $dom->createTextNode($updateTime[$j]);
    $val5 = $dom->createTextNode($receiver[$j]);
    $val6 = (int) $user->activeRecord()->getId();


    $talk->appendChild($val1);
    $id->appendChild($val2);
    $time->appendChild($val3);
    $authorName->appendChild($val5);
    $user_id->appendChild($val6);


    $comment->appendChild($talk);
    $comment->appendChild($id);
    $comment->appendChild($time);
    $comment->appendChild($authorName);
    $comment->appendChild($user_id);



    $response->appendChild($comment);
    $j++;

}
$xmlString = $dom-> saveXML();

echo $xmlString;


?>