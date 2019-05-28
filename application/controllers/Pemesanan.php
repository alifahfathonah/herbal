<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model("M_pemesanan");
        $this->load->library('form_validation');
        $this->load->helper('url');
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url(""));
        }
    }
    public function index()
    {
        $data["pelanggan"] = $this->M_pemesanan->ambil_data();
        $data["barang"] = $this->M_pemesanan->ambilBarang();
        $this->load->view("pemesanan", $data);
    }
    public function setCode()
    {
        $data = $this->M_pemesanan->kode();
        echo json_encode($data);
    }

    function getPelanggan()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_pemesanan->searchPelanggan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'nama' => $row->nama,
                        'alamat' => $row->alamat,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function getBarang()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_pemesanan->searchBarang($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'namabarang' => $row->namabarang,
                        'stok' => $row->stok,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function Cart()
    {
        $data = $this->M_pemesanan->keranjang();
        echo json_encode($data);
    }
    function show_keranjang()
    {
        $data = $this->M_pemesanan->show();
        echo json_encode($data);
    }
    function load_cart()
    {
        $data = $this->M_pemesanan->load();
        echo json_encode($data);
    }
    function hapus_keranjang()
    {
        $data = $this->M_pemesanan->hapus();
        echo json_encode($data);
    }
    function total()
    {
        $data = $this->cart->total();
        echo json_encode($data);
    }
    function hapusSemua()
    {
        $data = $this->cart->destroy();
        echo json_encode($data);
    }
    public function add()
    {
        $data = $this->M_pemesanan->insTr();
        $data = $this->M_pemesanan->detail();
        echo json_encode($data);
    }
    public function addCre()
    {
        $data = $this->M_pemesanan->insTr();
        $data = $this->M_pemesanan->detail();
        $data = $this->M_pemesanan->kredit();
        echo json_encode($data);
    }
}
