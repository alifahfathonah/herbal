<!DOCTYPE html >
<html lang="en">
<head>
<title>Barang | JHP</title>
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
        <div class="col-xs-10 col-sm-offset-1"   >
          
          <!-- /.box -->
          <!-- form tambah -->
          
          <div class="box box-info formtambah" >
                <div class="box-header with-border">
                  <center><h3 class="box-title">Tambah Barang</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool click-hide" type="button" ><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" class="form-horizontal" method="post" id="formnya" >
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">ID Barang</label>
                      <div class="col-sm-8">
                      <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="ID Barang">
                      </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Nama Barang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control aturan" id="namabarang"  name="namabarang" placeholder="Nama Barang">
                        <div class="alert alert-danger" role="alert" id="Msgnamabarang"></div>
                      </div>
                    </div>


                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Harga</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="col-sm-2 control-label">Satuan</label>
                      <div class="col-sm-8">
                      <select class="form-control" id="satuan" name="satuan">
                        <option value="Ecer">Ecer</option>
                        <option value="Grosir">Grosir</option>
                      </select>
                      </div>
                    </div>
                    
                   <div class="form-group">
                      <label  class="col-sm-2 control-label">Stok</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok">
                      </div>
                    </div>
 
                    <div class="form-group">
                            <label class="col-sm-2 control-label" >Kategori</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="kategori" name="kategori">
                        
                                  <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Bubuk">Bubuk</option>
                         
                                </select>
                            </div>
                        </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Gambar</label>
                      <div class="col-sm-8">
                        <input class="form-control-file" type="file" name="gambar" id="gambar" />
                <div class="invalid-feedback">
                </div>
      
                        </div>
                    </div>

                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Deskripsi</label>
                      <div class="col-sm-8">
                      <textarea class="form-control <?php echo form_error('deskripsi') ? 'is-invalid':'' ?>"
                 name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea>
                </div>
                    </div>


                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default click-hide" >Batal</button>
                    <button type="submit" class="btn btn-success pull-right" name="simpan" id="click-simpan">Simpan</button>
                  </div>
                </form>
                  <!-- /.box-footer -->
          </div>

          <!-- form edit -->
           <!-- MODAL EDIT -->
          <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ID Barang</label>
                            <div class="col-md-10">
                              <input type="text" name="id_barang_edit" id="id_barang_edit" class="form-control" placeholder="ID Barang" readonly>
                            </div>
                        </div>
                
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Barang</label>
                            <div class="col-md-10">
                              <input type="text" name="namabarang_edit" id="namabarang_edit" class="form-control" placeholder="Nama Barang">
                            </div>
                        </div>
                
                          <div class="form-group row">
                            <label class="col-md-2 col-form-label">Harga</label>
                            <div class="col-md-10">
                              <input type="text" name="harga_edit" id="harga_edit" class="form-control" placeholder="Harga">
                            </div>
                        </div>
                        
                          <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Satuan</label>
                      <div class="col-sm-10">
                      <select class="form-control" id="satuan_edit" name="satuan_edit">
                        <option value="Ecer">Ecer</option>
                        <option value="Grosir">Grosir</option>
                      </select>
                      </div>
                    </div>
                   
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Stok</label>
                            <div class="col-md-10">
                              <input type="text" name="stok_edit" id="stok_edit" class="form-control" placeholder="Stok">
                            </div>
                        </div>
                  
                       

                      <div class="form-group row">
                      <label class="col-sm-2 control-label">Kategori</label>
                      <div class="col-sm-10">        
                      <select class="form-control" id="kategori_edit" name="kategori_edit">
                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Bubuk">Bubuk</option>
                      </select>
                      </div>
                    </div>
                  

                    <div class="form-group row">
                            <label class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                             <input class="form-group" type="file" 
                             name="gambar_edit" id="gambar_edit" placeholder="Gambar"></input>
                     
                            </div>
                        </div>
                                      
                      <div class="form-group row">
                            <label class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                              <textarea type="text" name="deskripsi_edit" id="deskripsi_edit" class="form-control" placeholder="Deskripsi"></textarea>
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
              <h3 class="box-title">Data Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table  table-striped" >
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Satuan</th>
                  <th>Stok</th>
                  <th>Kategori</th>
                  <th>Gambar</th>
                  <th>Deskripsi</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Apakah anda yakin menghapus data?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id_barang_delete" id="id_barang_delete" class="form-control">
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
    
    $("#Msgnamabarang").hide();
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

    //crud

    showRecord(); //munculkan data
    
    
    //function showdata
    function showRecord(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo site_url('Barang/getAll')?>',
        async: true,
        dataType: 'JSON',
        success: function(data){
          var html = '';
          var i; 
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                      '<td>'+(i+1)+'</td>'+
                      '<td>'+data[i].id_barang+'</td>'+
                      '<td>'+data[i].namabarang+'</td>'+
                      '<td>'+data[i].harga+'</td>'+
                      '<td>'+data[i].satuan+'</td>'+
                      '<td>'+data[i].stok+'</td>'+
                      '<td>'+data[i].kategori+'</td>'+
                       '<td><img src="upload/'+data[i].gambar+'" width="70px" height="70px"></td>'+
                       '<td>'+data[i].deskripsi+'</td>'+
                      '<td style="text-align:right;">'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id_barang="'+data[i].id_barang+'" data-namabarang="'+data[i].namabarang+'"data-harga="'+data[i].harga+'"data-satuan="'+data[i].satuan+'"data-stok="'+data[i].stok+'" data-kategori="'+data[i].kategori+'" data-gambar="'+data[i].gambar+'" data-deskripsi="'+data[i].deskripsi+'">Edit</a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id_barang="'+data[i].id_barang+'">Delete</a>'+
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
      document.getElementById('id_barang').value="";
      document.getElementById('namabarang').value="";
    }
    


    //simpan
    $('#click-simpan').on('click',function(e){
      
      var datanya = new FormData(document.getElementById("formnya"));
      $.ajax({
        type: "POST",
        url: '<?php echo site_url('barang/add'); ?>',
        mimeType:"multipart/form-data",
        dataType: "JSON",
        data: datanya,
        processData:false,
        contentType:false,
       cache:false,
        success: function(data){
          $('[name="id_barang"]').val("");
          $('[name="namabarang"]').val("");
          $('[name="harga"]').val("");
          $('[name="satuan"]').val("");
          $('[name="stok"]').val("");
          $('[name="kategori"]').val("");
          $('[name="gambar"]').val("");
          $('[name="deskripsi"]').val("");
          showRecord();
          window.alert("Data berhasil disimpan");
        },
        error: function(data){
          console.log(data);
        }
      });
      
      $(".formtambah").fadeIn(1000);
      return false;
      
    });
    //edit
    //ambil datanya dulu
    $('#showData').on('click','.item_edit', function(){
      kosong();
      var id_barang = $(this).data('id_barang');
      var namabarang = $(this).data('namabarang');
      var harga = $(this).data('harga');
      var satuan = $(this).data('satuan');
      var stok = $(this).data('stok');
      var kategori = $(this).data('kategori');
      var gambar= $(this).data('gambar');
      var deskripsi= $(this).data('deskripsi');
      
      $('#Modal_Edit').modal('show');
      $('[name="id_barang_edit"]').val(id_barang);
      $('[name="namabarang_edit"]').val(namabarang);
      $('[name="harga_edit"]').val(harga);
      $('[name="satuan_edit"]').val(satuan);
      $('[name="stok_edit"]').val(stok);
      $('[name="kategori_edit"]').val(kategori);
      $('[name="gambar_edit"]').val(gambar);
      $('[name="deskripsi_edit"]').val(deskripsi);   
    });

    //update record to database
    $('#btn_update').on('click',function(){
      var id_barang = $('#id_barang_edit').val();
      var namabarang = $('#namabarang_edit').val();
      var harga = $('#harga_edit').val();
      var satuan = $('#satuan_edit').val();
      var stok = $('#stok_edit').val();
      var kategori = $('#kategori_edit').val();
      var gambar = $('#gambar_edit').val();
      var deskripsi = $('#deskripsi_edit').val();
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('Barang/edit')?>",
          dataType : "JSON",
        data: {id_barang:id_barang, namabarang:namabarang, harga:harga, satuan:satuan, stok:stok, kategori:kategori, gambar:gambar, deskripsi:deskripsi},
          success: function(data){
              $('[name="id_barang_edit"]').val("");
              $('[name="namabarang_edit"]').val("");
              $('[name="harga_edit"]').val("");
              $('[name="satuan_edit"]').val("");
              $('[name="stok_edit"]').val("");
              $('[name="kategori_edit"]').val("");
              $('[name="gambar_edit"]').val("");
              $('[name="deskripsi_edit"]').val("");
              $('#Modal_Edit').modal('hide');
              showRecord();
          }
      });
      return false;
    });

    //hapus
    //ambil datanya dulu
    $('#showData').on('click','.item_delete',function(){
      var id_barang = $(this).data('id_barang');
        
      $('#modalDelete').modal('show');
      $('[name="id_barang_delete"]').val(id_barang);
    });

    //delete record for db
    $('#btn_delete').on('click', function(){
      var id_barang = $('#id_barang_delete').val();
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Barang/hapus')?>",
        dataType: "JSON",
        data:{id_barang :id_barang},
        success : function(data){
          $('[name="id_barang_delete"]').val("");
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
