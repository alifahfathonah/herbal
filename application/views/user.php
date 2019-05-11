<!DOCTYPE html >
<html >
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
        <div class="col-xs-8 col-sm-offset-1"ng-app="TambahApp" ng-controller="controllerTambah">
          
          <!-- /.box -->
          <div class="box box-info" ng-show="IsVisible">
                <div class="box-header with-border">
                  <center><h3 class="box-title">Tambah User</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" ng-click="ShowHide('hide')"><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Id User</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="id_user" placeholder="Id User">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="username" placeholder="Username">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Level</label>
                      <div class="col-sm-8">
                        
                      <select class="form-control" name="level">
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>
                      </select>
                      </div>
                    </div>
                    
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default" ng-click="ShowHide('hide')">Batal</button>
                    <button type="submit" class="btn btn-success pull-right" name="simpan">Simpan</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
          </div>
          <div class="box">
            <div class="box-header">
              <button class="btn btn-info" ng-click="ShowHide('show')"><li class="fa fa-plus"></li> Tambah</button>
              <br><br>
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Level</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                
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
  <!-- Control Sidebar -->
  <?php //$this->load->view('_partials/aside');?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('_partials/script');?>
<script type="text/javascript">
  var app = angular.module('TambahApp',[]);

  app.controller('controllerTambah', function($scope){
    $scope.IsVisible = false;
    $scope.ShowHide = function(parameter){
      if(parameter == "show"){
        $scope.IsVisible = true;
      }else{
        $scope.IsVisible = false;
      }
    }
  });
</script>
</body>
</html>
