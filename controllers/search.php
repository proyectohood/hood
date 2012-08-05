<?php

class Search extends CI_Controller {
	
	function index()
	{
	
		$query = $this->input->get('q');
		$filter = $this->input->get('filter');
		$q = $_GET['q'];
		//var_dump($q);
		$filter = "username";
		if($filter == "username"){
			$this->searchUser($q);
		}
		elseif($filter == "email"){
			$this->searchUser($q);
		}
		
	}
	
	function searchUser($q){
		
		$this->load->model('hood_model');
		$userid = "noo";
		$users = $this->hood_model->getInfoUser();
		
		//var_dump($users); die();
		for($i =0; $i < count($users); $i++){
			if($users[$i]['username'] == $q){
				$userid = $users[$i];
			}
		}
		//var_dump($userid); die();
		$hoodsPerUser = $this->hood_model->getHoodsByIdUser($userid['idUsers']);
		$data['main_content'] = 'results_model';
		$data['hoodsResults'] = $hoodsPerUser;
		$this->load->view('includes/template', $data);
	}
}