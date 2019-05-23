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
                        'nohp' => $row->nohp,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function getBarang()
    {
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
    function Cart()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $name = $this->input->post('name');
        $grosir = array(
            'id'     => $id,
            'qty'    => $qty,
            'price'   => $price,
            'name'      => $name
        );

        $this->cart->insert($grosir);
        // redirect('admin/kasir/grosir');
        echo $this->show_keranjang();
    }
    function show_keranjang()
    {
        $output = '';
        foreach ($this->cart->contents() as $items) {
            # code...
            $output .= '
									<tr>
											<td>' . $items['id'] . '</td>
											<td>' . $items['name'] . '</td>
											<td>' . $items['qty'] . '</td>
											<td>' . number_format($items['price']) . '</td>
											<td>
												<div class="col-md-8">
												<div class="form-group">
													<input type="text" id="subtotal" name="subtotal" value="' . $items['subtotal'] . '" class="form-control" style="text-align:right;margin-bottom:5px;" readonly>
												</div>
											</div>
										</td>
											<td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
									</tr>
							';
        }
        return $output;
    }
    function load_cart()
    {
        echo $this->show_keranjang();
    }
    function hapus_keranjang()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty'    => 0,
        );
        $total = $this->cart->total();
        $this->cart->update($data);
        echo $this->show_keranjang();
        // redirect('admin/kasir/grosir');
    }
}
