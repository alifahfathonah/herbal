<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Transaksi extends CI_Model {
    // deklarasi variable
    private $_table = "laporan_transaksi";
    private $_table1 = "laporan_transaksiharian";
    private $_table2 = "laporan_transaksimingguan";
    private $_table3 = "laporan_transaksibulanan";
    private $_table4 = "laporan_transaksitahunan";

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

    public function ambil_dataharian(){
        return $this->db->get($this->_table1)->result();
    }
    
    public function ambil_datamingguan(){
        return $this->db->get($this->_table2)->result();
    }
    public function ambil_databulanan(){
        return $this->db->get($this->_table3)->result();
    }
    public function ambil_datatahunan(){
        return $this->db->get($this->_table4)->result();
    }
}