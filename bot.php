<?php
require __DIR__.'/config/config.php';
require __DIR__.'/core/apiVK.php';
$v = new vk();
$confirmation_token = 'токен';
//Ключ доступа сообщества
$token = 'токен';

if (!isset($_REQUEST)) {
  return;
}


//Получаем и декодируем уведомление
$data = $v->get();

//Проверяем, что находится в поле "type"
switch ($data->type) {
  //Если это уведомление для подтверждения адреса сервера...
  case 'confirmation':
    //...отправляем строку для подтверждения адреса
    echo $confirmation_token;
    break;

//Если это уведомление о новом сообщении...
  case 'message_new':
    //...получаем id его автора
    $uid = $data->object->user_id;
  $user_msg = $data->object->body;

    //затем с помощью users.get получаем данные об авторе
    $user_info = $v->usersGet($uid);

//и извлекаем из ответа его имя
  $info = array_shift(json_decode($user_info)->response);
  $uname = $info->first_name;

  //С помощью messages.send и токена сообщества отправляем ответное сообщение

  //Главное Меню
  $user_msg = mb_strtolower($user_msg);
    if (strpos($user_msg, 'команда 1') !== false or strpos($user_msg, 'команда 1-1') !== false or strpos($user_msg, 'команда 1-1-1') !== false) {
      $v->msgsend("ответ на команду", $uid, $token, $attachment);

}elseif ($user_msg == 'команда 2'){
  $v->msgsend("ответ на команду", $uid, $token, $attachment);


// Ответ бота на не понятную команду.
     }else{
     $v->msgsend("
     Я тебя не понимаю.", $uid, $token);
     }
//Возвращаем "ok" серверу Callback API
    echo('ok');
die;
break;
}
?>
