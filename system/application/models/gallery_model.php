<?php
class Gallery_model extends CI_Model{
	//var $gallery_path;
	
	function __construct()
	{
		parent::__construct();
		$gallery_path=$this->gallery_path= realpath(APPPATH. '../files');
		//var_dump($gallery_path); die();	
	}
	
	function do_upload($hoodId){
		$config= array(
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => $this->gallery_path
			);
		addIdtoDB($hoodId, $this->gallery_path);
		
		$this->load->library('upload', $config);
		var_dump($config); die();
		$this->upload->do_upload();

	}
	
	function addIdtoDB($hoodId, $path){
		$this->db->query('INSERT INTO tfile (path, THoods_idHoods) VALUES $path, $hoodId');
	}
}