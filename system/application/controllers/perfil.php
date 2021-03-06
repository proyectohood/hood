<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller {
	

	public function index()
	{
	
		$this->is_logged_in();
		$this->load->model("hood_model");
		
		$userInfo[] = $this->hood_model->getInfoUser( $this->session->userdata('id') );
		$data['name'] = $userInfo[0][0]['name'];
		$data['job_position'] = $userInfo[0][0]['job_position'];
		$data['url_img'] = $userInfo[0][0]['url_img'];
		
		$data['infoAllUsers'] = $this->hood_model->getInfoUser();
		$data['numberHoods'] = $this->hood_model->getCountHoods($this->session->userdata('id'));
		$data['numberHoods'] = $data['numberHoods'][0]["COUNT(*)"];
		$data['numberUsers'] = $this->hood_model->getCountUsers();
		$data['numberUsers'] =$data['numberUsers'][0]["COUNT(*)"];
		
		$data['main_content'] = 'perfil';
		$this->load->view('includes/template', $data);
	}

	public function is_logged_in(){
		  $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
		   echo 'You don\'t have permission to access this page. <a href="../index.php/login">Login</a>'; 
		   die();  
		   //$this->load->view('login_form');
		  }  
	}
}
