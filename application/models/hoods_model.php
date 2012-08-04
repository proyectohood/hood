<?php
class hoods_model extends CI_Model
{
	function getAllHoods()
	{
		$query = $this->db->query("SELECT * FROM thood ORDER BY date DESC");
		return $this->iterateHoods($query);
	}
	
	function iterateHoods($query){
		if($query->num_rows() > 0){
			foreach (array_reverse($query->result_array()) as $i => $row)
			{
				$data[] = $row;
				$name = $this->getNameByID($data[$i]['TUsers_idUsers']);
				$data[$i]['user'] = $name[0]['name'];
				$username = $this->getUserNameByID($data[$i]['TUsers_idUsers']);
				$data[$i]['username'] = $username[0]['username'];
				//print_r($data);
				//print_r($data[$i]['TUsers_idUsers']);
			}
			return $data;
		}
	}
	
	function getNameByID($idUser){
		$query = $this->db->query("SELECT name from tuser where idUsers = $idUser");
		return $query->result_array();
	}
	function getUserNameByID($idUser){
		$query = $this->db->query("SELECT username from tuser where idUsers = $idUser");
		return $query->result_array();
	}

	function insertNewHood($hood){
		$this->db->insert('thood',$hood);
	}
	
	function getCountHoods(){
		$query = $this->db->query("SELECT COUNT(*) AS hoodsQuantity FROM thood");
		$query = $query->result_array();
		return $query[0]['hoodsQuantity'];
	}
	
}