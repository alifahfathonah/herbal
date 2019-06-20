<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barang extends CI_Model {
    // deklarasi variable
    private $_table = "barang";
    public $id_barang;
    public $namabarang;
    public $harga;
    public $satuan;
    public $stok;
    public $kategori;
    public $gambar;
    public $deskripsi;

    //menampilkan data
    public function rule(){
        return[
            [`field` => `id_barang`,
            `rules` => `required`],
            [`field` => `namabarang`,
            `rules` => `required`],
        ];
    }

    //menampilkan data
    public function ambil_data(){
        return $this->db->get($this->_table)->result();
    }

   //create
    public function save(){
        $config['upload_path']          = realpath(APPPATH. '../upload/');
    $config['allowed_types']        = 'gif|jpg|png';
    $config['overwrite']            = true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);
    if(!$this->upload->do_upload('gambar')) {
            echo $this->upload->display_errors();
    } else {
                $filename= $this->upload->data('file_name');
              $post = $this->input->post();
        $this->id_barang = $post["id_barang"];
        $this->namabarang = $post["namabarang"];
        $this->harga = $post["harga"];
        $this->satuan= $post["satuan"];
        $this->stok = $post["stok"];
        $this->kategori = $post["kategori"];
        $this->gambar = $filename;
        $this->deskripsi = $post["deskripsi"];
        
        $result = $this->db->insert($this->_table,$this);
        }

    }
    //Update data
    public function update(){
                $config['upload_path']          = realpath(APPPATH. '../upload/');
    $config['allowed_types']        = 'gif|jpg|png';
    $config['overwrite']            = true;
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);
    if(!$this->upload->do_upload('gambar')) {
            echo $this->upload->display_errors();
    } else {
        $post = $this->input->post();
        $filename= $this->upload->data('file_name');
        $this->id_barang = $post["id_barang"];
        $this->namabarang = $post["namabarang"];
        $this->harga = $post["harga"];
        $this->satuan= $post["satuan"];
        $this->stok = $post["stok"];
        $this->kategori = $post["kategori"];
        $this->gambar = $filename;
        $this->deskripsi = $post["deskripsi"];

        $this->db->update($this->_table, $this, array('id_barang'=>$post['id_barang']));
    }
        
        }
    //Delete
    public function delete(){
        // return $this->db->delete($this->_table, array("id_user"=> $id_user));
        $id_barang = $this->input->post('id_barang');
        $this->db->where('id_barang', $id_barang);
        $result = $this->db->delete('barang');
        return $result;
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->id_barang;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";

    }

}