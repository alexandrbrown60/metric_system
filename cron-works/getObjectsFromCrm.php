<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date("Y-m-d");

//set fields for search
$flatFields = [['id' => 1522, 'value' => "Наша база"]];
$commercialFields = [['id' => 1530, 'value' => "Наша база"]];
$housesFields = [['id' => 1538, 'value' => "Наша база"]];

//get all general data and set to db
$allFlats = $crm->getQuantityByFields(1, $flatFields);
$allCommercial = $crm->getQuantityByFields(2, $commercialFields);
$allHouses = $crm->getQuantityByFields(3, $housesFields);

$generalObjectsData = [$date, $allFlats, $allHouses, $allCommercial];

$sql = "INSERT INTO generalPropertiesData (date, flats, houses, commercial) VALUES (?, ?, ?, ?)";
$db->sendRequest($sql, $generalObjectsData);