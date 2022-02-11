<?php 
require __DIR__."/../modules/globals.php";
require __DIR__."/../modules/classes/database/Connection.php";
require __DIR__."/../modules/classes/database/DatabaseManager.php";
require __DIR__."/../modules/classes/groupData.php";

$db = new DatabaseManager(DATABASE_NAME);
$groupsData = new groupData($db);

$group = $groupsData->getGroups();

foreach ($group as $key => $value) {
	$groupId = $group[$key]['groupId'];
	$agentsByGroup = $groupsData->getAgentsByGroupId($groupId);

	echo '<div class="col-3">';
	echo '<div class="data-box">';
	echo '<a href="https://kluch.me/kluch_metrics/views/group.php?id='.$groupId.'"><p>Группа №'.$groupId.'</p></a>';

	foreach ($agentsByGroup as $key => $value) {
		echo '<p>'.$agentsByGroup[$key]['name'].'</p>';
	}

	echo '</div></div>';
}