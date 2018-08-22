<?php
include_once 'core/init.php';

$user = new User();
if(Input::exists()){
    $chat = new Chat();

    $last_chat = $chat->getAllChat($user->activeRecord()->getId(), Input::get('id'));

    $count = count($last_chat);

    $currentTime = $last_chat[$count - 1]->updateTime;

    $chat_event = new ChatEvent();

    $lastSeen =  $chat_event->getLastSeen($user->activeRecord()->getId(), Input::get('id'));



    $allchat = $chat_event->getCount(Input::get('id'), $user->activeRecord()->getId());

    $count2 = count($allchat);

    $chat_event->activeRecord()->update([
        'currentChatTime'	 => $count2,
        'lastCheckedTime'	 => $count2

    ]);

}
else{
    Redirect::to('index.php');
}

?>