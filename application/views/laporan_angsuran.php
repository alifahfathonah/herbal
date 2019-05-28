<!DOCTYPE html >
<html lang="en">
<head>
<title>Laporan Angsuran | JHP</title>
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
        <div class="col-xs-12 col-sm-offset-0"   >
          <!-- form edit -->
           <!-- MODAL EDIT -->
          <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Laporan Angsuran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No Faktur</label>
                            <div class="col-md-10">
                              <input type="text" name="nofaktur_edit" id="nofaktur_edit" class="form-control" placeholder="No Faktur" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                              <input type="text" name="nama_edit" id="nama_edit" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Barang</label>
                            <div class="col-md-10">
                              <input type="text" name="namabarang_edit" id="namabarang_edit" class="form-control" placeholder="Nama Barang">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2 col-form-label">Total</label>
                            <div class="col-md-10">
                              <input type="text" name="total_edit" id="total_edit" class="form-control" placeholder="Total">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Bayar</label>
                            <div class="col-md-10">
                              <input type="text" name="bayar_edit" id="bayar_edit" class="form-control" placeholder="Bayar">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <!--END MODAL EDIT-->
          <!-- form table -->
          <div class="box ">
            <div class="box-header">
              <br><br>
              <h3 class="box-title">Laporan Angsuran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-header with-border">
                  
                  <div class="col-md-3">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 col-sm-offset-5">
                        <button class="btn btn-success" name="cetak_barang"><li class="fa fa-print"></li>Cetak</button>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="box-body">
              <table id="example1" class="table  table-striped" >
                <thead>
                <tr>
                  <th>No Faktur</th>
                  <th>Nama Pelanggan</th>
                  <th>Nama Barang</th>
                  <th>Total</th>
                  <th>Bayar</th>
                  <th>Pilihan</th>
                </tr>
                </thead>
                <tbody id="showData">
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
    $(".formtambah").fadeOut();
    $(".formedit").fadeOut();
    
    $("#MsgNama").hide();
    $(".click-hide").click(function(e){
      e.preventDefault()
      $(".formtambah").fadeOut(1000);
      
      kosong();
    })
    $(".click-Hide").click(function(e){
      e.preventDefault()
      $(".formedit").fadeOut(1000);
      
      kosong();
    })
     $(".click-Hide").click(function(e){
      e.preventDefault()
      $(".formedit").fadeOut(1000);
      
      kosong();
    })
      $(".click-Hide").click(function(e){
      e.preventDefault()
      $(".formedit").fadeOut(1000);
      
      kosong();
    })

    $(".click-Hide").click(function(e){
      e.preventDefault()
      $(".formedit").fadeOut(1000);
      
      kosong();
    })

    //crud

    showRecord(); //munculkan data
    
    
    //function showdata
    function showRecord(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('Laporan_Angsuran/getAll')?>',
        async: true,
        dataType: 'JSON',
        success: function(data){
          var html = '';
          var i; 
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                      '<td>'+data[i].nofaktur+'</td>'+
                      '<td>'+data[i].nama+'</td>'+
                      '<td>'+data[i].namabarang+'</td>'+
                      '<td>'+data[i].total+'</td>'+
                      '<td>'+data[i].bayar+'</td>'+
                      '<td style="text-align:right;">'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-nofaktur="'+data[i].nofaktur+'" data-kode_pemesanan="'+data[i].kode_pemesanan+'" data-tanggal="'+data[i].tanggal+'" data-total="'+data[i].total+'"data-bayar="'+data[i].bayar+'">Edit</a>'+
                      '</td>'+
                    '</tr>';
                }
          $('#showData').html(html);
          $('#example1').dataTable()
        }
      });
    }
    //function kosongan
    function kosong(){
      document.getElementById('nofaktur').value="";
      document.getElementById('nama').value="";
      document.getElementById('namabarang').value="";
      document.getElementById('total').value="";
      document.getElementById('bayar').value="";
    }
    


    //simpan
    $('#click-simpan').on('click',function(e){
      
      var nofaktur = $('#nofaktur').val();
      var nama = $('#nama').val();
      var namabarang = $('#namabarang').val();
      var total = $('#total').val();
      var bayar = $('#bayar').val();
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('Laporan_Angsuran/add') ?>',
        dataType: "JSON",
        data: {nofaktur:nofaktur, nama:nama, namabarang:namabarang, total:total},
        success: function(data){
          $('[name="nofaktur"]').val("");
          $('[name="nama"]').val("");
          $('[name="namabarang"]').val("");
          $('[name="total"]').val("");
          $('[name="bayar"]').val("");
          showRecord();
        }
      });
      
      $(".formtambah").fadeIn(1000);
      return false;
      
    });
    //edit
    //ambil datanya dulu
    $('#showData').on('click','.item_edit', function(){
      kosong();
      var nofaktur = $(this).data('nofaktur');
      var nama = $(this).data('nama');
      var namabarang = $(this).data('namabarang');
      var total = $(this).data('total');
      var bayar = $(this).data('bayar');
      
      $('#Modal_Edit').modal('show');
      $('[name="nofaktur_edit"]').val(nofaktur);
      $('[name="nama_edit"]').val(nama);
      $('[name="namabarang_edit"]').val(namabarang);
      $('[name="total_edit"]').val(total);
      $('[name="bayar_edit"]').val(bayar);
    });

     //update record to database
    $('#btn_update').on('click',function(){
      var nofaktur = $('#nofaktur_edit').val();
      var nama = $('#nama_edit').val();
      var namabarang = $('#namabarang_edit').val();
      var total = $('#total_edit').val();
      var bayar = $('#bayar_edit').val();
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('Laporan_Angsuran/edit')?>",
          dataType : "JSON",
          data : {nofaktur:nofaktur, nama:nama, namabarang:namabarang, total:total},
          success: function(data){
              $('[name="nofaktur_edit"]').val("");
              $('[name="nama_edit"]').val("");
              $('[name="namabarang_edit"]').val("");
              $('[name="total_edit"]').val("");
              $('[name="bayar_edit"]').val("");
              $('#Modal_Edit').modal('hide');
              showRecord();
          }
      });
      return false;
    });
    
  }); //akhir
</script>
<!-- Script -->
</body>
</html>
