<!DOCTYPE html >
<html lang="en">
<head>
<title>Pelanggan | JHP</title>
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
                  <center><h3 class="box-title">Tambah Pelanggan</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool click-hide" type="button" ><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" >
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Id Pelanggan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" placeholder="Id Pelanggan">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Nama</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="nama"  name="nama" placeholder="Nama">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">No HP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="nohp"  name="nohp" placeholder="nohp">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="alamat"  name="alamat" placeholder="Alamat">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="email"  name="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="password"  name="password" placeholder="Password">
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
           <!-- MODAL EDIT -->
          <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Id Pelanggan</label>
                            <div class="col-md-10">
                              <input type="text" name="id_pelanggan_edit" id="id_pelanggan_edit" class="form-control" placeholder="Id Pelanggan" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                              <input type="text" name="nama_edit" id="nama_edit" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No Hp</label>
                            <div class="col-md-10">
                              <input type="text" name="nohp_edit" id="nohp_edit" class="form-control" placeholder="No Hp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Alamat</label>
                            <div class="col-md-10">
                              <input type="text" name="alamat_edit" id="alamat_edit" class="form-control" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                              <input type="text" name="email_edit" id="email_edit" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-10">
                              <input type="password" name="password_edit" id="password_edit" class="form-control" placeholder="Price">
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
              <button class="btn btn-info click-tambah"><li class="fa fa-plus"></li> Tambah</button>
              <br><br>
              <h3 class="box-title">Data Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table  table-striped" >
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No Hp</th>
                  <th>Alamat</th>
                  <th>Email</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id_pelanggan_delete" id="id_pelanggan_delete" class="form-control">
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
    
    $("#MsgNama").hide();
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
        url: '<?php echo site_url('Pelanggan/getAll')?>',
        async: true,
        dataType: 'JSON',
        success: function(data){
          var html = '';
          var i; 
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                      '<td>'+(i+1)+'</td>'+
                      '<td>'+data[i].nama+'</td>'+
                      '<td>'+data[i].nohp+'</td>'+
                      '<td>'+data[i].alamat+'</td>'+
                      '<td>'+data[i].email+'</td>'+
                      '<td style="text-align:right;">'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id_pelanggan="'+data[i].id_pelanggan+'" data-nama="'+data[i].nama+'" data-nohp="'+data[i].nohp+'" data-alamat="'+data[i].alamat+'" data-email="'+data[i].email+'" data-password="'+data[i].password+'">Edit</a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id_pelanggan="'+data[i].id_pelanggan+'">Delete</a>'+
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
      document.getElementById('nama').value="";
      document.getElementById('password').value="";
    }
    


    //simpan
    $('#click-simpan').on('click',function(e){
      
      var id_pelanggan = $('#id_pelanggan').val();
      var nama = $('#nama').val();
      var nohp = $('#nohp').val();
      var alamat = $('#alamat').val();
      var email = $('#email').val();
      var password = $('#password').val();
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('Pelanggan/add') ?>',
        dataType: "JSON",
        data: {id_pelanggan:id_pelanggan, nama:nama, nohp:nohp, alamat:alamat, email:email, password:password},
        success: function(data){
          $('[name="id_pelanggan"]').val("");
          $('[name="nama"]').val("");
          $('[name="nohp"]').val("");
          $('[name="alamat"]').val("");
          $('[name="email"]').val("");
          $('[name="password"]').val("");
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
      var id_pelanggan = $(this).data('id_pelanggan');
      var nama = $(this).data('nama');
      var nohp = $(this).data('nohp');
      var alamat = $(this).data('alamat');
      var email = $(this).data('email');
      var password = $(this).data('password');
      
      $('#Modal_Edit').modal('show');
      $('[name="id_pelanggan_edit"]').val(id_pelanggan);
      $('[name="nama_edit"]').val(nama);
      $('[name="nohp_edit"]').val(nohp);
      $('[name="alamat_edit"]').val(alamat);
      $('[name="email_edit"]').val(email);
      $('[name="password_edit"]').val(password);
    });

     //update record to database
    $('#btn_update').on('click',function(){
      var id_pelanggan = $('#id_pelanggan_edit').val();
      var nama = $('#nama_edit').val();
      var nohp = $('#nohp_edit').val();
      var alamat = $('#alamat_edit').val();
      var email = $('#email_edit').val();
      var password = $('#password_edit').val();
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('Pelanggan/edit')?>",
          dataType : "JSON",
          data : {id_pelanggan:id_pelanggan, nama:nama, nohp:nohp, alamat:alamat, email:email, password:password},
          success: function(data){
              $('[name="id_pelanggan_edit"]').val("");
              $('[name="nama_edit"]').val("");
              $('[name="nohp_edit"]').val("");
              $('[name="alamat_edit"]').val("");
              $('[name="email_edit"]').val("");
              $('[name="password_edit"]').val("");
              $('#Modal_Edit').modal('hide');
              showRecord();
          }
      });
      return false;
    });
    //hapus
    //ambil datanya dulu
    $('#showData').on('click','.item_delete',function(){
      var id_pelanggan = $(this).data('id_pelanggan');
        
      $('#modalDelete').modal('show');
      $('[name="id_pelanggan_delete"]').val(id_pelanggan);
    });

    //delete record for db
    $('#btn_delete').on('click', function(){
      var id_pelanggan = $('#id_pelanggan_delete').val();
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Pelanggan/hapus')?>",
        dataType: "JSON",
        data:{id_pelanggan :id_pelanggan},
        success : function(data){
          $('[name="id_pelanggan_delete"]').val("");
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
