<?php
header("Content-type: text/html; charset=utf-8");
//ошибки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../modules/globals.php';
require '../modules/classes/crm/CrmManager.php';
require '../modules/classes/database/Connection.php';
require '../modules/classes/database/DatabaseManager.php';
require 'classes/Telegram.php';

$crm = new CrmManager();
$db = new DatabaseManager(DATABASE_NAME);

$update = json_decode(file_get_contents("php://input"), JSON_OBJECT_AS_ARRAY);
$tg = new Telegram();
$tg->getUpdate($update);

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
else {
	$agentId = $tg->clickedButton;
    $chatId = $tg->userId;

    if($agentId == "fail") {

    	$text = "Введите ID своего профиля в CRM. Если вы не знаете, где его получить, обратитесь за помощью к руководителю.\n\nНе вводите любой номер! Это может привести к ошибкам.";
    	$tg->sendMessage(["chat_id" => $chatId, "text" => $text]);

    } else {
    	//1. get agent info from crm
    	$agent = $crm->getAgentInfo($agentId);
    	$agentName = $agent->$agentId->name . " " . $agent->$agentId->surname;
    	$groupId = $agent->$agentId->division_id;
    	$tableName = "agent_$agentId";

    	//2. create row in manager table
    	$sql = "INSERT IGNORE INTO managers (id, telegram, name, groupId, tableName) VALUES (?, ?, ?, ?, ?)";
    	$inputs = [$agentId, $chatId, $agentName, $groupId, $tableName];
    	$db->sendRequest($sql, $inputs);

    	//3. create a new table for this manager
		$columns = "date DATE PRIMARY KEY,
					calls INT ( 11 ) NULL,
					meetings INT ( 11 ) NULL,
					presentations INT ( 11 ) NULL,
					additional INT ( 11 ) NULL,
					zadatki INT ( 11 ) NULL,
					sdelki INT ( 11 ) NULL,
					incomeCalls INT ( 11 ) NULL,
					flats INT ( 11 ) NULL,
					flatsExclusive INT ( 11 ) NULL,
					houses INT ( 11 ) NULL,
					housesExclusive INT ( 11 ) NULL,
					commercial INT ( 11 ) NULL,
					commercialExclusive INT ( 11 ) NULL
					";

		$db->createTable("CREATE TABLE IF NOT EXISTS $tableName ($columns)");


		//4. Send message to user
    	$text = "Ваш телеграм успешно привязан к системе отчетов.\n\nЕжедневно в 20:00 вам будет приходить форма, которую необходимо заполнить.";
    	$tg->sendMessage(["chat_id" => $chatId, "text" => $text]);
    }
}


