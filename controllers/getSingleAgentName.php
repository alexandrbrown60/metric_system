<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/database/AgentData.php";

$db = new DatabaseManager(DATABASE_NAME);
$agentData = new AgentData($db);

$id = $_GET['id'];

$agentName = $agentData->name($id);

