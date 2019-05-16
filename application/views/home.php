<!DOCTYPE html>
<html>

<head>
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
          <div class="col-xs-12">

            <!-- /.box -->

            <div class="box">
              <div class="box-header">

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <section class="content">
                      <!-- Small boxes (Stat box) -->
                      <div class="data">
                        <div class="col-lg-3 col-xs-2">
                          <!-- small box -->
                          <div class="small-box bg-aqua">
                            <div class="inner">

                              <h3>10</h3>

                              <p style="font-size: 18px">Login</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="?halaman=data_kategori" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                          <div class="small-box bg-green">
                            <div class="inner">
                              <h3>10</h3>

                              <p style="font-size: 18px">Data Barang</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-filing"></i>
                            </div>
                            <a href="?halaman=barang" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                          <div class="small-box bg-yellow">
                            <div class="inner">
                              <h3>10</h3>

                              <p style="font-size: 18px">Data Satuan Barang</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-ios-browsers"></i>
                            </div>
                            <a href="?halaman=data_satuan" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-2">
                          <div class="small-box bg-red">
                            <div class="inner">
                              <h3>10</h3>

                              <p style="font-size: 18px">Data Pelanggan</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-ios-people"></i>
                            </div>
                            <a href="?halaman=supplier" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                          <div class="small-box bg-purple">
                            <div class="inner">
                              <h3>10</h3>

                              <p style="font-size: 18px">Transaksi</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-android-archive"></i>
                            </div>
                            <a href="?halaman=barang_masuk" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                          <div class="small-box bg-lime">
                            <div class="inner">
                              <h3>10</h3>

                              <p style="font-size: 18px">Pemesanan</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-ios-cart"></i>
                            </div>
                            <a href="?halaman=transaksi" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col col-lg-1 col-xs-2"></div>
                        <div class="col-lg-4 col-xs-6">

                          <div class="box box-info">
                            <div class="box-header with-border">
                              <center>
                                <script type="text/javascript">
                                  window.onload = function() {
                                    jam();
                                  }

                                  function jam() {
                                    var e = document.getElementById('jam2'),
                                      d = new Date(),
                                      h, m, s;
                                    h = d.getHours();
                                    m = set(d.getMinutes());
                                    s = set(d.getSeconds());

                                    e.innerHTML = h + ':' + m + ':' + s;

                                    setTimeout('jam()', 1000);
                                  }

                                  function set(e) {
                                    e = e < 10 ? '0' + e : e;
                                    return e;
                                  }
                                </script>

                                <h2 id="jam2"></h2>
                              </center>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="?halaman=barang" method="post" class="form-horizontal">
                              <div class="box-body">
                                <div class="form-group">

                                </div>


                                </tfoot>
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
    <?php $this->load->view('_partials/footer'); ?>

    <!-- Control Sidebar -->
    <?php
    ?>
  </div>
  <!-- ./wrapper -->
  <?php $this->load->view('_partials/script'); ?>
</body>

</html>