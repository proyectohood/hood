<?php
class Gallery extends CI_Controller{
	function index(){
		$this->load->model('Gallery_model');
		
		if($this->input->post('upload')){
			
			$config['upload_path'] = realpath('files/');
			//chmod($config['upload_path'], 777);
			$config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc';
			$config['max_size']	= '5000';
			$this->load->library('upload');
			$this->upload->initialize($config);
			$hoodid = $this->input->post('hoodid');
			//var_dump($hoodid); die();
			//var_dump($this->Gallery_model->do_upload($hoodid));  
			if (!$this->Gallery_model->do_upload($hoodid))
			{
				echo "entro en el error de do_upload gallery_controller.php";
				$error = array('error' => $this->upload->display_errors());
				var_dump($error);
			}
			else
			{
				echo "ok";
			}
		}else{
			//var_dump($this->input->post('upload')); die();
			//echo "entro directo aqui"; die();
			$this->load->view('gallery');
		}
	}
}