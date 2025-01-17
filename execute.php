<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$response = "";
if(strpos($text, "/start") === 0 ) {
	$response = "Ciao $firstname! \nMi presento, sono il tuo Bot.\nIl tuo chat_id da inserire sul nostro sito, all'interno della sezione Gestione Profilo, per ricevere le notifiche è: $chatId";
	sendMsg($chatId, $response);
}

function sendMsg($id, $msg) {
	$token = "978219762:AAHaFe80I5p2Rlooe7dEN3KaGLJIxiyxReE";

	$data = [
		'text' => $msg,
		'chat_id' => $id
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}
