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
			echo json_encode($data);
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
		$data["records"] = $this->hood_model->getAllHoods($_POST['iStart'], $_POST['iEnd']);
		echo json_encode ($data["records"]);
	}
	public function getHoodsByUser(){
		$this->load->model("hood_model");
		$data["records"] = $this->hood_model->getHoodsByIdUser($this->session->userdata('id'),$_POST['iStart'], $_POST['iEnd']);
		echo json_encode ($data["records"]);
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
		
	
	//---------------------------------------------- End Gets Functions --------------------------------
}
