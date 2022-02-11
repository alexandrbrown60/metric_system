<?php 

class AgentData {
	private $db;
	private $tableName;

	public function __construct($database) {
		$this->db = $database;
	}

	public function setTableName($id) {
		$this->tableName = "agent_$id";
	}


	//getting agent name
	public function name($id) {
		$sql = "SELECT name FROM managers WHERE id = ?";
		$inputs = [$id];
		$result = $this->db->getData($sql, $inputs);
		return $result[0]['name'];
	}

	//getting summ of calls and meeting for build graph
	public function getSummOfCalls($from, $to) {

		$table = $this->tableName;

		//getting summ of data from table
		$getSumm = "SELECT SUM(calls) AS calls, 
						   SUM(meetings) AS meetings
						   FROM $table WHERE (date BETWEEN ? AND ?)";
		$inputs = [$from, $to];
		$summ = $this->db->getData($getSumm, $inputs);

		$callSumm = $summ[0]['calls'];
		$meetingsSumm = $summ[0]['meetings'];

		$result = json_encode(array(
			'labels' => array('Исходящие', 'Встречи'),
			'colors' => array('#FFB178', '#FF3C8E'),
			'values' => array($callSumm, $meetingsSumm)
			)
		);

		return $result;
	}


	//getting summ of columns to build graph
	public function getSummOfSales($from, $to) {
		$table = $this->tableName;

		$getSumm = "SELECT SUM(incomeCalls) AS calls,
						   SUM(presentations) AS presentations,
						   SUM(zadatki) AS zadatki,
						   SUM(sdelki) AS sdelki
						   FROM $table WHERE (date BETWEEN ? AND ?)";
		$inputs = [$from, $to];
		$summ = $this->db->getData($getSumm, $inputs);

		$callSumm = $summ[0]['calls'];
		$presentationsSumm = $summ[0]['presentations'];
		$zadatkiSumm = $summ[0]['zadatki'];
		$sdelkiSumm = $summ[0]['sdelki'];

		$result = json_encode(array(
			'labels' => array('Входящие', 'Презентации', 'Задатки', 'Сделки'),
			'colors' => array('#FFB178', '#FF3C8E'),
			'values' => array($callSumm, $presentationsSumm, $zadatkiSumm, $sdelkiSumm)
		)
		);

		return $result;
	}


	//getting proprtys quantity for display on agent page
	public function getObjectsQuantity() {
		$table = $this->tableName;

		$getObjects = "SELECT flats, flatsExclusive, houses, housesExclusive, commercial, commercialExclusive FROM $table ORDER BY date DESC LIMIT 2";
		$objects = $this->db->getData($getObjects);

		$result = [
			'Квартиры' => [$objects[1]['flats'], $objects[1]['flatsExclusive']],
			'Дома и участки' => [$objects[1]['houses'], $objects[1]['housesExclusive']],
			'Коммерция' => [$objects[1]['commercial'], $objects[1]['commercialExclusive']]
		];

		$returning = "";
		foreach ($result as $key => $value) {
			$returning .= '<div class="data-box">';
			$returning .= "<p>$key</p>";
			$returning .= '<div class="simple-info">
                  <p class="main-data">'.$result[$key][0].'/'.$result[$key][1].'';
            $returning .= '</p>
                </div>   
              </div>';

		}

		return $returning;

	}


	//getting report for display on agent page
	public function getReports() {
		$table = $this->tableName;

		$day = date('Y-m-d', strtotime('-7 day'));
		$getTable = "SELECT * FROM $table WHERE date >= ?";
		$input = [$day];

		$result = $this->db->getData($getTable, $input);

		$return = "";

		foreach ($result as $key => $value) {
			$return .= "<tr>";
			$return .= "<td>".date('d.m.Y', strtotime($result[$key]['date']));
			$return .= "<td class='rc1'>".$result[$key]['calls'];
			$return .= "<td class='rc1'>".$result[$key]['meetings'];
			$return .= "<td class='rc2'>".$result[$key]['incomeCalls'];
			$return .= "<td class='rc2'>".$result[$key]['presentations'];
			$return .= "<td class='rc2'>".$result[$key]['additional'];
			$return .= "<td class='rc3'>".$result[$key]['zadatki'];
			$return .= "<td class='rc3'>".$result[$key]['sdelki'];
			$return .= "<td class='rc4'>".$result[$key]['flats']."/".$result[$key]['flatsExclusive'];
			$return .= "<td class='rc4'>".$result[$key]['houses']."/".$result[$key]['housesExclusive'];
			$return .= "<td class='rc4'>".$result[$key]['commercial']."/".$result[$key]['commercialExclusive'];
		}

		return $return;
	}

	//delete agent from managers table and his/him table also
	public function deleteAgent($id) {
		$table = "agent_$id";

		//delete agent from managers table
		$deleteFromManagers = "DELETE FROM managers WHERE id = ?";
		$deleteId = [$id];
		$this->db->sendRequest($deleteFromManagers, $deleteId);

		//drop agent table
		$dropTable = "DROP TABLE IF EXIST $table";
		$this->db->createTable($dropTable);
	}

	//change group id
	public function changeGroupId($id, $newGroupId) {
		$table = "agent_$id";

		//sql request
		$sql = "UPDATE managers SET groupId = ? WHERE id = ?";
		$inputs = [$newGroupId, $id];
		$this->db->sendRequest($sql, $inputs);
	}
}