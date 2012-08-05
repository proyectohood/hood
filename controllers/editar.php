<?php
class Editar extends CI_Controller
{
	function index(){
		$this->is_logged_in();
		
		$this->load->model("hood_model");
		$userid = $this->session->userdata('id');
		
		/*---------------------- Get Info Logged User ----------------------*/
		$userInfo = $this->hood_model->getInfoUser($userid);

		$data['name'] = $userInfo[0]['name'];
		$data['last_name'] = $userInfo[0]['last_name'];
		$data['job_position'] = $userInfo[0]['job_position'];
		$data['url_img'] = $userInfo[0]['url_img'];
		/*---------------------- END Get Info Logged User ----------------------*/

		/*---------------------- Get Info All Users ----------------------*/
		$hoodsQ = $this->hood_model->getCountHoods($userid);
		$userQ = $this->hood_model->getCountUsers();

		$data['infoAllUsers'] = $this->hood_model->getInfoUser();
		$data['numberHoods'] = $hoodsQ[0]['COUNT(*)'];
		$data['numberUsers'] = $userQ[0]["COUNT(*)"];
		/*---------------------- Get Info All Users ----------------------*/
		$data['error']='';
		$data['main_content'] = 'editar';
		$this->load->view('includes/template', $data);
	}

	function verifyCredentials(){
		if($this->input->post('username') !== false){
			$this->load->library('form_validation');//using the helper for validations
			$this->load->model('membership_model');
			$this->form_validation->set_rules('username', 'Usuario', 'trim|required|alpha_dash_punto|min_length[4]|is_unique[tuser.username]');
			$this->form_validation->set_rules('password', 'Contrase&ntilde;a', 'trim|required|min_length[4]|max_length[32]|alpha_numeric');
			$this->form_validation->set_rules('password2', 'Confirmaci&oacute;n de Contrase&ntilde;a', 'trim|required|matches[password]');
			if($this->form_validation->run()){
				$this->update_member();
				echo json_encode(array("errorUsername" => "Cambios Aplicados Exitosamente"));	
			}else{
				echo json_encode(array("errorUsername" => "Username ya existe en la base de datos"));
			}
		}
	}
	/*function upload_image(){
		
		$this->load->model('Image_model');
		if($this->input->post('upload')){
			$config['upload_path'] = realpath('img/userImages/');
			//chmod($config['upload_path'], 777);
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '500';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
			$userid=$this->session->userdata('id');

			$this->load->library('upload');
			$this->upload->initialize($config);
			//var_dump($this->upload->do_upload());
			if (!$this->image_model->do_upload())
			{
				//$this->load->view('gallery');
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			}
			else
			{
				//$data = array('upload_data' => $this->upload->data());
				//$this->Image_model->do_upload();
				echo "ok";
			}
		}else{
			echo "entro directo aqui"; die();
		}
	
	}*/
	function cargar_upload(){
		
		$this->load->model('Image_model');
		$userid = $this->session->userdata('id');
		if($this->input->post('upload')){
		   $config['upload_path'] = realpath(APPPATH. '../img/userImages');
		   $config['max_size'] = '1000';
			$config['max_width'] = '1024';
			$config['max_height']= '768';
		   	$config['allowed_types'] = 'gif|jpg|png';
		   	$this->load->library('upload');
   		   	$this->upload->initialize($config);
   	       	if (!$this->Image_model->do_upload($userid))
   			{
    			$error = array('error' => $this->upload->display_errors());
    		}else{
    			echo "ok";
   			}
   		}else{
			$this->load->view('edit_upload');	
		}
		
    }

	function update_member(){
		$this->load->model('membership_model');
		$userid = $this->session->userdata('id');
		$this->membership_model->update_member($userid);
	}
	public function is_logged_in(){
	  $is_logged_in = $this->session->userdata('is_logged_in');
	  if(!isset($is_logged_in) || $is_logged_in != true)
	  {
	   echo 'You don\'t have permission to access this page. <a href="../index.php/login">Login</a>'; 
	   die();  
	  } 
	}	
}