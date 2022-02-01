<?php
header("content-type: application/javascript");
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/database/AgentData.php";

$dataType = $_POST['dataType'];
$id = $_POST['id'];
$dateFrom = isset($_POST['dateFrom']) ? date('Y-m-d', strtotime($_POST['dateFrom'])) : date('Y-m-d', strtotime("2022-01-01"));
$dateTo = isset($_POST['dateFrom']) ? date('Y-m-d', strtotime($_POST['dateTo'])) : date('Y-m-d');

$db = new DatabaseManager(DATABASE_NAME);
$agentData = new AgentData($db);

$agentData->setTableName($id);


switch ($dataType) {
	case 'summOfCalls':
		$summOfCalls = $agentData->getSummOfCalls($dateFrom, $dateTo);
		echo $summOfCalls;
		break;
	case 'summOfSales':
		$summOfSales = $agentData->getSummOfSales($dateFrom, $dateTo);
		echo $summOfSales;
		break;
	case 'objectsQuantity':
		$objects = $agentData->getObjectsQuantity();
		echo $objects;
		break;
	case 'reportsTable':
		$report = $agentData->getReports();
		echo $report;
		break;
	default:
		break;
}
