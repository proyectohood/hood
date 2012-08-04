<?php

class Busqueda extends CI_Controller {
	
	function index()
	{//load the login_form and validate the login username and password
		if($this->input->post('username') !== false){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Usuario', 'trim|required|alpha_dash_punto|min_length[4]');//modify the CodeIgniter validation library to create a new function
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|min_length[4]|max_length[32]|alpha_numeric');	
			if($this->form_validation->run() == FALSE)
			{
					$data['error']='';
					$data['main_content'] = 'login_form';
					$this->load->view('includes/template', $data);
			}else{
				$this->load->model('membership_model');
				$query = $this->membership_model->validate();
				
				if($query){
					$data = array(
						'username' => $this->input->post('username'),
						'is_logged_in' => true
					);
					$this->session->set_userdata($data);
					redirect('site/members_area');
				}
				else{
					
					$data['error']= '<p class="errorLogin">Usuario y/o Contrase&ntilde;a Invalidos</p>';
					$data['main_content'] = 'login_form';
					$this->load->view('includes/template', $data);
				}
			}	

		}else{
			$data['error']='';
			$data['main_content'] = 'login_form';
			$this->load->view('includes/template', $data);
		}
				
	}
	
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}
	//make a validation form and load the model
	function create_member()
	{
		$this->load->library('form_validation');//using the helper for validations
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|alpha');
		$this->form_validation->set_rules('last_name', 'Apellidos', 'trim|required|alpha');
		$this->form_validation->set_rules('email_address', 'Correo Electronico', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Usuario', 'trim|required|alpha_dash_punto|min_length[4]');
		$this->form_validation->set_rules('job_position', 'Puesto', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|min_length[4]|max_length[32]|alpha_numeric');
		$this->form_validation->set_rules('password2', 'Confirmaci&oacute;n de Contrase&ntilde;a', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'signup_form';
			$this->load->view('includes/template', $data);
		}
		
		else
		{			
			$this->load->model('membership_model');
			
			if($query = $this->membership_model->create_member())//call the model function to insert into db
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);
			}
			else
			{
				$this->load->view('signup_form');			
			}
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}

}