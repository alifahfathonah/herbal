<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notapdf extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('notapdf');
    }

    private function _gen_pdf($html,$paper='A4') {
         ob_end_clean();
    $this->load->library('MPDF56/mpdf');
    $mpdf=new mPDF('utf-8', $paper );
    $mpdf->debug = true;
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    }

    public function doprint() {
    $data["transaksi"] = 'ini print dari HTML ke PDF';
    $this->load->view('notapdf',$data );
    
    }
}
