<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();

$currentDate = Date('Y-m-d', strtotime("-1 days"));
$date = ['from' => $currentDate, 'to' => $currentDate];

//получаем всех агентов
$agentsSql = "SELECT * FROM managers";
$agents = $db->getData($agentsSql);

if($agents) {
	foreach($agents as $key => $value) {
		$agentId = $agents[$key]['id'];
		$tableName = "agent_".$agentId;

		//получаем количество входящих за сегодня
		$incomeCalls = $crm->getIncomeCalls($date, $agentId);

		//обновляем базу данных агента
		$sql = "INSERT INTO $tableName (date, incomeCalls) VALUES (?, ?) ON DUPLICATE KEY UPDATE incomeCalls = ?";
		$input = [$currentDate, $incomeCalls, $incomeCalls];

		$db->sendRequest($sql, $input);
	}
}