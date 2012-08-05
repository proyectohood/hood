<?php

class API extends CI_Controller{
	
	function index(){
		var_dump('hello');
	}
	
	function getJSONbyUser(){
	//http://localhost:8888/CENFOTEC/PW1-Hood/index.php/API/getJSONbyUser/username/jherrera/limit/1
		$array = $this->uri->uri_to_assoc();
		
		$this->load->model('API_model');
		$hoods = $this->API_model->getHoodsbyUser($array);
		$user = $this->API_model->getUserData($array);
		
		//$data['hoods'] = json_encode($hoods->result());
		$data['user'] = json_encode($user->result());
		$data['hoods'] = json_encode($hoods->result());
		
		$data = json_encode(array('user'=>$user->result(),'hoods'=>$hoods->result()));
		$this->output->set_content_type('application/json')->set_output($data);
		//echo $data;
	}
	
	function getJSONallHoods(){
		//http://localhost:8888/CENFOTEC/PW1-Hood/index.php/API/getJSONallHoods/limit/10
		$array = $this->uri->uri_to_assoc();
		
		//var_dump($array); die();
		$this->load->model('API_model');
		$hoods = $this->API_model->getHoods($array);
		$data = json_encode($hoods->result());
		$this->output->set_content_type('application/json')->set_output($data);
		
	}

	function getXMLbyUser(){
		$array = $this->uri->uri_to_assoc();
		
		$this->load->model('API_model');
		$hoods = $this->API_model->getHoodsbyUser($array);
		$user = $this->API_model->getUserData($array);
		
		//$data['hoods'] = json_encode($hoods->result());
		//$data['user'] = json_encode($user->result());
		//$data['hoods'] = json_encode($hoods->result());
		
		//$data = json_encode(array('user'=>$user->result(),'hoods'=>$hoods->result()));
		$this->output->set_content_type('application/json')->set_output($data);
	}
	function getXMLallHoods(){
		$array = $this->uri->uri_to_assoc();

		//var_dump($array); die();
		$this->load->model('API_model');
		$hoods = $this->API_model->getHoods($array);
		//$data = json_encode($hoods->result());

		$this->output->set_content_type('application/json')->set_output($data);
	}

}

?>
