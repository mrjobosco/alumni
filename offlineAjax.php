<?php
include_once 'core/init.php';

$chat = new Chat();
$online_users = $chat->off();
$online = [];

foreach ($online_users as $key) {
    $online[] = new User($key->id);
}

$ids =[];
$names = [];


foreach ($online as $key) {
    $names [] = $key->activeRecord()->data()->first_name.' '.$key->activeRecord()->data()->last_name;
    $ids[] = $key->activeRecord()->getId();
}


Header("Content-Type: text/xml");

$dom = new DOMDocument('1.0', 'UTF-8');
$dom-> xmlStandAlone = true;

$response = $dom->createElement('response');
$dom->appendChild($response);


$j = 0;
foreach ($online as $key) {
    $comment = $dom->createElement("child");
    $id = $dom->createElement('id');

    $val3 = $dom->createTextNode($ids[$j]);


    $id->appendChild($val3);


    $comment->appendChild($id);


    $response->appendChild($comment);
    $j++;

}
$xmlString = $dom-> saveXML();

echo $xmlString;


?>
