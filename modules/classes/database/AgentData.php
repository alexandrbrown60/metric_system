<?php 

class AgentData {
	private $db;

	public function __construct($database) {
		$this->db = $database;
	}

	public function name($id) {
		$sql = "SELECT name FROM managers WHERE id = ?";
		$inputs = [$id];
		$result = $this->db->getData($sql, $inputs);
		return $result[0]['name'];
	}
}