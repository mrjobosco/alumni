<?php
include_once 'core/init.php';


$chat = new Chat();

$user = new User();

$id = (int) $user->activeRecord()->getId();

$chat_id = (int) Input::get('chat_id');


$msg = $chat->getChat($chat_id, $id);

header("Content-Type: text/xml");

$dom = new DOMDocument('1.0','UTF-8');

$dom-> xmlStandAlone = true;

$response = $dom->createElement('response');
$dom->appendChild($response);

$author = $dom->createElement('author');
$authorId = $dom->createTextNode($msg->id);
$author->appendChild($authorId);

$content = $dom->createElement('content');
$contentText = $dom->createTextNode($msg->content);
$content->appendChild($contentText);

$createTime = $dom->createElement('createTime');
$createTimeVal = $dom->createTextNode($msg->updateTime);
$createTime->appendChild($createTimeVal);

$response->appendChild($author);
$response->appendChild($content);
$response->appendChild($createTime);


$xmlString = $dom->saveXML();

echo $xmlString;
?>