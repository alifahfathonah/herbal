<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Laporan_Barang extends CI_Model
{
    // deklarasi variable
    private $_table = "barang";
    private $_table1 = "laporan_";


    //menampilkan data
    public function rule()
    {
        return [
            [
                `field` => `nama`,
                `rules` => `required`
            ],
            [
                `field` => `password`,
                `rules` => `required`
            ],
        ];
    }

    //menampilkan data
    public function ambil_data()
    {
        return $this->db->get($this->_table)->result();
    }

    public function ambil_data_filter($kategori)
    {
        return $this->db->query("SELECT * FROM barang WHERE kategori = '$kategori'")->result();
    }
    public function ambil_datakategori()
    {
        return $this->db->get($this->_table1)->result();
    }

    // public function getDataByKategori()
    // {
    //     # code...
    // }
}
