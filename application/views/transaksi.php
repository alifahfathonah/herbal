<!DOCTYPE html >
<html lang="en">
<head>
<title>Transaksi | JHP</title>
  <?php $this->load->view('_partials/head')?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <header class="main-header">
    <?php $this->load->view('_partials/header'); ?>
    
  </header> 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
   <?php $this->load->view('_partials/sidebar'); ?>
    <!-- /.sidebar -->
  </aside>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-8 col-sm-offset-1">
            <div class="box box-info">
                <!-- <form enctype="multipart/form-data" class="form-horizontal" method="post" id="formnya" > -->
                    <div class="box-header">
                        
                        <div class="form-horizontal">
                            <div class="box-body">
                                    
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Transaksi</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" readonly name="nofaktur" placeholder="" id="nofaktur" >
                                        <input type="hidden" class="form-control" readonly name="id_user" placeholder="" id="id_user" value="<?php echo $this->session->userdata("id_user"); ?>">
                                        
                                    </div> 
                                    <div class="col-sm-3 ">
                                        <div class="input-group">
                                                
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="tanggal" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask  readonly="readonly" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Nama Pelanggan</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2 j" style="width: 100%;" name="id_pelanggan" id="id_pelanggan">
                                        <option value="" disable >Cari Pelanggan</option>
                                        <?php foreach ($pelanggan as $p): ?>
                                            <option data-nohp="<?php echo $p->nohp ?>" data-alamat="<?php echo $p->alamat ?>" data-nama="<?php echo $p->nama ?>" value="<?php echo $p->id_pelanggan?>"><?php echo $p->nama;?></option>
                                        <?php endforeach;?>
                                        </select>
                                        <i><p id="msgP" class="help-block"></p></i>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  id="alamat" name="alamat">
                                        <input type="hidden" class="form-control"  id="kategori" name="kategori">
                                        <input type="hidden" class="form-control" id="pesan" name="pesan">
                                        <input type="text" class="form-control" id="nama" name="nama">
                                        <input type="text" class="form-control" id="nohp" name="nohp">
                                                
                                    </div>
                                    <div class="col-sm-3">
                                        <textarea class="form-control" readonly rows="3" name="log" id="log" placeholder=""></textarea>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Nama Barang</label>
                                    <div class="col-sm-3">
                                        <select class="form-control select2 j" style="width: 100%;" name="namaBarang" id="namaBarang">
                                        <option value="" disable>Pilih Barang</option>
                                        <?php foreach ($barang as $b): ?>
                                            <option data-namabarang="<?php echo $b->namabarang ?>" data-stok="<?php echo $b->stok ?>" data-harga="<?php echo $b->harga ?>" value="<?php echo $b->id_barang?>"><?php echo $b->namabarang;?></option>
                                        <?php endforeach;?>
                                        </select>
                                        
                                    
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="hidden" class="form-control"  id="stok" name="stok">
                                        <input type="hidden" class="form-control"  id="price" name="price">
                                        <input type="hidden" class="form-control"  id="name" name="name">
                                        <input type="number" class="form-control"  name="qty" placeholder="Jumlah" id="qty" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 col-sm-offset-5">
                                        <button  class="add_keranjang btn btn-info" name="keranjang" id="keranjang">Tambah</button>
                                        <input type="checkbox" class="minimal"  id="kondisi" name="kondisi" >  <label  class="control-label">Kredit</label>
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <table  class="table table-striped table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nama Barang</th>                
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>                
                                                    <th>Pilihan</th>          
                                                </tr>
                                            </thead>
                                            <tbody id="detailCart">
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="total"  name="total" >
                                        <input type="hidden" class="form-control" id="hargaAwal"  name="hargaAwal" >
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control"  id="potongan" name="potongan" placeholder="%Diskon">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  id="bayar" name="bayar" placeholder="Bayar">
                                        <i><p id="msgB" class="help-block"></p></i>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  id="kembalian" name="kembalian" placeholder="Kembalian">
                                    </div>

                                    <div class="col-sm-3 col-sm-offset-1">
                                        <button  type="submit" class="btn btn-warning" name="transaksi" id="transaksi">Transaksi</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <?php //$this->load->view('_partials/aside');?>
</div>
<!-- ./wrapper -->

