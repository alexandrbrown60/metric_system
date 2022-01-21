<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$id = $_GET['id'];

$managerTable = "SELECT * FROM managers WHERE id = ?";
$input = [$id];
$agent = $db->getData($managerTable, $input);

$agentName = $agent[0]['name'];

//getting data from table
$table = "agent_".$id;
$tableInfo = "SELECT * FROM $table ORDER BY date DESC LIMIT 1";
$info = $db->getData($tableInfo);

$date = date('d-m-Y', strtotime($info[0]['date']));

$displayTable = [
	'Исходящие' => $info[0]['calls'],
	'Встречи' => $info[0]['meetings'],
	'Презентации' => $info[0]['presentations'],
	'Доп. презентации' => $info[0]['additional'],
	'Задатки' => $info[0]['zadatki'],
	'Сделки' => $info[0]['sdelki'],
	'Входящие' => $info[0]['incomeCalls'],
	'Квартиры' => $info[0]['flats'],
	'Экс. квартиры' => $info[0]['flatsExclusive'],
	'Дома и участки' => $info[0]['houses'],
	'Экс. дома и участки' => $info[0]['housesExclusive'],
	'Коммерция' => $info[0]['commercial'],
	'Экс. коммерция' => $info[0]['commercialExclusive']
];
