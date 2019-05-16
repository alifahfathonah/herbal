<?php defined("BASEPATH") or exit('No direct script acces allowed');

class user_m extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('login');
        $tahu = $post['password'];
        $this->db->where('username', $post['username']);
        $this->db->where('password', password_hash($tahu, PASSWORD_BCRYPT));
        $query = $this->db->get();
        return $query;
    }
}
