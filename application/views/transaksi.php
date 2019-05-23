<!DOCTYPE html >
<html lang="en">
<head>
<title>Register | JHP</title>
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

                <div class="box-header">
                    
                    <div class="form-horizontal">
                        <div class="box-body">
                                
                            <div class="form-group">
                            <label  class="col-sm-2 control-label">Transaksi</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" readonly name="nofaktur" placeholder="" id="nofaktur" >
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
                            <div class="form-group">
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Nama Pelanggan</label>
                                <div class="col-sm-3">
                                    <select class="form-control select2 " style="width: 100%;" name="namaPelanggan" id="namaPelanggan">
                                    <option value="" disable >Cari Pelanggan</option>
                                    <?php foreach ($pelanggan as $p): ?>
                                        <option data-alamat="<?php echo $p->alamat ?>" value="<?php echo $p->id_pelanggan?>"><?php echo $p->nama;?></option>
                                    <?php endforeach;?>
                                    </select>
                                
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control"  id="alamat" name="alamat">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Nama Barang</label>
                                <div class="col-sm-3">
                                    <select class="form-control select2 " style="width: 100%;" name="namaBarang" id="namaBarang">
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
                                <button type="submit" class="add_keranjang btn btn-info" name="keranjang" id="keranjang">Tambah</button>
                                <input type="checkbox" class="minimal"  id="kredit" name="kredit" value="kredit">  <label  class="control-label">Kredit</label>
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
                                <input type="text" class="form-control"  id="potongan" name="potongan" placeholder="Potongan">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="total"  name="total" >
                                
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control"  id="bayar" name="bayar" placeholder="Bayar">
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

                </div>
            </div>
        <!-- /.col -->
      </div>
      <div class>

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
            }
        });
    return false;
    }
    function setTotal(){
        var total = $('#total').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Transaksi/total') ?>",
            dataType: "JSON",
            data:{total:total},
            success : function(data){
                $('[name="total"]').val(data);
            }
        });
    return false;
    }
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
    $("#namaPelanggan").change(function(){
        var nofaktur = $('#nofaktur').val();
        var alamat = $(this).find(":selected").data("alamat");
        var res = alamat.substring(0, 4);
        var txt = nofaktur.replaceAt(14,res);
        $('#nofaktur').val(txt);
        $('#alamat').val(alamat);
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
        var qty = $("#qty").val();
        var price = $("#price").val();
       
        $.ajax({
            url : "<?php echo base_url(); ?>Transaksi/Cart",
            method : "POST",
            data : {id : id, name : name, qty : qty, price : price },
            success: function(data){
                $("#detailCart").html(data);
                kosong();
                setTotal()
            }
        });
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
    //
    $("#kredit").change(function(){
        var st =  this.checked;
        if(st) {
            alert("tahu");
        }
    });
  }); //akhir
</script>
<!-- Script -->

</body>
</html>
