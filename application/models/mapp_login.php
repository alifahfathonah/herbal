<?php
class mapp_login extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }

    function login_api($username, $password)
    {
        $result = $this->db->query("SELECT * FROM login WHERE username='$username' and password='$password'");
        return $result->result();
    }
}
?>