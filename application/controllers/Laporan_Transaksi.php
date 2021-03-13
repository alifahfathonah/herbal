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

	public function hariQ(){
		$this->load->view("laporan_transaksi/cetak/cetak_penjualan_hariini.php");
	}

	public function getAll(){
		$data=$this->M_Laporan_Transaksi->ambil_data();
		echo json_encode($data);
	}
	public function getharian(){
		$data=$this->M_Laporan_Transaksi->ambil_dataharian();
		echo json_encode($data);
	}
	public function getmingguan(){
		$data=$this->M_Laporan_Transaksi->ambil_datamingguan();
		echo json_encode($data);
	}
	public function getbulanan(){
		$data=$this->M_Laporan_Transaksi->ambil_databulanan();
		echo json_encode($data);
	}
	
	public function gettahunan(){
		$data=$this->M_Laporan_Transaksi->ambil_datatahunan();
		echo json_encode($data);
	}
	public function cetakHarian(){
		$data["laporan_transaksi"] = $this->M_Laporan_Transaksi->ambil_dataharian();

		ob_start();    
	    $this->load->view('laporan_transaksi/cetak/cetak_penjualan_hariini', $data);    
	    $html = ob_get_contents();        

	    ob_end_clean();                
	    require_once('./assets/html2pdf/html2pdf.class.php');    
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);    
	    $pdf->Output('Laporan Harian.pdf', 'D'); 
	}
	public function cetakMingguan(){
		$data["laporan_transaksi"] = $this->M_Laporan_Transaksi->ambil_datamingguan();

		ob_start();    
	    $this->load->view('laporan_transaksi/cetak/cetak_penjualan_mingguini', $data);    
	    $html = ob_get_contents();        

	    ob_end_clean();                
	    require_once('./assets/html2pdf/html2pdf.class.php');    
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);    
	    $pdf->Output('Laporan Mingguan.pdf', 'D'); 
	}
	public function cetakBulanan(){
		$data["laporan_transaksi"] = $this->M_Laporan_Transaksi->ambil_databulanan();

		ob_start();    
	    $this->load->view('laporan_transaksi/cetak/cetak_penjualan_bulanini', $data);    
	    $html = ob_get_contents();        

	    ob_end_clean();                
	    require_once('./assets/html2pdf/html2pdf.class.php');    
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);    
	    $pdf->Output('Laporan Bulanan.pdf', 'D'); 
	}
	public function cetakTahunan(){
		$data["laporan_transaksi"] = $this->M_Laporan_Transaksi->ambil_datatahunan();

		ob_start();    
	    $this->load->view('laporan_transaksi/cetak/cetak_penjualan_tahunini', $data);    
	    $html = ob_get_contents();        

	    ob_end_clean();                
	    require_once('./assets/html2pdf/html2pdf.class.php');    
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);    
	    $pdf->Output('Laporan Tahunan.pdf', 'D'); 
	}
	
	public function cetakAll(){
		$data["laporan_transaksi"] = $this->M_Laporan_Transaksi->ambil_data();

		ob_start();    
	    $this->load->view('laporan_transaksi/cetak/cetak_penjualan_semua', $data);    
	    $html = ob_get_contents();        

	    ob_end_clean();                
	    require_once('./assets/html2pdf/html2pdf.class.php');    
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);    
	    $pdf->Output('Laporan Semua.pdf', 'D'); 
	}
}
