<?php
class Image_model extends CI_Model{
		
	function __construct()
	{
		parent::__construct();
		$image_path=$this->image_path= realpath(APPPATH. '../img/userImages');
	}
	
	function do_upload($id)
	{
		$config= array(
			'upload_path' => $this->image_path,
			'allowed_types'=> 'gif|jpg|png'
		);
		$this->load->library('upload', $config);
		$name=$_FILES['userfile']['name'];
		$path = mysql_real_escape_string($config['upload_path']);
		$path = $path.'/'.$name;
		var_dump($id);
		if($this->upload->do_upload()){
			$this->db->query("UPDATE tuser SET url_img = '$name' WHERE idUsers=$id");
		}else{
			$error = array('error' => $this->upload->display_errors());
			var_dump($error['error']);
		}
	}
}