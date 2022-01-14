<?php

class CrmManager {

	private $domain = "http://kluch.intrumnet.com:81/sharedapi";

	//получение всех объектов типа $types по фильтрам $fields
	public function getQuantityFor($type, $fieldId) {
		$method = "/stock/filter";
		$url = $this->domain.$method;

		$params=array(  
            'type'=>$type,  
            'limit'=>0,  
            'fields' => array(
            	array('id' => $fieldId, 'value' => "Наша база")
            ),   
            'order'=> "desc",
            'count_total' => 1  
        );  
      
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

		return $result->data->count;
	}

	//получение данных об агенте по id
	public function getAgentInfo($id) {
		$method = "/worker/filter";
		$url = $this->domain.$method;

		$params=array(      
                "id" => array($id)    
        );  
      
		$post = array(  
		    'apikey' =>CRM_API_KEY,  
		    'params'=>$params  
		);  
		      
		      	          
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_POST, 1);  
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		$result = json_decode(curl_exec($ch));  
		curl_close ($ch);

		return $result->data; 
	}

 }