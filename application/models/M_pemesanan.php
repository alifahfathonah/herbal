<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pemesanan extends CI_Model
{
    private $_table = "pelanggan";
    private $_tableB = "barang";

    public function kode()
    {
        $this->db->select('LEFT(pemesanan.nofaktur,2) as nofaktur', FALSE);
        $this->db->order_by('nofaktur', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pemesanan');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->nofaktur) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $id_user = $this->session->userdata("id_user");;
        $tgl = date('dmY');
        $D = date('d');
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "Q/" . $batas . "/" . $id_user . "/" . $D . "/XXX" . "/" . $tgl;  //format kode
        return $kodetampil;
    }

    function searchPelanggan()
    {
        $hasil = $this->db->query("SELECT * FROM pelanggan");
        return $hasil;
    }
    public function ambil_data()
    {
        return $this->db->get($this->_table)->result();
    }
    function searchBarang()
    {
        $hasil = $this->db->query("SELECT * FROM barang");
        return $hasil;
    }
    public function ambilBarang()
    {
        return $this->db->get($this->_tableB)->result();
    }
}
