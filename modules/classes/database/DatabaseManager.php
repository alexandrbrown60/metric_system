<?php 

class DatabaseManager extends Connection {
	
	public function sendRequest($sqlRequest, $inputs = null, $return = false) {
		$query = PDO::prepare($sqlRequest);
		$query->execute($inputs) or die(print_r($query->errorInfo(), true));
		if($return) {
			return $query->fetchAll();
		}
	}
}