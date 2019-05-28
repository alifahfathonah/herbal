<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Transaksi extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->load->model("M_Laporan_Transaksi");
		$this->load->library('form_validation');
		$this->load->helper('url');
		if($this->session->userdata('status') != 'login'){
				redirect(base_url(""));
		}
	}
	public function index(){

		$this->load->view("laporan_transaksi/laporan.php");
	}
	public function getAll(){
		$data=$this->M_Laporan_Transaksi->ambil_data();
		echo json_encode($data);
	}

	public function cetak(){
		$data['laporan_angsuran'] = $this->M_Laporan_Transaksi->view_row();
		$this->load->view('print',$data);
		$html = ob_get_contents();
		 	ob_end_clean();

		 	require_once('./assets/html2pdf/html2pdf.class.php');
		 $pdf = new HTML2PDF('P','A4','en');    
		 $pdf->WriteHTML($html);   
		 $pdf->Output('Laporan Transaksi.pdf', 'D');
	}
}
