<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Pelanggan");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index()
	{
		$this->load->view("pelanggan");
	}

	public function setCode(){
		$data = $this->M_Pelanggan->kode();
		echo json_encode($data);
	}

	public function getAll(){
		$data=$this->M_Pelanggan->ambil_data();
		echo json_encode($data);
	}
	
	public function add(){
		$data=$this->M_Pelanggan->save();
		echo json_encode($data);
	}
	public function edit(){
		$data=$this->M_Pelanggan->update();
		echo json_encode($data);
	}
	public function hapus(){
		$data = $this->M_Pelanggan->delete();
		echo json_encode($data);
	}
}
