<?php
	include "koneksi.php";
	
	$nama 	= $_POST['nama'];
	$nohp 	= $_POST['nohp'];
	$alamat = $_POST['alamat'];
	$email 	= $_POST['email'];
	$password 	= $_POST['password'];

	$carikode = mysqli_query($koneksi, "SELECT id_pelanggan from pelanggan") or die (mysqli_error());
  	// menjadikannya array
	$datakode = mysqli_fetch_array($carikode);
	$jumlah_data = mysqli_num_rows($carikode);
	// jika $datakode
	if ($datakode) {
	// membuat variabel baru untuk mengambil kode barang mulai dari 1
	$nilaikode = substr($jumlah_data[0], 1);
	// menjadikan $nilaikode ( int )
	$kode = (int) $nilaikode;
	// setiap $kode di tambah 1
	$kode = $jumlah_data + 1;
	// hasil untuk menambahkan kode 
	// angka 3 untuk menambahkan tiga angka setelah B dan angka 0 angka yang berada di tengah
	// atau angka sebelum $kode
	$kode_otomatis = "PEL".str_pad($kode, 6, "0", STR_PAD_LEFT);
	} else {
	$kode_otomatis = "PEL0001";
	}
	
	class emp{}
	
	if (empty($email) || empty($password)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Kolom isian tidak boleh kosong"; 
		die(json_encode($response));
	} else {
		$query = mysql_query("INSERT INTO pelanggan ('id_pelanggan,nama,nohp, alamat,email,password') VALUES('".$kode_otomatis."','".$nama."','".$nohp."','".$alamat."','".$email."','".$password."')");
		
		if ($query) {
			$response = new emp();
			$response->success = 1;
			$response->message = "Data berhasil di simpan";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error simpan Data";
			die(json_encode($response)); 
		}	
	}
?>