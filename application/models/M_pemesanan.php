<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pemesanan extends CI_Model
{
     private $_table = "pelanggan";
     private $_tableB = "barang";
     private $_tT = "pemesanan";
     private $_tDT = "detail_pemesanan";
     private $_tK = "angsuran";

     public function kode()
     {
          $this->db->select('RIGHT(pemesanan.kode_pemesanan, 4) as kode_pemesanan', FALSE);
          date_default_timezone_set("asia/jakarta");
          $this->db->where("tanggal =  date(now())");
          $this->db->order_by('kode_pemesanan', 'DESC');
          $this->db->limit(1);
          $query = $this->db->get('pemesanan');  //cek dulu apakah ada sudah ada kode di tabel.    
          if ($query->num_rows() <> 0) {
               //cek kode jika telah tersedia    
               $data = $query->row();
               $kode = intval($data->kode_pemesanan) + 1;
          } else {
               $kode = 1;  //cek jika kode belum terdapat pada table
          }
          $id_user = $this->session->userdata("id_user");
          $tgl = date('dmY');
          $D = date('d');
          $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
          $kodetampil = "PS".$batas; //format kode
          return $kodetampil;
     }

     function searchPelanggan()
     {
          $hasil = $this->db->query("SELECT * FROM pelanggan");
          return $hasil;
     }

     public function ambil_data()
     {
          return $this->db->get($this->_table)->result();
     }

     function searchBarang()
     {
          $hasil = $this->db->query("SELECT * FROM barang");
          return $hasil;
     }
     public function ambilBarang()
     {
          return $this->db->get($this->_tableB)->result();
     }
     public function keranjang()
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
          echo $this->show();
     }
     public function show()
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
     public function load()
     {
          echo $this->show();
     }
     public function hapus()
     {
          $data = array(
               'rowid' => $this->input->post('row_id'),
               'qty'     => 0,
          );
          $total = $this->cart->total();
          $this->cart->update($data);
          echo $this->show();
     }

     public function insTr()
     {

          date_default_timezone_set('Asia/Jakarta');

          $kode_pemesanan = $this->input->post('kode_pemesanan');
          $id_user = $this->session->userdata("id_user");
          $id_pelanggan = $this->input->post('id_pelanggan');
          $tgl = date('Y-m-d');
          $tanggal = $tgl;
          $total = $this->input->post('total');
          $bayar = $this->input->post('bayar');
          $pesan = $this->input->post('pesan');

          $pemesanan = array(
               'kode_pemesanan' => $kode_pemesanan,
               'id_user' => $id_user,
               'id_pelanggan' => $id_pelanggan,
               'tanggal' => $tanggal,
               'total' => $total,
               'bayar' => $bayar,
               'pesan' => $pesan,
          );
          $result = $this->db->insert($this->_tT, $pemesanan);
     }
     function detail()
     {
          if ($cart = $this->cart->contents()) {
               $kode_pemesanan = $this->input->post('kode_pemesanan');
               foreach ($cart as $item) {
                    $data_detail = array(
                         'kode_pemesanan' => $kode_pemesanan,
                         'id_barang' => $item['id'],
                         'jumlah' => $item['qty'],
                    );
                    $this->db->insert($this->_tDT, $data_detail);
               }
          }
     }
}
