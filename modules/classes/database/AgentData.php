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

	public function name($id) {
		$sql = "SELECT name FROM managers WHERE id = ?";
		$inputs = [$id];
		$result = $this->db->getData($sql, $inputs);
		return $result[0]['name'];
	}

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

	public function getReports() {

	}
}