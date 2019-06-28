<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Angsuran extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Laporan_Angsuran");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index(){

		$this->load->view("laporan_angsuran");
	}
	public function getAll(){
		$data=$this->M_Laporan_Angsuran->ambil_data();
		echo json_encode($data);
	}
	public function getDetail(){
		$nofaktur=$this->input->post('nofaktur');
        $data=$this->M_Laporan_Angsuran->ambil_dataDetail($nofaktur);
        echo json_encode($data);
	}

	public function add(){
		$data=$this->M_Laporan_Angsuran->save();
		echo json_encode($data);
	}
	public function edit(){
		$data=$this->M_Laporan_Angsuran->update();
		echo json_encode($data);
	}
	public function hapus(){
		$data = $this->M_Laporan_Angsuran->delete();
		echo json_encode($data);
	}
	public function angsur(){
		$data = $this->M_Laporan_Angsuran->kredit();
		echo json_encode($data);
	}
}
