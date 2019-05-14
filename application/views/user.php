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
          
          <!-- /.box -->
          <!-- form tambah -->
          <div class="box box-info formtambah" >
                <div class="box-header with-border">
                  <center><h3 class="box-title">Tambah User</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool click-hide" type="button" ><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" >
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Id User</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Id User">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="username"  name="username" placeholder="Username">
                        <div class="alert alert-danger" role="alert" id="MsgUsername"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control aturan" id="password" name="password" placeholder="Password">
                        <div class="alert alert-danger" role="alert" id="MsgPassword"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Level</label>
                      <div class="col-sm-8">
                        
                      <select class="form-control" id="level" name="level">
                        <option value="Admin">Admin</option>
                        <option value="Marketing">Marketing</option>
                      </select>
                      </div>
                    </div>
                    
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default click-hide" >Batal</button>
                    <button type="submit" class="btn btn-success pull-right" name="simpan" id="click-simpan">Simpan</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
          </div>

          <!-- form edit -->
          <div class="box box-info formedit" >
                <div class="box-header with-border">
                  <center><h3 class="box-title">Tambah User</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool click-hide" type="button" ><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" >
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Id User</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="Editid_user" name="Editid_user" placeholder="Id User">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="Editusername"  name="Editusername" placeholder="Username">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="Editpassword" name="Editpassword" placeholder="Password">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Level</label>
                      <div class="col-sm-8">
                        
                      <select class="form-control" id="Editlevel" name="Editlevel">
                        <option value="Admin">Admin</option>
                        <option value="Marketing">Marketing</option>
                      </select>
                      </div>
                    </div>
                    
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default click-hide" >Batal</button>
                    <button type="submit" class="btn btn-success pull-right" name="simpan" id="click-edit">Simpan</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
          </div>

          <!-- form table -->
          <div class="box ">
            <div class="box-header">
              <button class="btn btn-info click-tambah"><li class="fa fa-plus"></li> Tambah</button>
              <br><br>
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table  table-striped" >
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="showData">

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!--MODAL DELETE-->
          <form>
            <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id_user_delete" id="id_user_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <!--END MODAL DELETE-->
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
    
    $("#MsgUsername").hide();
    $("#MsgPassword").hide();
    $(".click-tambah").click(function(e){
      e.preventDefault()
      $(".formtambah").fadeIn(1000);
      kosong();
      
    })
    $(".click-hide").click(function(e){
      e.preventDefault()
      $(".formtambah").fadeOut(1000);
      kosong();
    })

    //crud

    showRecord(); //munculkan data
    
    
    //function showdata
    function showRecord(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('User/getAll')?>',
        async: true,
        dataType: 'JSON',
        success: function(data){
          var html = '';
          var i; 
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                      '<td>'+(i+1)+'</td>'+
                      '<td>'+data[i].username+'</td>'+
                      '<td>'+data[i].level+'</td>'+
                      '<td style="text-align:right;">'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_code="'+data[i].product_code+'" data-product_name="'+data[i].product_name+'" data-price="'+data[i].product_price+'">Edit</a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id_user="'+data[i].id_user+'">Delete</a>'+
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
      document.getElementById('username').value="";
      document.getElementById('password').value="";
    }
    


    //simpan
    $('#click-simpan').on('click',function(e){
      
      var id_user = $('#id_user').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var level = $('#level').val();
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('User/add') ?>',
        dataType: "JSON",
        data: {id_user:id_user, username:username, password:password, level:level},
        success: function(data){
          $('[name="id_user"]').val("");
          $('[name="username"]').val("");
          $('[name="password"]').val("");
          $('[name="level"]').val("");
          showRecord();
        }
      });
      
      $(".formtambah").fadeIn(1000);
      return false;
      
    });
    //edit

    //hapus
    
    //ambil datanya dulu
    $('#showData').on('click','.item_delete',function(){
      var id_user = $(this).data('id_user');
        
      $('#modalDelete').modal('show');
      $('[name="id_user_delete"]').val(id_user);
    });

    //delete record for db
    $('#btn_delete').on('click', function(){
      var id_user = $('#id_user_delete').val();
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('User/hapus')?>",
        dataType: "JSON",
        data:{id_user :id_user},
        success : function(data){
          $('[name="id_user_delete"]').val("");
          $('#modalDelete').modal('hide');
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
