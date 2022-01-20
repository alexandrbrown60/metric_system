<?php 
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";

$db = new DatabaseManager(DATABASE_NAME);

$sql = "SELECT * FROM managers ORDER BY groupId";
$agents = $db->getData($sql);

if($agents) {
	foreach($agents as $key => $value) {
		$id = $agents[$key]['id'];
		$name = $agents[$key]['name'];
		$division = $agents[$key]['groupId'];
		$status = $agents[$key]['onVacation'] == 0 ? "Работает" : "В отпуске";
		echo "<tr><td>";
		echo "$name </td><td>";
		echo "$division </td><td>";
		echo "$status </td><td>";
		echo "<a href='#'>Удалить</a></td></tr>";
	}
}