<?php 

class DatabaseManager extends Connection {
	
	public function sendRequest($sqlRequest, $inputs = null) {
		$query = PDO::prepare($sqlRequest);
		$query->execute($inputs) or die(print_r($query->errorInfo(), true));
	}
}