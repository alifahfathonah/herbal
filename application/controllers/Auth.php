<?php defined("BASEPATH") or exit('No direct script acces allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        $this->load->model('user_m');
        $query = $this->user_m->login($post);

        $error = 0;
        if (count($query) > 0) {
            if (password_verify($post['password'], $query[0]['password'])) {
                $error = 1;
            }
        }

        if ($error == 1) {
            $params = array(
                'id_user' => $query[0]['id_user'],
                'level' => $query[0]['level'],
                'status' => "login"
            );
            $this->session->set_userdata($params);
            echo "<script>
            alert('selamat, login berhasil');
            </script>";
            redirect(site_url() . "home");
        } else {
            echo "<script>
            alert('Login gagal username atau pasword salah');
            window.location='" . site_url('') . "';
            </script>";
        }
    }
    function logout(){
		$this->session->sess_destroy();
		echo "<script>
            alert('Anda Keluar');
            window.location='" . site_url('') . "';
            </script>";
	}
}
