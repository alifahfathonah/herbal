<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pelanggan extends CI_Model {
    // deklarasi variable
    private $_table = "pelanggan";
    public $id_pelanggan;
    public $nama;
    public $nohp;
    public $alamat;
    public $email;
    public $password;

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
        $encrypt =$post["password"];
        $this->id_pelanggan = $post["id_pelanggan"];
        $this->nama = $post["nama"];
		$this->nohp = $post["nohp"];
		$this->alamat = $post["alamat"];
        $this->email = $post["email"];
		$this->password = password_hash($encrypt, PASSWORD_BCRYPT);

		$this->db->insert($this->_table,$this);
    }
    //Update data
	public function update(){
        $post = $this->input->post();
        $encrypt =$post["password"];
		$this->id_pelanggan = $post["id_pelanggan"];
        $this->nama = $post["nama"];
        $this->nohp = $post["nohp"];
        $this->alamat = $post["alamat"];
        $this->email = $post["email"];
        $this->password = password_hash($encrypt, PASSWORD_BCRYPT);

		$this->db->update($this->_table, $this, array('id_pelanggan'=>$post['id_pelanggan']));
	}
//Delete
    public function delete(){
        // return $this->db->delete($this->_table, array("id_user"=> $id_user));
        $id_pelanggan= $this->input->post('id_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $result = $this->db->delete('pelanggan');
        return $result;
    }
}