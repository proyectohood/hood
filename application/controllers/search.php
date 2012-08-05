<?php

class Search extends CI_Controller {
	
	function index(){
		
	}
	
	function searchbyusername(){

		$this->is_logged_in();

		$q =$_GET['q'];
		
		$this->load->model('hood_model');
		$users = $this->hood_model->getInfoUser();
		
		for($i =0; $i < count($users); $i++){
			if($users[$i]['username'] == $q){
				redirect(base_url() . 'index.php/perfil/show/user/' . $users[$i]['username']);
			}else{
				$this->load->model('users_model');
				$hoodsPerUser = $this->users_model->getUsersByQuery($q);
			}
		}
		
		$data['main_content'] = 'results_view';
		$data['hoodsResults'] = $hoodsPerUser;
		$this->load->view('includes/template', $data);
	}

	function searchbyemail(){

		$this->is_logged_in();

		$q =$_GET['q'];
		
		$this->load->model('hood_model');
		$users = $this->hood_model->getInfoUser();
		
		for($i =0; $i < count($users); $i++){
			if($users[$i]['email'] == $q){
				redirect(base_url() . 'index.php/perfil/show/user/' . $users[$i]['username']);
			}else{
				$this->load->model('users_model');
				$hoodsPerUser = $this->users_model->getEmailsByQuery($q);
			}
		}
		
		$data['main_content'] = 'results_view';
		$data['hoodsResults'] = $hoodsPerUser;
		$this->load->view('includes/template', $data);
	}

	public function is_logged_in(){
	    $is_logged_in = $this->session->userdata('is_logged_in');

	    if(!isset($is_logged_in) || $is_logged_in != true){
	       echo 'You don\'t have permission to access this page. <a href="../index.php/login">Login</a>'; 
	       die();  
	  
	    } 
	
	}

}