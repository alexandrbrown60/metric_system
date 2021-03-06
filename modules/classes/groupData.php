<?php 

class groupData {
	private $db;

	public function __construct($database) {
		$this->db = $database;
	}

	//get groups by unique id
	public function getGroups() {
		$sql = "SELECT DISTINCT groupId FROM managers";
		$groups = $this->db->getData($sql);

		return $groups;
	}

	//get agents by group
	public function getAgentsByGroupId($id) {
		$sql = "SELECT name FROM managers WHERE groupId = ?";
		$inputs = [$id];

		$agentsByGroup = $this->db->getData($sql, $inputs);

		return $agentsByGroup;
	}
}