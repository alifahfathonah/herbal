<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_User");
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view("user");
	}
	public function getAll(){
		$data=$this->M_User->ambil_data();
		echo json_encode($data);
	}
}
