<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan_Angsuran extends CI_Model {
    // deklarasi variable
    private $_table = "laporan_angsuran";
    private $_tableDet = "detail_transaksi";
    private $_tK = "angsuran";
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
    
    //detail belanja
    public function ambil_dataDetail($nofaktur){
        $hsl=$this->db->query("SELECT * FROM detail_transaksi WHERE nofaktur='$nofaktur'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id_barang' => $data->id_barang,
                    'jumlah' => $data->jumlah,
                    );
            }
        }
        return $hasil;
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
    function kredit(){
        date_default_timezone_set('Asia/Jakarta');
        $nofaktur = $this->input->post('nofaktur');
        $id_user = $this->session->userdata("id_user");
        $tgl=date('Y-m-d');
        $tanggal = $tgl;
        $bayar = $this->input->post('bayar');
        $kredit = array(
             'nofaktur'=>$nofaktur,
             'id_user'=>$id_user,
             'tanggal'=>$tanggal,
             'bayar'=>$bayar,
        );
        $result = $this->db->insert($this->_tK, $kredit);
        
   }
}