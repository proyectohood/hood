<?php

class Membership_model extends CI_Model {

	function validate()
	{
		$username=$this->input->post('username');
		$this->db->where('username', $username);
		$this->db->where('password', md5($this->input->post('password')));
		//$this->db->where('active', 1);
		$query = $this->db->get('tuser');
		if($query->num_rows == 1)
		{
			return true;
		}
	}

	function getActive()
	{
		$username=$this->input->post('username');
		$sql="Select active from tuser where username=?";
		$q=$this->db->query($sql, $username);	
		$active=$q->result();
		$active=get_object_vars($active[0]);
		return $active['active'];
	}

	function getId()
	{
		$username=$this->input->post('username');
		$sql="Select idUsers from tuser where username=?";
		$q=$this->db->query($sql, $username);
		$idUser= $q->result();
		$idUser=get_object_vars($idUser[0]);
		return $idUser['idUsers'];
	}

	function update_username($activate)
	{
		//$sql="Update tuser set active= 1 where username=?";
		//var_dump($activate); die();
		$q=$this->db->query("Update tuser set active= 1 where username='$activate'");
		return true;
	}

	function getEmail()
	{
		$username=$this->input->post('username');
		$email=$this->input->post('email_address');
		$arreglo=array($username,$email);
		return $arreglo;
	}

	function create_member()
	{
		$user_type=2;
		$active=2;
		$url_img = "default.png";
		$new_member_insert_data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email_address'),
			'job_position' => $this->input->post('job_position'),
			'user_type' => $user_type,
			'active' =>  $active,
			'url_img' => $url_img
		);
		
		$insert = $this->db->insert('tuser', $new_member_insert_data);
		return $insert;
	}

	function update_member($userid){
		$data = array(
               'username' => $this->input->post('username'),
               'password' => md5($this->input->post('password')),
               'url_img'  => $this->input->post('userfile')
            );
		//var_dump($data['url_img']); die();
		$this->db->where('idUsers', $userid);
		$this->db->update('tuser', $data);
	}

	function validateRegisterEmail()
	{
		$email=$this->input->post('email_address');
		$this->db->where('email', $email);
		
		$query = $this->db->get('tuser');
		if($query->num_rows == 1)
		{
			return true;
		}
	}

	function validateRegisterUsername()
	{
		$username=$this->input->post('username');
		$this->db->where('username', $username);
		
		$query = $this->db->get('tuser');
		if($query->num_rows == 1)
		{
			return true;
		}
	}

}