<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Controller {
    // deklarasi variable
    private $_table = "login";
    public $id_user;
    public $username;
    public $password;
    public $level;

    //menampilkan data
    public function rule(){
        return[
            [`field` => `username`,
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

        $this->id_user = $post["id_user"];
        $this->username = $post["username"];
		$this->password = $post["password"];
		$this->level = $post["level"];
		
		$this->db->insert($this->_table,$this);
    }
    //Update data
	public function update(){
		$post = $this->input->post();
		$this->id_user = $post["id"];
		$this->username = $post["username"];
		$this->password = $post["password"];
		$this->level = $post["level"];

		$this->db->update($this->_table, $this, array('id_user'=>$post['id']));
	}
	//Delete
	public function delete($id){
		return $this->db->delete($this->_table, array("id_user"=> $id));
	}
}