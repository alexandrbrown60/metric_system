<?php
header("Content-type: text/html; charset=utf-8");
//ошибки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../modules/globals.php';
require '../modules/classes/crm/CrmManager.php';
require 'classes/Telegram.php';

$crm = new CrmManager();

$update = json_decode(file_get_contents("php://input"), JSON_OBJECT_AS_ARRAY);
$tg = new Telegram($update);

if($tg->isMessage()) {
	if($tg->userMessage == "/start") {
		$text = "Укажите id своего профиля в IntrumCRM";
		$tg->sendMessage(["chat_id" => $tg->userId, "text" => $text]);
	} 
	else {
		if(is_numeric($tg->userMessage) && strlen($tg->userMessage) < 5) {
			$id = intval($tg->userMessage);
			$agentInfo = $crm->getAgentInfo($id);
			if($agentInfo->$id->status == "onstate") {
				$name = $agentInfo->$id->name;
				$surname = $agentInfo->$id->surname;
				$text = "Вы $name $surname?";

	            $button1 = array("text" => "Верно", "callback_data" => "$id");
	            $button2 = array("text" => "Неверно", "callback_data" => "fail");
	            $inlineKeyboard = [[$button1], [$button2]];
	            $keyboard = ["inline_keyboard" => $inlineKeyboard];
	            $replyMarkup = json_encode($keyboard);

				$tg->sendMessage(["chat_id" => $tg->userId, "text" => $text, "reply_markup" => $replyMarkup]);
			}
			else {
				$text = "Агента с таким id не существует или его аккаунт не активен";
				$tg->sendMessage(["chat_id" => $tg->userId, "text" => $text]);
			}
		}
		else {
			$text = "Вы ввели неверные данные.";
			$tg->sendMessage(["chat_id" => $tg->userId, "text" => $text]);
		}
	}
}
// else {
// 	$clickedButton = $tg->clickedButton;
//     $chatId = $tg->userId;

//     if($clickedButton == "fail") {
//     	$text = "Введите ID своего профиля в CRM. Если вы не знаете, как его узнать, обратитесь за помощью к руководителю.";
//     	$tg->sendMessage("chat_id" => $chatId, "text" => $text);
//     } else {
//     	$text = "Ваш id: $clickedButton";
//     	$tg->sendMessage("chat_id" => $chatId, "text" => $text);
//     }
// }


