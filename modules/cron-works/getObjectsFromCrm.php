<?php

require "../globals.php";
require "../classes/database/Connection.php";
require "../classes/database/DatabaseManager.php";
require "../classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);
$crm = new CrmManager();

//фильтры для всех типов объектов
$allFlats = [];
$allHouses = [];
$allCommercial = [];

//фильтры для квартир

//фильтры для коммерции

//фильтры для домов и участков

//Получаем данные из CRM и записываем в БД
// 1. Общие данные
$flatsQ = $crm->getQuantityFor(1, $allFlats);
$housesQ = $crm->getQuantityFor(3, $allHouses);
$commercialQ = $crm->getQuantityFor(2, $allCommercial);

$sql = "INSERT INTO generalPropertiesData (date, flats, commercial, houses) VALUES (?, ?, ?, ?)";
$inputs = [date(), $flatsQ, $commercialQ, $housesQ];
$db->sendRequest($sql, $inputs);

// 2. Данные по квартирам

// 3. Данные по коммерции

// 4. Данные по домам и участкам

