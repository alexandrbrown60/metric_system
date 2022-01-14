<?php
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

//set fields for search
$flatFields = 1522;
$commercialFields = 1530;
$housesFields = 1538;

//get all general data and set to db
$allFlats = $crm->getQuantityFor(1, $flatFields);
$allCommercial = $crm->getQuantityFor(2, $commercialFields);
$allHouses = $crm->getQuantityFor(3, $housesFields);

$generalObjectsData = [$date, $allFlats, $allHouses, $allCommercial];
print_r($allFlats);

$sql = "INSERT INTO generalPropertiesData (date, flats, houses, commercial) VALUES (?, ?, ?, ?)";
$db->sendRequest($sql, $generalObjectsData);