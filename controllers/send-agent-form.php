<?php
require '../modules/globals.php';
require '../modules/classes/database/Connection.php';
require '../modules/classes/database/DatabaseManager.php';
require '../modules/classes/crm/CrmManager.php';

$id = $_POST['agent-id'];
$meetings = $_POST['meetings'];
$calls = $_POST['calls'];
$presentations = $_POST['presentations'];
$additional = $_POST['additional'];
$zadatki = $_POST['zadatki'];
$sdelki = $_POST['sdelki'];

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date('Y-m-d');
$agent = $crm->getAgentInfo($id);
$divisionId = $agent->$id->division_id;
$agentName = $agent->$id->name . " " . $agent->$id->surname;
$table = "agent_$id";

//Записываем данные в таблицу риелтора
$addData = "INSERT IGNORE INTO $table (date, calls, meetings, presentations, additional, zadatki, sdelki) VALUES (?, ?, ?, ?, ?, ?, ?);"
$db->sendRequest($addData, [$date, $calls, $meetings, $presentations, $additional, $zadatki, $sdelki]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Форма отчета успешно отправлена | Kluch Metrics</title>

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
	<style type="text/css">
		html, body {
			height: 100%
		}
		body {
			background-color: #00b3ff;
			color: #fefefe;
		}
		.col-12 {
			padding-top: 15%;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1>👌</h1>
				<h2>Отчет отправлен!</h2>
			</div>
		</div>
	</div>
</body>
</html>
