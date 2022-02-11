<?php 
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/groupData.php";

$db = new DatabaseManager(DATABASE_NAME);
$groupsData = new groupData($db);

$group = $groupsData->getGroups();

foreach ($group as $key => $value) {
	echo '<div class="col-3">';
	echo '<a href="https://kluch.me/kluch_metrics/views/group.php?id='.$group[$key]['groupId'].'">';
	echo '<div class="data-box"';
	echo '<p>Группа №'.$group[$key]['groupId'].'</p>';
	echo '</div></a></div>';
}