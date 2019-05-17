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
        <div class="col-xs-8 col-sm-offset-1"   >
        <div class="box box-info">

            <div class="box-header">
                
                <form class="form-horizontal">
                <div class="box-body">
                        
                    <div class="form-group">
                    <label  class="col-sm-2 control-label">Transaksi</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" readonly name="nofaktur" placeholder="" id="nofaktur" >
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" readonly name="sid" placeholder=""  >
                        <input type="text" class="form-control" readonly name="username" placeholder="" >

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
                    <label  class="col-sm-2 control-label">Nama Barang</label>
                    <div class="col-sm-3">
                        <select class="form-control select2 " style="width: 100%;" name="namaPelanggan" id="namaPelanggan">
                        <option value="">tahu</option>
                        <option value="">lontong</option>
                        <?php foreach ($pelanggan as $p): ?>
                            <option data-alamat="<?php echo $p->alamat ?>" value="<?php echo $p->id_pelanggan?>"><?php echo $p->nama;?></option>
                        <?php endforeach;?>
                        </select>
                       
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"  id="alamat" name="alamat">
                        <input type="number" class="form-control"  name="jumlah" placeholder="Jumlah" id="jumlah" >
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-3 col-sm-offset-5">
                        <button type="submit" class="btn btn-info" name="tambah" id="btn">Tambah</button>
                    </div>
                    </div>

                    <div class="form-group" >
                    <div class="col-sm-8 col-sm-offset-2">
                        <table  class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>                
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>                
                            <th>Pilihan</th>          
                        </tr>
                        </thead>
                        <tbody >
                              
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                                <td style="text-align: right;"></td>
                                <td>
                                    <a class="btn btn-danger " href="?halaman=transaksi&delete=" onclick="return confirm('Anda Yakin Ingin Menghapus Data?')"> <li class="fa fa-close"></li> </a>
                                    
                                    <button class="btn btn-info" name="printdo" type="submit"><li class="fa fa-print"></li></button>
                                    
                                </td>
                            </tr>

                        </tbody>
                        <tfoot> 
                            <tr>
                            <th colspan="4" style="text-align: right;">Total</th>
                            <td colspan="2" style="text-align: center;"> </td>
                            </tr>               
                        </tfoot> 
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
                </form>
            </div>

            </div>
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
  $(document).ready(function(e){
    
   //set kode
   setCode();
   date();
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
   function date() {
    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 

    if(mm<10) 
    {
        mm='0'+mm;
    } 
    today = dd+'/'+mm+'/'+yyyy;
     $('[name="tanggal"]').val(today); 
   }
   //get alamat
   $("#namaPelanggan").change(function(){
    var alamat = $(this).find(":selected").data("alamat")
    $("#alamat").val(alamat)
   })
   //replace
    $("#alamat").keyup(function(){
      var alamat = $(this).val();
      var res = alamat.substring(0, 3);
      $('#nofaktur').val( res);
    });



  }); //akhir
</script>
<!-- Script -->

</body>
</html>
