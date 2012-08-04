<?php
class Gallery_model extends CI_Model{
	//var $gallery_path;
	
	function __construct()
	{
		parent::__construct();
		$gallery_path=$this->gallery_path= realpath(APPPATH. '../files');
		//var_dump($gallery_path); die();	
	}
	
	function do_upload($id){
		$config= array(
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => $this->gallery_path
			);
		$this->load->library('upload', $config);

		$hoodid = $this->input->post('hoodid');
		//$hoodid = preg_replace("/\\//", "\\/", $hoodid);
		$path = mysql_real_escape_string($this->gallery_path);
		$this->db->query("INSERT INTO tfile (path, THoods_idHoods) VALUES('$path', $id)");

		$this->upload->do_upload();

	}
}