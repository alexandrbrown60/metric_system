<?php
header("Content-type: text/html; charset=utf-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../telegram/classes/Telegram.php";

$db = new DatabaseManager(DATABASE_NAME);
$tg = new Telegram();

$sql = "SELECT * FROM managers";
$agents = $db->getData($sql);

if($agents) {
	foreach ($agents as $key => $value) {
		$agentId = $agents[$key]['id'];
		$url = "https://kluch.me/kluch_metrics/views/form.php?id=$agentId";

		$button = array("text" => "Заполнить➡️", "url" => $url);
        $inlineKeyboard = [[$button]];
        $keyboard = ["inline_keyboard" => $inlineKeyboard];
        $replyMarkup = json_encode($keyboard);

		$text = "Привет✌️\nПришло время заполнить ежедневный отчет📊";
		$tg->sendMessage(['chat_id' => $agents[$key]['telegram'], 'text' => $text, 'reply_markup' => $replyMarkup]);
	}
}


