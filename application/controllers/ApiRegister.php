<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class ApiRegister extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Tambah Pasien
    function index_post() {
        $values = array(
                    'id_pelanggan' => $this->post('id_pelanggan'),
                    'nama' => $this->post('nama'),
                    'nohp' => $this->post('nohp'),
                    'alamat' => $this->post('alamat'),
                    'email' => $this->post('email'),
                    'password' => $this->post('password'));
        $insert = $this->db->insert('pelanggan', $values);
        
        if ($insert) {
            $data['success'] = "1";
            echo json_encode($data);
        } else {
            $data['success'] = "0";
            echo json_encode($data);
        }
    }
    function index_get()
    {
        $barang = $this->db->get('barang')->result();
    
    $this->response($barang, 200);
    }
}
?>