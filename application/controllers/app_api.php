<?php
?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class app_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Load API Data Pasien
    function index_get() {
        $nis = $this->get('nis');
        if ($nis == '') {
            $app_api = $this->db->get('user')->result();
        } else {
            $this->db->where('nis', $nis);
            $app_api = $this->db->get('user')->result();
        }
        $this->response($app_api, 200);
    }

    
    //Tambah Pasien
    // function index_post() {
    //     $data = array(
    //                 'nis' => $this->post('pas_index'),
    //                 'pas_nik' => $this->post('pas_nik'),
    //                 'pas_nama' => $this->post('pas_nama'),
    //                 'pas_kk' => $this->post('pas_kk'),
    //                 'pas_alamat' => $this->post('pas_alamat'),
    //                 'pas_telepon' => $this->post('pas_telepon'),
    //                 'pas_lahir' => $this->post('pas_lahir'),
    //                 'pas_agama' => $this->post('pas_agama'),
    //                 'pas_pendidikan' => $this->post('pas_pendidikan'),
    //                 'pas_kelamin' => $this->post('pas_kelamin'),
    //                 'pas_darah' => $this->post('pas_darah'),
    //                 'pas_pekerjaan' => $this->post('pas_pekerjaan'));
    //     $insert = $this->db->insert('pasien', $data);
    //     if ($insert) {
    //         $data["success"] = "1";
    //         $data["message"] = "success";
            
    //         echo json_encode($data);
    //     } else {
    //         $data["success"] = "0";
    //         $data["message"] = "error";

    //         echo json_encode($data);
    //     }
    // }

}
?>