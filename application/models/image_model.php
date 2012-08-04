<?php
class Image_model extends CI_Model{
		
	function __construct()
	{
		parent::__construct();
		$image_path=$this->image_path= realpath(APPPATH. '../img/userImages/');

	}
	
	function do_upload()
	{
		//$name=$_FILES['userfile'];
		$config= array(
			'upload_path' => $this->image_path,
			'allowed_types'=> 'gif|jpg|png',
			'max_size' => '100',
			'max_width' => '1024',
			'max_height'=> '768'
			
		);
		//var_dump($config);
		$this->load->library('upload', $config);
		$name=$_FILES['userfile']['name'];
		$path = mysql_real_escape_string($config['upload_path']);
		$path = $path.'/'.$name;
		$id=17;
		if($this->upload->do_upload()){
			$this->db->query("UPDATE tuser SET url_img = '$name' WHERE idUsers=$id");
			//echo "ok";
		}else{
			$error = array('error' => $this->upload->display_errors());
			var_dump($error['error']);
		}

		
		/*if($this->db->query("UPDATE tuser SET url_img = '$name' WHERE idUsers=$id")){
			//echo 'ok';
		}*/

		

		/*if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
			echo "error";
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo "ok";
			//$this->load->view('upload_success', $data);
		}*/
	}
}