<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();

$currentDate = Date('Y-m-d');
$date = ['from' => $currentDate, 'to' => $currentDate];

//получаем всех агентов
$sql = "SELECT * FROM managers";
$agents = $db->getData($sql);

if($agents) {
	foreach($agents as $key => $value) {
		$agentId = $agents[$key]['id'];
		$tableName = "agent_".$agentId;

		//получаем количество входящих за сегодня
		$updateSql = "UPDATE $tableName SET incomeCalls";
	}
}