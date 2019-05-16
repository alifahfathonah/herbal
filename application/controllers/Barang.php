<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model("M_Barang");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view("barang");
    }
    public function getAll(){
        $data=$this->M_Barang->ambil_data();
        echo json_encode($data);
    }
    public function add(){
        // $user = $this->M_User;
        // $validasi = $this->form_validation;
        // $validasi->set_rules($user->rule());

        // if($validasi->run()){
        //  $data=$user->save();
        //  $this->session->set_flasdata('success','Berhasil Disimpan');
        //  echo json_encode($data);
        $data=$this->M_Barang->save();
        echo json_encode($data);
    }
    public function edit(){
        $data=$this->M_Barang->update();
        echo json_encode($data);
    }
    public function hapus(){
        $data = $this->M_Barang->delete();
        echo json_encode($data);
    }
}
