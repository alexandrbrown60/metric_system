<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$id = $_GET['id'];

$managerTable = "SELECT * FROM managers WHERE id = ?";
$input = [$id];
$db->getData($managerTable, $input);