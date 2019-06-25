<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('welcome_message');
	}
	public function index(){
		$data['barang'] = $this->Model_Barang->all();
		$this->load->view('welcome_message',$data);
	}

	public function add_to_cart($id_barang){
		$barangs = $this->Model_Barang->find($id_barang);
		$data = array(
			'id_barang'		=> $barangs->id_barang,
			'namabarang'	=> $barangs->namabarang,
			'harga'			=> $barangs->harga,
			'satuan'		=> $barangs->satuan,
			'stok'			=> $barangs->stok,
			'kategori'		=> $barangs->kategori,
			'gambar'		=> $barangs->gambar,
			'deskripsi'		=> $barangs->deskripsi
			);
		$this->cart->insert($data);
		redirect(base_url());
	}

	public function cart(){
		$this->load->view('show_cart');
	}

	public function clear_cart(){
		$this->cart->destroy();
		redirect(base_url());
	}
}
