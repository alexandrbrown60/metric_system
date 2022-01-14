<?php
header("Content-type: text/html; charset=utf-8");
require 'modules/globals.php';
require 'modules/classes/crm/CrmManager.php';

$id = 2222;
$crm = new CrmManager();
$result = $crm->getAgentInfo($id);
print_r($result->$id);