<?php
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/crm/CrmManager.php";

$db = new DatabaseManager(DATABASE_NAME);

$sql = "SELECT * FROM generalPropertiesData ORDER BY date DESC LIMIT 2";
$objects = $db->getData($sql);


$lastDay = date('d-m-Y', strtotime($objects[1]['date']));
$lastFlats = $objects[1]['flats'];


$day = date('d-m-Y', strtotime($objects[0]['date']));
$flats = $objects[0]['flats'];

$flatsGrowth = $flats - $lastFlats;
if($flatsGrowth > 0) {
	$flatsGrowth = "+".$flatsGrowth;
} else {
	echo '<style type="text/css">.data-box #flat-growth {color:#bc4e4e}</style>';
}

//houses
$lastHouses = $objects[0]['houses'];
$houses = $objects[1]['houses'];

$housesGrowth = $houses - $lastHouses;
if($housesGrowth > 0) {
	$housesGrowth = "+".$housesGrowth;
} else {
	echo '<style type="text/css">.data-box #houses-growth {color:#bc4e4e}</style>';
}

//commercial
$lastComm = $objects[0]['commercial'];
$comm = $objects[1]['commercial'];

$commGrowth = $comm - $lastComm;
if($commGrowth > 0) {
	$commGrowth = "+".$commGrowth;
} else {
	echo '<style type="text/css">.data-box #comm-growth {color:#bc4e4e}</style>';
}




