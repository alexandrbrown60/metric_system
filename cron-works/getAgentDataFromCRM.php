<?php 
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$lastWeek = ['from' => Date('Y-m-d', strtotime('-6 day')), 'to' => Date('Y-m-d')]

//получаем всю статистику по агентам за неделю
$incomeCalls = $crm->getIncomeCalls($date);
print_r($incomeCalls);


