<?php 

class DatabaseManager extends Connection {
	
	public function sendRequest($sqlRequest, $inputs = null) {
		$query = PDO::prepare($sqlRequest);	
		$query->execute($inputs) or die(print_r($query->errorInfo(), true));	
	}

	public function getData($sqlRequest, $inputs = null) {
		$query = PDO::prepare($sqlRequest);

		if($inputs != null) {
			$query->execute($inputs) or die(print_r($query->errorInfo(), true));
		} else {
			$query->execute() or die(print_r($query->errorInfo(), true));
		}
		
		return $query->fetchAll();
	}

	public function createTable($sql) {
		$query = PDO::prepare($sql);
		$query->execute();
	}
}
