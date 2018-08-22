<?php
include_once 'core/init.php';


$chat = new Chat();
$user = new User();


try{

    $chat->activeRecord()->create([
        'user1' => $user->activeRecord()->getId(),
        'user2' => Input::get('chat_id'),
        'content'=> Input::get('msg'),
        'updateTime'=> time()
    ]);


}
catch(Exception $e){
   echo $user->activeRecord()->getId().' '.Input::get('chat_id').' '.Input::get('msg');
   // die($e->getMessage());
}

echo 'Success';

?>