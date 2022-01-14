<?php
require '../modules/globals.php';
require '../modules/classes/database/Connection.php';
require '../modules/classes/database/DatabaseManager.php';
require '../modules/classes/crm/CrmManager.php';

$id = $_POST['agent-id'];
$telegram = $_POST['telegram'];
$meetings = $_POST['meetings'];
$calls = $_POST['calls'];
$presentations = $_POST['presentations'];
$additional = $_POST['additional'];
$zadatki = $_POST['zadatki'];
$sdelki = $_POST['sdelki'];

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$agent = $crm->getAgentInfo($id);
$divisionId = $agent->$id->division_id;
$agentName = $agent->$id->name . " " . $agent->$id->surname;

// Создаем новую таблицу, в которую будут записываться данные отчета
$table = "agent_$id";
$columns = "date DATE PRIMARY KEY,
			calls INT ( 11 ),
			meetings INT ( 11 ),
			presentations INT ( 11 ),
			additional INT ( 11 ),
			zadatki INT ( 11 ),
			sdelki INT ( 11 ),
			incomeCalls INT ( 11 ),
			flats INT ( 11 ),
			flatsExclusive INT ( 11 ),
			houses INT ( 11 ),
			housesExclusive INT ( 11 ),
			commercial INT ( 11 ),
			commercialExclusive INT ( 11 )
			";

$db->sendRequest("CREATE TABLE IF NOT EXIST $table($columns)");

//Добавляем риелтора в таблицу
$addAgent = "INSERT IGNORE INTO managers (id, telegram, name, groupId, tableName) VALUES (?, ?, ?, ?, ?)";
$db->sendRequest($addAgent, [$id, $telegram, $name, $divisionId, $table]);

//Записываем данные в таблицу риелтора
$addData = "INSERT INTO $table ()"
