<!DOCTYPE html >
<html lang="en">
<head>
<title>Laporan Pemesanan | JHP</title>
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
          <!-- form table -->
          <div class="box ">
            <div class="box-header">
              <br><br>
              <h3 class="box-title">Laporan Pemesanan</h3>
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
                  <th>Kode Pemesanan</th>
                  <th>tanggal</th>
                  <th>Kasir</th>
                  <th>Pelanggan</th>
                  <th>total</th>
                  <th>bayar</th>
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
    //crud
    showRecord(); //munculkan data
    //function showdata
    function showRecord(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('Laporan_Pemesanan/getAll')?>',
        async: true,
        dataType: 'JSON',
        success: function(data){
          var html = '';
          var i; 
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                      '<td>'+data[i].kode_pemesanan+'</td>'+
                      '<td>'+data[i].tanggal+'</td>'+
                      '<td>'+data[i].kasir+'</td>'+
                      '<td>'+data[i].pemesan+'</td>'+
                      '<td>'+data[i].total+'</td>'+
                      '<td>'+data[i].bayar+'</td>'+
                      '<td style="text-align:right;">'+
                        
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_belanja" data-nofaktur="'+data[i].kode_pemesanan+'">Detail</a>'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_riwayat" data-nofaktur="'+data[i].kode_pemesanan+'">Ambil</a>'+
                      '</td>'+
                    '</tr>';
                }
          $('#showData').html(html);
          $('#example1').dataTable({
            'searching'   : true,
            'ordering'    : false,
          })
        }
      });
    }
    //function kosongan
    function kosong(){
      document.getElementById('nama').value="";
      document.getElementById('password').value="";
    }; //akhir
</script>
<!-- Script -->

</body>
</html>
