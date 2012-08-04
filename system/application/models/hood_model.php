<?php
class hood_model extends CI_Model
{
	function getAllHoods($iStart, $iEnd){
		$query = $this->db->query("SELECT * from thood where idHoods <= $iEnd AND idHoods > $iStart");
		return $this->iterateHoods($query);		
	}
	function getHoodsByIdUser($idUser, $iStart, $iEnd){
		$query = $this->db->query("SELECT * from thood where TUsers_idUsers = $idUser");
		return $this->iterateHoods($query);
	}
	
	function getCountHoods($idUser=0){
		if($idUser==0){
			$query = $this->db->query("SELECT COUNT(*) FROM thood");
		}
		else{
			$query = $this->db->query("SELECT COUNT(*) FROM thood where TUsers_idUsers = $idUser");
		}
		
		return $query->result_array();
	}

	function getInfoUser($idUser=0){
		if($idUser == 0){
			$query = $this->db->query("SELECT name, last_name, job_position, url_img from tuser");
		}
		else{
			$query = $this->db->query("SELECT name, last_name, job_position, url_img, username from tuser where idUsers = $idUser");
		}
		return $query->result_array();
	}


	function getCountUsers(){
		$query = $this->db->query("SELECT COUNT(*) FROM tuser");
		return $query->result_array();
	}


	function iterateHoods($query){
		if($query->num_rows() > 0){
			foreach (array_reverse($query->result_array()) as $i => $row)
			{
				$data[] = $row;
				$infoUser = $this->getInfoUser($data[$i]['TUsers_idUsers']);
				$data[$i]['user'] = $infoUser[0]['name'];
				$data[$i]['username'] = $infoUser[0]['username'];
				$data[$i]['last_name'] = $infoUser[0]['last_name'];
				$data[$i]['url_img'] = $infoUser[0]['url_img'];
			}
			return $data;
		}
	}

	function insertNewHood($hood){
		$this->db->insert('thood',$hood);
		$id = $this->db->query("SELECT MAX(idHoods) idhood from thood");
		return $id->result_array();
	}
}


?>