<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laporan Barang | JHP</title>
  <?php $this->load->view('_partials/head') ?>
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
          <div class="col-xs-12 col-sm-offset-0">
            <!-- form table -->
            <div class="box ">
              <div class="box-header">
                <br><br>
                <h3 class="box-title">Laporan Barang</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-header with-border">
                <form action="" method="GET">
                  <div class="form-group">
                    <label class="col-sm-1 control-label">Kategori</label>
                    <div class="col-sm-3">
                      <select class="form-control select2" name="idkat" style="width: 60%;" id="idkat">
                        <option value="">-Pilih Kategori-</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Bubuk">Bubuk</option>

                      </select>
                    </div>
                    <label class="col-sm-1 control-label"></label>
                    <div class="col-sm-3">
                      <!-- <select class="form-control select2" name="ids" style="width: 60%;" id="ids">
                         <option value="">-Pilih Satuan-</option>
                         <option value="Grosir">Grosir</option>
                         <option value="Ecer">Ecer</option>
                         
                       </select>
                       -->
                    </div>
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">
                      <div class="col-md-3 col-sm-offset-5">
                        <a href="<?php echo site_url('laporan_barang/cetak') ?>" class="btn btn-success" name="cetakBarang" id="cetakBarang">
                          <li class="fa fa-print">Cetak</li>
                        </a>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
              <div class="box-body">
                <table id="example1" class="table  table-striped">
                  <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Harga</th>
                      <th>Stok</th>
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
    <?php
    ?>
  </div>
  <!-- ./wrapper -->

  <?php $this->load->view('_partials/script'); ?>
  <script type="text/javascript">
    //crud
    showRecord(); //munculkan data
    //function showdata
    function showRecord() {
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('Laporan_Barang/getAll') ?>',
        data: "idkat=" + idkat,
        async: true,
        dataType: 'JSON',
        success: function(data) {
          var html = '';
          var i;

          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + data[i].namabarang + '</td>' +
              '<td>' + data[i].satuan + '</td>' +
              '<td>' + data[i].harga + '</td>' +
              '<td>' + data[i].stok + '</td>' +
              '</tr>';
          }
          $('#showData').html(html);
          $('#example1').dataTable()
        }
      });
    }
    //function kosongan
    function kosong() {
      document.getElementById('nama').value = "";
      document.getElementById('password').value = "";
    }; //akhir
  </script>
  <script>
    $(document).ready(function() {
      $("#idkat").change(function() {
        // let a = $(this).val();
        $.ajax({
          type: "POST",
          url: '<?php echo site_url('Laporan_Barang/getWhere/') ?>' + $(this).val(),
          dataType: "JSON",
          success: function(response) {
            console.log(response);
            var html = '';
            var i;

            for (i = 0; i < response.length; i++) {
              html += '<tr>' +
                '<td>' + response[i].namabarang + '</td>' +
                '<td>' + response[i].satuan + '</td>' +
                '<td>' + response[i].harga + '</td>' +
                '<td>' + response[i].stok + '</td>' +
                '</tr>';
            }
            $('#showData').html(html);
            $('#example1').dataTable()
          }
        });
      });
    });

    function getKat() {
      var idkat = $("#idkat").val();
      $.ajax({
        type: "POST",
        url: "../Admin/Produk/kategori",
        data: "idkat=" + idkat,
        dataType: "html",
        success: function(msg) {
          $("#table-data").html(msg);
        },
        error: function() {
          alert("Search failed");
        }
      });
    }
  </script>
  <!-- Script -->

</body>

</html>