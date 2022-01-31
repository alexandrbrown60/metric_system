<?php
require 'modules/globals.php';
require 'modules/classes/crm/CrmManager.php';

$crm = new CrmManager();
$type = $_POST['type'] ? $_POST['type'] : 1;
$defaultfields = [
	['id' => 1522, 'value' => "Наша база"],
	['id' => 446, 'value' => 1]
];

$fields = $_POST['fields'] : $_POST['fields'] : $defaultfields;

$objects = $crm->getDetailedObjects($type, $fields);