<?php
header("Content-type: text/html; charset=utf-8");
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require "../modules/globals.php";
require "../modules/classes/database/Connection.php";
require "../modules/classes/database/DatabaseManager.php";
require "../telegram/classes/Telegram.php";

$db = new DatabaseManager(DATABASE_NAME);
$tg = new Telegram();


