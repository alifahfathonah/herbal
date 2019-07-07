<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Pemesanan extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Laporan_Pemesanan");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index()
	{
		$this->load->view("laporan_pemesanan");
	}
	public function getAll(){
		$data=$this->M_Laporan_Pemesanan->ambil_data();
		echo json_encode($data);
	}
	public function edit(){
		$data=$this->M_Laporan_Pemesanan->update2();
		$data=$this->M_Laporan_Pemesanan->update();
		echo json_encode($data);
	}
}
