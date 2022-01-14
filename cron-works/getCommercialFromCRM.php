<?php
header("Content-type: text/html; charset=utf-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require "../modules/globals.php";
require "../modules/classes/database/Connection.php";
require "../modules/classes/database/DatabaseManager.php";
require "../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date("Y-m-d");


//data for search
$type = ["земля коммерческого назначения", "магазин", "офис", "ресторан", "свободного назначения", "склад", "готовый бизнес"];
$exclusive = [0, 1];

for($i = 0; $i < count($type); $i++) {
	for($m = 0; $m < count($exclusive); $m++) {
		$quantity = $crm->getQuantityByFields(1, [
			['id' => 777, 'value' => $type[$i]],
			['id' => 1565, 'value' => $exclusive[$m]]
		]);

		$data = [$date, $quantity, $type[$i], $exclusive[$m]];
		$sql = "INSERT INTO flats (date, quantity, type, exclusive) VALUES (?, ?, ?, ?)";
		$db->sendRequest($sql, $data);
	}
}