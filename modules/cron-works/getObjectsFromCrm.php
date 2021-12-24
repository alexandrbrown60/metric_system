<?php

require "../globals.php";
require "../classes/database/Connection.php";
require "../classes/database/DatabaseManager.php";
require "../classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();
$date = Date("d-m-Y");

//get all general data and set to db
$allFlats = $crm->getQuantityFor(1, $flatFields);
$allCommercial = $crm->getQuantityFor(2, $commercialFields);
$allHouses = $crm->getQuantityFor(3, $housesFields);
$generalObjectsData = [$date, $allFlats, $allCommercial, $allHouses];

$sql = "INSERT INTO generalPropertiesData (date, flats, houses, commercial) VALUES (?, ?, ?, ?)";
$db->sendRequest($sql, $generalObjectsData);