<?php $this->load->view('_partials/script');?>
<script type="text/javascript">
    function startApp() {
        //create websocket client
        var client = new WebSocket("ws://192.168.43.1:8989");

        //onOpen handler
        client.onopen = function (event) {
            var log = document.getElementById("log");
            log.textContent = log.textContent + "\n" + "Koneksi ke server berhasil";	
        };

        //onClose handler
        client.onclose = function (event) {
            var log = document.getElementById("log");
            log.textContent = log.textContent + "\n" + "Koneksi ke server terputus";	
        };

        //onError handler
        client.onerror = function (event) {
            var log = document.getElementById("log");
            log.textContent = log.textContent + "\n" + "Koneksi ke server error";	
        };

        //onMessage handler
        client.onmessage = function (event) {
            var response = JSON.parse(event.data);

            switch (response.type) {
                case "success" :
                // suskses mengirim sms ke server
                alert(response.message);
                break;

                case "error" :
                // gagal mengirim sms ke server
                alert(response.message);
                break;

                case "notification" :
                // laporan status pengiriman sms
                var log = document.getElementById("log");
                if (response.success) {
                    log.textContent = log.textContent + "\n" + "Laporan Sukses: "+ response.message;
                } else {
                    log.textContent = log.textContent + "\n" + "Laporan gagal : "+ response.message;
                }
                break;

                case "received" :
                // menerima sms
                if (confirm("SMS dari" + response.from + " :\n"
                    + response.message + "\n" +
                    "Apakah ingin dibalas?")) {
                    document.getElementById("to").value = response.from;
                }
                break;
            }
        };

        // aksi tombol Send SMS
        document.getElementById("transaksi").onclick = function (){
            
            //mengambil value no tujuan
            var to = document.getElementById("nohp").value;

            //mengambil value isi pesan SMS
            var message = document.getElementById("pesan").value;
            
            var splits = to.split(",");
            if (splits.length == 1) {
                // bukan broadcast

                //membuat json
            var json = {
                to: to,
                message: message
            };

            //mengirim ke server via websocket
            client.send(JSON.stringify(json));

            } else {
                //broadcast

                //membuat json broadcast
                var json = {
                    to: splits,
                    message: message
                };

                //mengirim ke server via websocket
                client.send(JSON.stringify(json));
            }
        }
    }
    window.onload = startApp;
  $(document).ready(function(e){
    
    //set kode
    setCode();
   
    date();
    setTotal()
    function setCode(){
        var nofaktur = $('#nofaktur').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Transaksi/setCode') ?>",
            dataType: "JSON",
            data:{nofaktur:nofaktur},
            success : function(data){
                $('[name="nofaktur"]').val(data);
                $('#kategori').val("lunas");
            }
        });
    return false;
    }
    //set total
    function setTotal(){
        var total = $('#total').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Transaksi/total') ?>",
            dataType: "JSON",
            data:{total:total},
            success : function(data){
                $('[name="total"]').val(data);
                $('[name="hargaAwal"]').val(data);
            }
        });
        return false;
    }
    //hari
    function date() {
        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd='0'+dd;
        } 
        if(mm<10) {
            mm='0'+mm;
        } 
        today = dd+'/'+mm+'/'+yyyy;
        $('[name="tanggal"]').val(today); 
    }
    //get alamat
    $("#id_pelanggan").change(function(){
        var nofaktur = $('#nofaktur').val();
        var alamat = $(this).find(":selected").data("alamat");
        var nama = $(this).find(":selected").data("nama");
        var nohp = $(this).find(":selected").data("nohp");
        var res = alamat.substring(0, 4);
        var txt = nofaktur.replaceAt(12,res);
        $('#nofaktur').val(txt);
        $('#alamat').val(alamat);
        $('#nama').val(nama);
        $('#nohp').val(nohp);
    })
    //function replace at
    String.prototype.replaceAt=function(index, replacement) {
    return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
    }
    
    //getStokBarang
    $("#namaBarang").change(function(){
        var stok = $(this).find(":selected").data("stok");
        $('#stok').val(stok);
        var harga = $(this).find(":selected").data("harga");
        $('#price').val(harga);
        var namaB = $(this).find(":selected").data("namabarang");
        $('#name').val(namaB);
    })  
    function kosong(){
      document.getElementById('namaBarang').value="";
      document.getElementById('stok').value="";
      document.getElementById('price').value="";
      document.getElementById('name').value="";
      document.getElementById('qty').value="";
    }
    //keranjang
    $(".add_keranjang").click(function(){
        var id = $("#namaBarang").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var stok = parseInt($("#stok").val());
        var qty = parseInt($("#qty").val());
       
        if(stok >= qty){
            $.ajax({
                url : "<?php echo base_url(); ?>Transaksi/Cart",
                method : "POST",
                data : {id : id, name : name, qty : qty, price : price },
                success: function(data){
                    $('#namaBarang').val(null);
                    $("#detailCart").html(data);
                    kosong();
                    setTotal()
                }
            });
        }else{
            alert("Stok tidak mecukupi, tersedia = " +stok);
        }
    })
    //load
    $('#detailCart').load("<?php echo base_url();?>Transaksi/load_cart");
    //hapus cart
    $(document).on('click', '.hapus_cart', function(){
        var row_id = $(this).attr("id");
        $.ajax({
            url		: "<?php echo base_url(); ?>Transaksi/hapus_keranjang",
            method 	:"POST",
            data 	: {row_id : row_id},
            success	: function(data){
                $('#detail_keranjang').html(data);
                $('#detailCart').load("<?php echo base_url();?>Transaksi/load_cart");
                setTotal()
            }
        })
    })
    //kode kredit
    $('#kondisi').click(function () {
        if ($(this).is(":checked")) {
            var nofaktur = $('#nofaktur').val();
            var res = "B";
            var b= "N";
            var posisi =27;
            var result = [nofaktur.slice(0,posisi), b, nofaktur.slice(posisi)].join('');
            var txt = result.replaceAt(26,res);
            $('#nofaktur').val(txt);
            $('#kategori').val("kredit");
            
        } else {
            setCode();
        }
    });
    //cek stok
    $("#qty").keyup(function(){
        var stok = parseInt($("#stok").val());
        var thisVal = parseInt($(this).val());
        
        if(thisVal > stok){
        alert("Stok tidak mecukupi, tersedia = " +stok);
        }
      
    })
    //diskon
    $("#potongan").keyup(function(){
        var total = $("#hargaAwal").val()
        var thisVal = $(this).val()
        var diskon = parseInt (thisVal) * parseInt(total) / 100;
        result = total-diskon;
        if(thisVal != ""){
            $("#total").val(result);
        }else{
            $("#total").val(total);
        }
        hitung();
    })
    $("#bayar").keyup(function(){
        hitung();
        pesan();
    })
    //hitung
    function hitung() {
        var total = document.getElementById('total').value;
        var bayar = document.getElementById('bayar').value;

        var result = parseInt(bayar) - parseInt(total);
        
        if (bayar=="") {
        document.getElementById('kembalian').value = "";
        }else{
        document.getElementById('kembalian').value = result;
        if (result == 0) {
            document.getElementById('kembalian').value = "";
        }  
        }
    }
    //transaksi

    function pesan(){
        $('#pesan').val($('#nofaktur').val() + ' atas nama ' +
        $('#nama').val() + ', beralamat ' +
        $('#alamat').val() + ' biaya transaksi pembelian sebesar. Rp. ' +
        $('#total').val()+ ' Anda Telah mebayar sebesar. Rp. ' +
        $('#bayar').val() );
        var pesan = $('#pesan').val();
    }
   
    $('#transaksi').on('click',function(e){
      var nofaktur = $('#nofaktur').val();
      var id_user = $('#id_user').val();
      var id_pelanggan = $('#id_pelanggan').val();
      var kategori = $('#kategori').val();
      var bayar = $('#bayar').val();
      var total = $('#total').val();
      var potongan = $('#potongan').val();
      var pesan = $('#pesan').val();
      
      

      if(kategori == "kredit"){
        if(id_pelanggan == ""){
            document.getElementById("msgP").innerHTML = "*Pelanggannya..";
        }else{

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('Transaksi/addCre'); ?>',
                dataType: "JSON",
                data: {nofaktur:nofaktur, id_user:id_user, id_pelanggan:id_pelanggan, bayar:bayar, total:total, kategori:kategori, pesan:pesan},
                success: function(data){
                    setCode();
                    date();
                    document.getElementById('id_pelanggan').value="";
                $('[name="alamat"]').val("");
                $('[name="kategori"]').val("");
                $('[name="bayar"]').val("");
                $("#id_pelanggan").prop("selected", false);
                $("#namaBarang").prop("selected", false);
                $("#kondisi").prop("checked", false);
                $('[name="total"]').val("");
                $('[name="potongan"]').val("");
                $('[name="kembalian"]').val("");
                $('#detailCart').load("<?php echo base_url();?>Transaksi/hapusSemua");
                window.location="<?php echo base_url().'Transaksi/nota?nofaktur='; ?>"+nofaktur
                },
                error: function(data){
                console.log(data);
                }
            });
           
        }
      }else{
        if(id_pelanggan == ""){
            document.getElementById("msgP").innerHTML = "*Pelanggannya..";
        }else if(parseInt(bayar) < total || bayar==""){
            document.getElementById("msgB").innerHTML = "*Bayarnya...";
        }else if(bayar==""){
            document.getElementById("msgB").innerHTML = "*Bayarnya...";
        }else{

            $.ajax({
                type: "POST",
                url: '<?php echo site_url('Transaksi/add'); ?>',
                dataType: "JSON",
                data: {nofaktur:nofaktur, id_user:id_user, id_pelanggan:id_pelanggan, bayar:bayar, total:total, kategori:kategori,pesan:pesan},
                success: function(data){
                    setCode();
                    date();
                    document.getElementById('id_pelanggan').value="";
                $('[name="alamat"]').val("");
                $('[name="kategori"]').val("");
                $('[name="bayar"]').val("");
                $('[name="total"]').val("");
                $("#id_pelanggan").prop("selected", false);
                $("#namaBarang").prop("selected", false);
                $('[name="potongan"]').val("");
                $('[name="kembalian"]').val("");
                $('#detailCart').load("<?php echo base_url();?>Transaksi/hapusSemua");
                
                window.location="<?php echo base_url().'Transaksi/nota?nofaktur='; ?>"+nofaktur
                },
                error: function(data){
                console.log(data);
                }
            });


        }
      }
      
    });
  }); //akhir
</script>
<!-- Script -->

</body>
</html>
