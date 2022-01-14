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
$districts = ["Вахитовский", "Советский", "Приволжский", "Ново-Савиновский", "Московский", "Кировский", "Авиастроительный"];
$rooms = [1, 2, 3, 4];
$flatTypes = ["квартира вторичка", "квартира новостройка", "комнаты и доли"];
$exclusive = [0, 1];

for($i = 0; $i < count($districts); $i++) {
	for($j = 0; $j < count($rooms); $j++) {
		for($k = 0; $k < count($flatTypes); $k++) {
			for($m = 0; $m < count($exclusive); $m++) {
				$quantity = $crm->getQuantityByFields(1, [
					['id' => 630, 'value' => $districts[$i]],
					['id' => 446, 'value' => $rooms[$j]],
					['id' => 776, 'value' => $flatTypes[$k]],
					['id' => 1544, 'value' => $exclusive[$m]]
				]);

				$data = [$date, $quantity, $rooms[$j], $districts[$i], $exclusive[$m], $flatTypes[$k]];
				$sql = "INSERT INTO flats (date, quantity, rooms, district, exclusive, type) VALUES (?, ?, ?, ?, ?, ?)";
				$db->sendRequest($sql, $data);
			}
		}
	}
}