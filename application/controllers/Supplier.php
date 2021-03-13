<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Supplier");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	
	}
	public function index()
	{
		$this->load->view("supplier");
	}
	public function getAll(){
		$data=$this->M_Supplier->ambil_data();
		echo json_encode($data);
	}
	public function add(){
		$data=$this->M_Supplier->save();
		echo json_encode($data);
	}
	public function edit(){
		$data=$this->M_Supplier->update();
		echo json_encode($data);
	}
	public function hapus(){
		$data = $this->M_Supplier->delete();
		echo json_encode($data);
	}
}
