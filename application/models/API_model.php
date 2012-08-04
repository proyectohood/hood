<?php

class API_model extends CI_Model {
	
	function getHoods($array){
		if(!array_key_exists('limit', $array)){
			$hoods = $this->db->query("
				SELECT tuser.username username, CONCAT(tuser.name,' ',tuser.last_name) name, tuser.job_position job_position, tuser.email mail, tuser.url_img url,
				thood.text hood, thood.date date
				FROM tuser
				JOIN thood ON tuser.idUsers=thood.TUsers_idUsers
				ORDER BY name DESC
			");
		}
		else{
			$limit = $array['limit'];
			
			$hoods = $this->db->query("
				SELECT tuser.username username, CONCAT(tuser.name,' ',tuser.last_name) name, tuser.job_position job_position, tuser.email mail, tuser.url_img url,
				thood.text hood, thood.date date
				FROM tuser
				JOIN thood ON tuser.idUsers=thood.TUsers_idUsers
				ORDER BY name DESC
				LIMIT $limit
			");
		}
		return $hoods;
	}
	
	function getHoodsbyUser($array)
	{
		if(!array_key_exists('username', $array) && !array_key_exists('limit', $array)){
			return array('error'=>"No user found");
		}
		if(!array_key_exists('limit', $array)){
			$username = $array['username'];
			$hoods = $this->db->query("
				SELECT text, date
				FROM thood
				JOIN tuser ON tuser.idUsers=thood.TUsers_idUsers
				WHERE tuser.username = '$username'
				ORDER BY date DESC
			");
		}
		else{
			$username = $array['username'];
			$limit = $array['limit'];
			$hoods = $this->db->query("
				SELECT text, date
				FROM thood
				JOIN tuser ON tuser.idUsers=thood.TUsers_idUsers
				WHERE tuser.username = '$username'
				ORDER BY date DESC
				LIMIT $limit
			");
		}
		return $hoods;
		
	}
	
	function getUserData($array)
	{
			$username = $array['username'];
			$userdata = $this->db->query("
				SELECT tuser.username username, CONCAT(tuser.name,' ',tuser.last_name) name, tuser.job_position job_position, tuser.email mail, tuser.url_img url
				FROM tuser
				WHERE username = '$username'
			");
		return $userdata;
		
	}

}