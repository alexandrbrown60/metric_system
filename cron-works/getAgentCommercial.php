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

//данные для поиска квартир агента
$fields = [['id' => 1530, 'value' => 'Наша база']];
if($agents) {
	foreach($agents as $key => $value) {
		$agentId = $agents[$key]['id'];
		$tableName = "agent_".$agentId;

		//получаем количество входящих за сегодня
		$commercial = $crm->getQuantityByFields(2, $fields, $agentId);

		//обновляем базу данных агента
		$sql = "INSERT INTO $tableName (date, commercial) VALUES (?, ?) ON DUPLICATE KEY UPDATE commercial = ?";
		$input = [$currentDate, $commercial, $commercial];

		$db->sendRequest($sql, $input);
	}
}