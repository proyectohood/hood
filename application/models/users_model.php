<?php
class users_model extends CI_Model
{
	function getAllUsers()
	{
		$query = $this->db->query("SELECT * FROM tuser ORDER BY idUsers DESC");
		return $this->iterateUsers($query);
	}
	
	function getCurrentUserData($userId)
	{
		$query = $this->db->query("SELECT * FROM tuser WHERE idUsers = $userId");
		$query = $this->iterateUsers($query);
		$data['username'] = $query[0]['username'];
		$data['name'] = $query[0]['name'] . ' ' . $query[0]['last_name'];
		$data['email'] = $query[0]['email'];
		$data['job_position'] = $query[0]['job_position'];
		return $data; 
	}
	
	function iterateUsers($query){
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $i => $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getCountUsers(){
		$query = $this->db->query("SELECT COUNT(*) AS usersQuantity FROM tuser");
		$query = $query->result_array();
		return $query[0]['usersQuantity'];
	}
	
	function getIdFromUsername($username){
	
		$query = $this->db->query("Select idUsers from tuser where username='$username'");
		$query = $query->result_array();
		//var_dump($query[0]['idUsers']); die();
		$id = $query[0]['idUsers'];
		return $id;
	}

	function getUsersByQuery($query){
		$query = $this->db->query("Select * from tuser where username like '%".$query."%'");
		$query = $query->result_array();
		return $query;
	}

	function getEmailsByQuery($query){
		$query = $this->db->query("Select * from tuser where email like '%".$query."%'");
		$query = $query->result_array();
		return $query;
	}

}