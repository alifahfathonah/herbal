<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Pemesanan extends CI_Model {
    // deklarasi variable
    private $_table = "cekcok";
    private $_table1 = "pemesanan";
    private $_table2 = "detail_pemesanan";

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

    //Update data
    public function update()
    {
        $post = $this->input->post();
        $this->kode_pemesanan = $post["kode_pemesanan"];
        $this->bayar = $post["bayar"];

        $this->db->update($this->_table1, $this, array('kode_pemesanan' => $post['kode_pemesanan2']));
    }
    public function update2()
    {
        $post = $this->input->post();
        $this->kode_pemesanan = $post["kode_pemesanan"];
     

     
        $this->db->update($this->_table2, $this, array('kode_pemesanan' => $post['kode_pemesanan2']));
    }
}