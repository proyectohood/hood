<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hood extends CI_Controller {
	
	public function index(){
	}

	public function publishNewHood($hood){
		$today = getDate();
		$hood['date'] = $today['year'] . "-" . $today['mon'] . "-" . $today['mday'];
		$hood['time'] = $today['hours'] . ":" . $today['minutes'] . ":" . $today['seconds'];

		if(strlen($hood['text']) <= 500 && strlen($hood['text']) >= 1){
			$idHood = $this->hood_model->insertNewHood($hood);
			$data['idHood']=$idHood[0];
			echo $this->session->userdata('id');
		}
		else{
			$data['error']='Error el Hood debe contener entre 1 - 500 caracteres';
			$data['main_content'] = '';
			$this->load->view('includes/template', $data);
		}
	}
	//---------------------------------------------- Sets Functions --------------------------------
	public function setHood(){
		$this->load->model("hood_model");
		//$hood['text'] = $this->input->post('texthood');
		$hood['text'] = $_POST['textHood'];
		$hood['TUsers_IdUsers'] = $this->session->userdata('id');
		$this->publishNewHood($hood);
	}
	//---------------------------------------------- Gets Functions --------------------------------
	public function getAllHoods(){
		$this->load->model("hood_model");
		$data['currentUsername'] = $this->session->userdata('username');
		$allhoods = $this->hood_model->getAllHoods($_POST['iStart'], $_POST['iEnd']);
		
		$attach = $this->hood_model->getUrlAttachments();
		
		//echo var_dump ($allhoods); die();
		for($i = 0; $i < count($allhoods);$i++){
			for($j = 0; $j < count($attach); $j++){
				if($allhoods[$i]['idHoods'] == $attach[$j]['idHood']){
					$allhoods[$i]['filename'] = $attach[$j]['path'];
				}
				else{
					$allhoods[$i]['filename'] = null;
				}
			}
		}
		$data["records"] = $allhoods;
		echo json_encode ($data);
	}
	public function getHoodsByUser(){
		$this->load->model("hood_model");
		$data['currentUsername'] = $this->session->userdata('username');
		$data["records"] = $this->hood_model->getHoodsByIdUser($this->session->userdata('id'),$_POST['iStart'], $_POST['iEnd']);
		echo json_encode ($data);
	}
	public function getHoodsByUsername(){
		$username = $this->input->post('username');
		$this->load->model('users_model');
		$id = $this->users_model->getIdFromUsername($username);
		
		$this->load->model("hood_model");
		$data['currentUsername'] = $this->session->userdata('username');
		$data["records"] = $this->hood_model->getHoodsByIdUser($id,$_POST['iStart'], $_POST['iEnd']);
		echo json_encode ($data);
	}

	public function getLastHood(){
		$this->load->model("hood_model");
		//$hood['text'] = $this->input->post('texthood');
		$id = $this->session->userdata('id');
		$idHood = $this->hood_model->getLastHood($id);
		echo json_encode($idHood);
	}
	public function getCountHoods(){
		$this->load->model("hood_model");
		$data["cantidadHoods"] = $this->hood_model->getCountHoods();
		$data["cantidadHoods"] = $data["cantidadHoods"][0];

		echo json_encode($data["cantidadHoods"]);
	}
	public function getCountHoodByUser(){
		$this->load->model("hood_model");
		$data["cantidadHoods"] = $this->hood_model->getCountHoods($this->session->userdata('id'));
		$data["cantidadHoods"] = $data["cantidadHoods"][0];
		echo json_encode($data["cantidadHoods"]);
	}
	public function getCountAttachmentsByUser(){
		$this->load->model("hood_model");
		$data["cantidadAttachments"] = $this->hood_model->getCountAttachmentsById($this->session->userdata('id'));
		$data["cantidadAttachments"] = $data["cantidadAttachments"][0];
		echo json_encode($data["cantidadAttachments"]);
	}

	
	//---------------------------------------------- End Gets Functions --------------------------------
}
