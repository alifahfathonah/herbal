<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {
    public function kode(){
        $this->db->select('LEFT(transaksi.nofaktur,2) as nofaktur', FALSE);
        $this->db->order_by('nofaktur','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('transaksi');  //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){      
             //cek kode jika telah tersedia    
             $data = $query->row();      
             $kode = intval($data->nofaktur) + 1; 
        }
        else{      
             $kode = 1;  //cek jika kode belum terdapat pada table
        }
            $tgl=date('dmY');
            $D=date('d'); 
            $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
            $kodetampil = "Q/".$batas."/XX"."/".$D."/XXX"."/".$tgl;  //format kode
            return $kodetampil;  
       }
}