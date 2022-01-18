<?php 
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date("Y-m-d");

//get managers table
$agentsSql = "SELECT * FROM managers";
$agents = $db->getData($agentsSql);
$incomeCalls = $crm->getIncomeCalls(24, $date);
		print_r($incomeCalls);
// if($agetns) {
// 	//get data from crm for each agent
// 	foreach($agetns as $key => $value) {
// 		$agentId = $agetns[$key]['id'];


// 	}
// }
