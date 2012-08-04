<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leposte extends CI_Controller {
	

	public function index()
	{
		$allhoods = $this->getAllHoods();
		$allusers = $this->getAllUsers();
		$usersQuantity = $this->getCountUsers();
		$hoodsQuantity = $this->getCountHoods();
		
		$currentUserId = $this->session->userdata('id');
		
		$currentUserData = $this->getCurrentUserData($currentUserId);
		
		//var_dump($currentUserData); die();
		$data['main_content'] = 'leposte_view';
		$data['hoods'] = $allhoods;
		$data['users'] = $allusers;
		$data['totalUsers'] = $usersQuantity;
		$data['totalHoods'] = $hoodsQuantity;
		$data['userData'] = $currentUserData;
		$this->load->view('includes/template', $data);
	}
	
	function getAllHoods(){
		$this->load->model("hoods_model");
		$allhoods = $this->hoods_model->getAllHoods();
		return $allhoods;
	}
	
	function getAllUsers(){
		$this->load->model("users_model");
		$allusers = $this->users_model->getAllUsers();
		return $allusers;
	}
	
	function getCurrentUserData($userId){
		$this->load->model("users_model");
		$thisuser = $this->users_model->getCurrentUserData($userId);
		return $thisuser;
	}

	function getCountHoods(){
		$this->load->model("hoods_model");
		$hoodsQuantity = $this->hoods_model->getCountHoods();
		return $hoodsQuantity;
	}

	function getCountUsers(){
		$this->load->model("users_model");
		$usersQuantity = $this->users_model->getCountUsers();
		return $usersQuantity;
	}

	function publishNewHood(){
		$newhood['text']=$this->input->post('texthood');
		$newhood['TUsers_idUsers'] = $this->session->userdata('id');
		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('texthood', 'Usuario', 'trim|required|alphanumeric|min_length[1]|max_length[500]');
		$today = getDate();
		$newhood['date'] = $today['year'] . "-" . $today['mon'] . "-" . $today['mday'];
		$newhood['time'] = $today['hours'] . ":" . $today['minutes'] . ":" . $today['seconds'];
		
		//Cambiar esta validacion por la que va a hacer Ricardo
		if(strlen($newhood['text']) <= 500 && strlen($newhood['text']) >= 1){
			$this->load->model("hoods_model");
			$this->hoods_model->insertNewHood($newhood);
			redirect('/leposte');
		}
		else{
			$data['error']='Error el Hood debe contener entre 1 - 500 caracteres';
			$data['main_content'] = '';
			$this->load->view('includes/template', $data);
		}
		//Hasta aqui la validacion que hay q cambiar
	}
	
}