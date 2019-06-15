<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barangmasuk extends CI_Model {
     private $_tableB = "barang";
     private $_tT = "barangmasuk";
     private $_dbm = "detail_barangmasuk";

     public function kode(){
          $this->db->select('LEFT(barangmasuk.id_barangmasuk,4) as id_barangmasuk', FALSE);
          $this->db->order_by('id_barangmasuk','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('barangmasuk');  //cek dulu apakah ada sudah ada kode di tabel.    
               if($query->num_rows() <> 0){      
               //cek kode jika telah tersedia    
               $data = $query->row();      
               $kode = intval($data->id_barangmasuk) + 1; 
          }
          else{      
               $kode = 1;  //cek jika kode belum terdapat pada table
          }
          $tgl=date('dmY'); 
          $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
          $kodetampil = "Q".$batas;  //format kode
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

          $id_barangmasuk = $this->input->post('id_barangmasuk');
         
          $id_user = $this->session->userdata("id_user");
          $tgl=date('Y-m-d');
          $tanggal = $tgl; 
        
          $barangmasuk = array(
               'id_barangmasuk'=>$id_barangmasuk,
               'id_user'=>$id_user,
               'tanggal'=>$tanggal,
                );
          $result = $this->db->insert($this->_tT, $barangmasuk);
          return $result;
          
     }
       function detail(){
          if ($cart = $this->cart->contents()){
               $id_barangmasuk = $this->input->post('id_barangmasuk');
               foreach ($cart as $item){
                    $data_detail = array('id_barangmasuk' =>$id_barangmasuk,
                                   'id_barang' => $item['id'],
                                   'jumlah' => $item['qty'],
                                   );
                    $this->db->insert($this->_dbm, $data_detail);
               }
          }
     }

}