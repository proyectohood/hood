<?php

class Login extends CI_Controller {
	
	function index()
	{//load the login_form and validate the login username and password
		if($this->input->post('username') !== false){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Usuario', 'trim|required|alpha_dash_punto|min_length[4]');
			//modify the CodeIgniter validation library to create a new function
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|min_length[4]|max_length[32]|alpha_numeric');	
			if($this->form_validation->run() == FALSE){
				$data['error']='';
				$data['main_content'] = 'login_form';
				$this->load->view('includes/template', $data);
			}
			else{
				$this->load->model('membership_model');
				$query = $this->membership_model->validate();
				
				if($query){
					$activo = $this->membership_model->getActive();
					if($activo==2){
						if($this->input->post('is_ajax')){
							$errorAjax['error'] = array('error'=>'No ha activado su cuenta, revise su correo electronico');
							$this->load->view('login_error', $errorAjax);
						}
						else{
							$data['error']= '<p class="errorLogin">No ha activado su cuenta, revise su correo electronico</p>';
							$data['main_content'] = 'login_form';
							$this->load->view('includes/template', $data);
						}
					}
					elseif($activo==0){
						if($this->input->post('is_ajax')){
							$errorAjax['error'] = array('error'=>'Su cuenta esta desactivada', 'inactive'=>true);
							$this->load->view('login_error', $errorAjax);
						}
						else{
							$data['error']= '<p class="errorLogin">Su cuenta esta desactivada</p>';
							$data['main_content'] = 'login_form';
							$this->load->view('includes/template', $data);
						}
					}
					elseif($activo==1){
						if($this->input->post('is_ajax')){
							$id = $this->membership_model->getId();
							$data = array(
								'username' => $this->input->post('username'),
								'id' => $id,
								'is_logged_in' => true
							);
							$this->session->set_userdata($data);
							$errorAjax['error'] = array('error'=>true);
							$this->load->view('login_error', $errorAjax);
						}
						else{
							$id = $this->membership_model->getId();
							$data = array(
								'username' => $this->input->post('username'),
								'id' => $id,
								'is_logged_in' => true
							);
							$this->session->set_userdata($data);
							redirect('index.php/poste');
						}
					}
					
				}
				else{
					if($this->input->post('is_ajax')){
						$errorAjax['error'] = array('error'=>'Usuario y/o Contrase&ntilde;a Invalidos');
						$this->load->view('login_error', $errorAjax);
					}
					else{
						$data['error']= '<p class="errorLogin">Usuario y/o Contrase&ntilde;a Invalidos</p>';
						$data['main_content'] = 'login_form';
						$this->load->view('includes/template', $data);
					}
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
		$this->load->model('membership_model');
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|alpha');
		$this->form_validation->set_rules('last_name', 'Apellidos', 'trim|required|alpha');
		$this->form_validation->set_rules('email_address', 'Correo Electronico', 'trim|required|valid_email|is_unique[tuser.email]');
		$this->form_validation->set_rules('username', 'Usuario', 'trim|required|alpha_dash_punto|min_length[4]|is_unique[tuser.username]');
		$this->form_validation->set_rules('job_position', 'Puesto', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|min_length[4]|max_length[32]|alpha_numeric');
		$this->form_validation->set_rules('password2', 'Confirmaci&oacute;n de Contrase&ntilde;a', 'trim|required|matches[password]');
		
				
		if($this->form_validation->run() == false)
		{
			//echo validation_errors();
			//$errorAjax['error'] = array('errorMail'=>$this->form_validation->run());
			//$this->load->view('register_error', $errorAjax);
			if($this->input->post('is_ajax')){
				if($this->membership_model->validateRegisterUsername() && $this->membership_model->validateRegisterEmail()){
					$errorAjax['error'] = array('errorUsername'=>'El usuario ya existe','errorMail'=>'El correo electronico ya existe');
					$this->load->view('register_error', $errorAjax);
				}
				elseif($this->membership_model->validateRegisterEmail()){
					$errorAjax['error'] = array('errorMail'=>'El correo electronico ya existe');
					$this->load->view('register_error', $errorAjax);
				}
				elseif($this->membership_model->validateRegisterUsername()){
					$errorAjax['error'] = array('errorMail'=>'El usuario ya existe');
					$this->load->view('register_error', $errorAjax);
				}
				
			}
		}
		else
		{
			if($this->membership_model->create_member())//call the model function to insert into db
				{
					$email = $this->membership_model->getEmail();
					$envioEmail=send_email($email);//new helper created to send the confirmation email
					if($this->input->post('is_ajax')){
						$errorAjax['error'] = array('accountCreated'=>true);
						$this->load->view('register_error', $errorAjax);
					}else{
						$data['main_content'] = 'login_form';
						$CI->load->view('includes/template', $data);
					}
						
					//var_dump($email); die();
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

	function activate_account()
	{
		$user= $this->uri->segment(4);
		//var_dump($user); die();
		$user= base64_decode(urldecode($user));
		$this->load->model('membership_model');
		if($this->membership_model->update_username($user)){
			redirect(base_url());
		}
	}

	function send_email_activate(){
		$this->load->model('membership_model');
		$id=$this->membership_model->getId();
		var_dump($id);
	}
	
	/*function validate_User()
	{
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		$activo = $this->membership_model->getActive();
				
		if($query){
			$id = $this->membership_model->getId();
			$data = array(
				'username' => $this->input->post('username'),
				'id' => $id,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('site/members_area');
		}
		else{
			return 'Usuario y/o Contrase&ntilde;a Invalidos';
			//$data['main_content'] = 'login_form';
			//$this->load->view('includes/template', $data);
		}

	
	}*/
}