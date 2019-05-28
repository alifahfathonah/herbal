<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Barang extends CI_Model {
	public function all(){
		$hasil = $this->db->get('barang');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else {
			return array();
		}
	}

	public function find($id_barang){
		//Query mencari record berdasarkan ID-nya
		$hasil = $this->db->where('id_barang', $id_barang)
						->get('barang');
		if($hasil = $this->num_rows() > 0){
			return $hasil->row();
		} else {
			return array();
		}
	}
}