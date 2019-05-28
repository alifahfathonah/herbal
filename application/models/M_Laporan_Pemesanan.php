<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Pemesanan extends CI_Model {
    // deklarasi variable
    private $_table = "laporan_pemesanan";

    //menampilkan data
    public function rule(){
        return[
            [`field` => `nama`,
            `rules` => `required`],
            [`field` => `password`,
            `rules` => `required`],
        ];
    }

    //menampilkan data
    public function ambil_data(){
        return $this->db->get($this->_table)->result();
    }
}