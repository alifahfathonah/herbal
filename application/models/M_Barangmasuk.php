<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barangmasuk extends CI_Model {
     private $_tableB = "barang";
     private $_tT = "barangmasuk";
     public function kode(){
          $this->db->select('LEFT(transaksi.nofaktur,2) as nofaktur', FALSE);
          $this->db->order_by('nofaktur','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('barangmasuk');  //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
               //cek kode jika telah tersedia    
               $data = $query->row();      
               $kode = intval($data->nofaktur) + 1; 
          }else{
               $kode = 1;  //cek jika kode belum terdapat pada table
          }
          $id_user = $this->session->userdata("id_user");;
          $tgl=date('dmY');
          $D=date('d'); 
          $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
          $kodetampil = "Q/".$batas."/".$id_user."/".$D."/XXXX"."/".$tgl;  //format kode
          return $kodetampil;  
     }

 
     public function ambil_data()
     {
         return $this->db->get($this->_table)->result();
     }
     
     function searchBarang(){
          $hasil=$this->db->query("SELECT * FROM barang");
          return $hasil;
     }
     public function ambilBarang()
     {
         return $this->db->get($this->_tableB)->result();
     }

     public function insTr(){
          date_default_timezone_set('Asia/Jakarta');

          $id_barangasuk = $this->input->post('id_barangasuk');
          $id_barang = $this->session->userdata("id_barang");
          $id_user = $this->input->post('id_user');
          $tgl=date('Y-m-d');
          $tanggal = $tanggal; 
          $jumlah= $this->input->post('jumlah');
        
          $transaksi = array(
               'id_barangmasuk'=>$id_barangmasuk,
               'id_barang'=>$id_barang,
               'id_user'=>$id_user,
               'tanggal'=>$tanggal,
               'jumlah'=>$jumlah,
                );
          $result = $this->db->insert($this->_tT, $barangmasuk);
          return $result;
          
     }

}