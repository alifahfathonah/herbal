<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Angsuran extends CI_Model {
    // deklarasi variable
    private $_table = "laporan_angsuran";
    public $nofaktur;
    public $nama;
    public $namabarang;
    public $total;
    public $bayar;
    
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


    //create
    public function save(){
        $post = $this->input->post();
        $this->nofaktur = $post["nofaktur"];
        $this->nama = $post["nama"];
        $this->namabarang = $post["namabarang"];
        $this->total = $post["total"];
        $this->bayar = $post["bayar"];

        $this->db->insert($this->_table,$this);
    }
    //Update data
    public function update(){
        $post = $this->input->post();
       $this->nofaktur = $post["nofaktur"];
        $this->nama = $post["nama"];
        $this->namabarang = $post["namabarang"];
        $this->total = $post["total"];
        $this->bayar = $post["bayar"];

        $this->db->update($this->_table, $this, array('nofaktur'=>$post['nofaktur']));
    }
}