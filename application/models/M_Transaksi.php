<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transaksi extends CI_Model {
     private $_table = "pelanggan";
     private $_tableB = "barang";
     private $_tT = "transaksi";
     private $_tDT = "detail_transaksi";
     private $_tK = "angsuran";
     
     public function kode(){
          $this->db->select('LEFT(transaksi.nofaktur, 4) as nofaktur', FALSE);
          date_default_timezone_set("asia/jakarta");
          $this->db->where("tanggal =  date(now())");
          $this->db->order_by('nofaktur','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('transaksi');  //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
               //cek kode jika telah tersedia    
               $data = $query->row();      
               $kode = intval($data->nofaktur) + 1; 
          }else{
               $kode = 1;  //cek jika kode belum terdapat pada table
          }
          $id_user = $this->session->userdata("id_user");
          $tgl=date('dmY');
          $D=date('d'); 
          $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
          $kodetampil = $batas."/".$id_user."/".$D."/XXXX"."/".$tgl."/Q";  //format kode
          return $kodetampil;  
     }
     function nota(){
          $nofaktur = "0001/far/08/asdf/08072019/BN";
          $this->db->select('transaksi.nofaktur');
          $this->db->where('nofaktur', $nofaktur);
          $hasil= $this->db->get('transaksi');
          return $hasil;
     }

     function searchPelanggan(){
          $hasil=$this->db->query("SELECT * FROM pelanggan");
          return $hasil;
     }

     public function ambil_data()
     {
         return $this->db->get($this->_table)->result();
     }
     
     function searchBarang(){
          $hasil=$this->db->query("SELECT * FROM barang");
          return $hasil;
     }
     public function ambilBarang(){
         return $this->db->get($this->_tableB)->result();
     }
     public function keranjang(){
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
     public function show(){
          $output='';
		foreach ($this->cart->contents() as $items) {
			# code...
			$output .='
                    <tr>
                         <td>'.$items['id'].'</td>
                         <td>'.$items['name'].'</td>
                         <td>'.$items['qty'].'</td>
                         <td>'.number_format($items['price']).'</td>
                         <td>
                              <div class="col-md-8">
                              <div class="form-group">
                                   <input type="text" id="subtotal" name="subtotal" value="'.$items['subtotal'].'" class="form-control" style="text-align:right;margin-bottom:5px;" readonly>
                              </div>
                         </div>
                         </td>
                              <td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
                    </tr>
          ';
		}
               return $output;
     }
     public function load(){
          echo $this->show();
     }
     public function hapus(){
          $data = array(
			'rowid' => $this->input->post('row_id'),
			'qty'	=>0,
		);
		$total = $this->cart->total();
		$this->cart->update($data);
		echo $this->show();
     }

     public function insTr(){
          date_default_timezone_set('Asia/Jakarta');

          $nofaktur = $this->input->post('nofaktur');
          $id_user = $this->session->userdata("id_user");
          $id_pelanggan = $this->input->post('id_pelanggan');
          $tgl=date('Y-m-d');
          $tanggal = $tgl; 
          $total = $this->input->post('total');
          $bayar = $this->input->post('bayar');
          $kategori = $this->input->post('kategori');
          
          $transaksi = array(
               'nofaktur'=>$nofaktur,
               'id_user'=>$id_user,
               'id_pelanggan'=>$id_pelanggan,
               'tanggal'=>$tanggal,
               'total'=>$total,
               'bayar'=>$bayar,
               'kategori'=>$kategori
          );
          $result = $this->db->insert($this->_tT, $transaksi);
          
          
     }
     function detail(){
          if ($cart = $this->cart->contents()){
               $nofaktur = $this->input->post('nofaktur');
               foreach ($cart as $item){
                    $data_detail = array('nofaktur' =>$nofaktur,
                                   'id_barang' => $item['id'],
                                   'jumlah' => $item['qty'],
                                   );
                    $this->db->insert($this->_tDT, $data_detail);
               }
          }
     }
}