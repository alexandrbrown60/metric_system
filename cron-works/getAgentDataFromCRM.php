<?php 
require "modules/globals.php";
require "modules/classes/database/Connection.php";
require "modules/classes/database/DatabaseManager.php";
require "modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date("d-m-Y");

