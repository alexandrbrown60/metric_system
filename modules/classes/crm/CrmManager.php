<?php

class CrmManager {

	private $domain = "http://kluch.intrumnet.com:81/sharedapi";

	private function initCurl($method, $params) {
		$url = $this->domain.$method;

		$post = array(  
		        'apikey' => CRM_API_KEY,  
		        'params'=> $params  
		    );  
		          
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_POST, 1);  
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		$result = json_decode(curl_exec($ch));  
		curl_close ($ch);

		return $result;
	}

	//получение всех объектов типа $types по фильтрам $fields
	public function getQuantityByFields($type, $fields) {
		$method = "/stock/filter";

		$params=array(  
            'type'=>$type,  
            'limit'=>0,  
            'fields' => $fields,   
            'order'=> "desc",
            'count_total' => 1  
        );  
      
		$result = $this->initCurl($method, $params);

		return $result->data->count;
	}


	//получение данных об агенте по id
	public function getAgentInfo($id) {
		$method = "/worker/filter";

		$params=array(      
                "id" => array($id)    
        );  
      
		$result = $this->initCurl($method, $params);

		return $result->data; 
	}

	//получение кол-ва входящих звонков
	public function getIncomeCalls($id, $date) {
		$method = "/applications/filter";

		$params = array(
			'manager' => $id,
			'limit' => 1,
			'count_total' => 1,
			'date' => array(
				'from' => $date,
				'to' => $date
			)
		);

		$result = $this->initCurl($method, $params);
		return $result->data->count;
	}

 }