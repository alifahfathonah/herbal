<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->library('cart');
		$this->load->model("M_Transaksi");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index(){
		$data["pelanggan"] = $this->M_Transaksi->ambil_data();
		$data["barang"] = $this->M_Transaksi->ambilBarang();
    	$this->load->view("transaksi", $data);
	}
	public function nota(){
		$data["print"] = $this->M_Transaksi->nota();
		$this->load->view("nota", $data);
		// ob_start();    
	    
	 //    $html = ob_get_contents();        

	 //    ob_end_clean();                
	 //    require_once('./assets/html2pdf/html2pdf.class.php');    
	 //    $pdf = new HTML2PDF('P','A4','en');
	 //    $pdf->WriteHTML($html);    
	 //    $pdf->Output('Laporan Harian.pdf', 'D');
	}
	public function setCode(){
		$data = $this->M_Transaksi->kode();
		echo json_encode($data);
	}

	function getPelanggan(){
		if (isset($_GET['term'])) {
			$result = $this->M_Transaksi->searchPelanggan($_GET['term']);
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
	function getBarang(){
		if (isset($_GET['term'])) {
			$result = $this->M_Transaksi->searchBarang($_GET['term']);
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
	function Cart(){	
		$data=$this->M_Transaksi->keranjang();
		echo json_encode($data);
	}
	function show_keranjang(){
		$data=$this->M_Transaksi->show();
		echo json_encode($data);
	}
	function load_cart(){
		$data=$this->M_Transaksi->load();
		echo json_encode($data);
	}
	function hapus_keranjang(){
		$data=$this->M_Transaksi->hapus();
		echo json_encode($data);
	}
	function total(){
		$data=$this->cart->total();
		echo json_encode($data);
	}
	function hapusSemua(){
		$data=$this->cart->destroy();
		echo json_encode($data);
	}
	public function add(){
		$data=$this->M_Transaksi->insTr();
		$data=$this->M_Transaksi->detail();
		echo json_encode($data);
	}
	public function addCre(){
		$data=$this->M_Transaksi->insTr();
		$data=$this->M_Transaksi->detail();
		echo json_encode($data);
	}
	
}
