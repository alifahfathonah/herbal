<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Transaksi");
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view("transaksi");
	}
	public function setCode(){
		$data = $this->M_Transaksi->kode();
		echo json_encode($data);
	}
	
}
