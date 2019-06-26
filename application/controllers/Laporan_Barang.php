<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Barang extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Laporan_Barang");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index(){
		$data['data']=$this->db->get('barang')->result();
		$this->load->view("laporan_barang/laporan.php");
	}

	public function getAll(){	
		$data=$this->M_Laporan_Barang->ambil_data();
		echo json_encode($data);
	}

	public function getWhere($kategori){	
		// $data=$this->M_Laporan_Barang->ambil_data();
		$data = $this->db->query("SELECT * FROM barang WHERE kategori = '$kategori'")->result();
		echo json_encode($data);
	}

	function kategori(){
		$kategori = $_POST['kategori'];
			$data['data'] = $this->model->get_kategori($kategori);		
			$this->load->view('admin/produk/list2',$data);
	}

	public function cetak(){
		$data['laporan_barang'] = $this->M_Laporan_Barang->view_row();
		$this->load->view('print',$data);
		$html = ob_get_contents();
		 	ob_end_clean();

		 	require_once('./assets/html2pdf/html2pdf.class.php');
		 $pdf = new HTML2PDF('P','A4','en');    
		 $pdf->WriteHTML($html);   
		 $pdf->Output('Laporan Barang.pdf', 'D');
	}
}
