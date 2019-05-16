<?php defined("BASEPATH") or exit('No direct script acces allowed');

class user_m extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('username', $post['username']);
        $query = $this->db->get();
        return $query->result_array();
    }
}
