<?php defined("BASEPATH") or exit('No direct script acces allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function process()
    {
        $_post = $this->input->post(null, TRUE);
        if (isset($_post['login'])) {
            $this->load->model('user_m');
            $query = $this->user_m->login($_post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'userid' => $row->user_id,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script>
                    alert('selamat, login berhasil');
                window.location='" . site_url('Home') . "';
                </script>";
            } else {
                echo "<script>
                alert('Login gagal username atau pasword salah');
                window.location='" . site_url('auth') . "';
                </script>";
            }
        }
    }
}
