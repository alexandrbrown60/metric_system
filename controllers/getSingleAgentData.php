<?php
header("content-type: application/javascript");
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/database/AgentData.php";

$id = $_POST['id'];
$db = new DatabaseManager(DATABASE_NAME);
$agentData = new AgentData($db);

$table = "agent_$id";

//getting summ of data from table
$getSumm = "SELECT SUM(calls) AS calls, 
				   SUM(meetings) AS meetings
				   FROM $table";
$summ = $db->getData($getSumm);
$callSumm = $summ[0]['calls'];
$meetingsSumm = $summ[0]['meetings'];

echo json_encode(array(
	'labels' => array('Исходящие', 'Встречи'),
	'colors' => array('#FFB178', '#FF3C8E'),
	'values' => array($callSumm, $meetingsSumm)
	)
);
