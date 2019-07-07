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
          <!-- Modal ambil -->
          <form>
            <div class="modal fade" id="Modal_Ambil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label class="col-md-2 col-form-label"> Kode Pemesanan</label>
                        <div class="col-md-5">
                          <input type="text" name="kode_pemesanan" id="kode_pemesanan" class="form-control"  >
                          <input type="text" name="kode_pemesanan2" id="kode_pemesanan2" class="form-control"  readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"> Kode Transaksin</label>
                        <div class="col-md-5">
                          <input type="text" name="nofaktur" id="nofaktur" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Data Pemesan</label>
                        <div class="col-md-2">
                        Nama<input type="text" class="form-control"  name="nama" placeholder="" id="nama">
                        
                        Alamat<input type="text" class="form-control"  name="alamat" placeholder="" id="alamat">
                        </div>
                        <div class="col-md-2">
                        Total<input type="text" class="form-control"  name="total" placeholder="" id="total">
                        Sisa<input type="text" class="form-control"  name="sisa" placeholder="" id="sisa">
                        </div>
                        <div class="col-md-2">
                        Dp<input type="text" class="form-control"  name="bayar" placeholder="" id="bayar">
                        <input type="hidden" class="form-control"  name="bayarA" placeholder="" id="bayarA">
                        <input type="hidden" class="form-control"  name="sisaA" placeholder="" id="sisaA">
                        <input type="hidden" class="form-control"  name="kategori" placeholder="" id="kategori">
                        </div>
                        <div class="col-md-2">
                        BayarLagi<input type="text" class="form-control"  name="bayarL" placeholder="" id="bayarL">
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-sm-offset-5"> 
                        <label  class="control-label">Kredit</label><input type="checkbox" class="minimal"  id="kondisi" name="kondisi" >  
                        </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_ambil" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- / Modal ambil -->
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
              <table id="ini" class="table  table-striped" >
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
                      '<td style="text-align:left;">'+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_belanja" data-nofaktur="'+data[i].kode_pemesanan+'" >Detail</a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-info btn-sm item_ambil" data-kode_pemesanan="'+data[i].kode_pemesanan+'" data-alamat="'+data[i].alamat+'" data-pemesan="'+data[i].pemesan+'" data-total="'+data[i].total+'" data-bayar="'+data[i].bayar+'">Ambil</a>'+
                      '</td>'+
                    '</tr>';
                }
          $('#showData').html(html);
          $('#ini').dataTable({
            'searching'   : true,
            'ordering'    : false,
          })
        }
      });
    }
    //function setCode
    function setCode() {
        var nofaktur = $('#nofaktur').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Transaksi/setCode') ?>",
            dataType: "JSON",
            data: {
                nofaktur: nofaktur
            },
            success: function(data) {
                $('[name="nofaktur"]').val(data);
                

                
            }
        });
        return false;
    }

    //hitung

    $("#bayarL").keyup(function(){
      var sisa = document.getElementById('sisaA').value;
      var bayar = document.getElementById('bayarA').value;
      
      var thisVal = $(this).val()
      var result = parseInt(sisa) + parseInt(thisVal);
      var resul = parseInt(bayar) + parseInt(thisVal);
      

      if(thisVal != ""){
            $("#sisa").val(result);
            $("#bayar").val(resul);
        }else{
            $("#sisa").val(sisa);
            $("#bayar").val(bayar);
        }
    })
    //hitung
    function hitung() {
        var bayar = document.getElementById('bayar').value;
        var bayarL = document.getElementById('bayarL').value;

        
        if (bayarL=="") {
        document.getElementById('sisa').value = "";
        }else{
        document.getElementById('sisa').value = result;
        if (result == 0) {
            document.getElementById('sisa').value = "";
        }  
        }
    }

    //ambil datanya dulu
    $('#showData').on('click','.item_ambil', function(){
      var kode_pemesanan = $(this).data('kode_pemesanan');
      var nofaktur = $(this).data('nofaktur');
      var alamat = $(this).data('alamat');
      var pemesan = $(this).data('pemesan');
      var bayar = $(this).data('bayar');
      var total = $(this).data('total');

      
      $('#Modal_Ambil').modal('show');
      $('[name="alamat"]').val(alamat);
      $('[name="nama"]').val(pemesan);
      $('[name="total"]').val(total);
      $('[name="bayar"]').val(bayar);
      $('[name="bayarA"]').val(bayar);
      $('[name="kode_pemesanan"]').val(kode_pemesanan);
      $('[name="kode_pemesanan2"]').val(kode_pemesanan);
      $('[name="bayarL"]').val("");
      setCode();
      $("#kondisi").prop("checked", false);
      var result = parseInt(bayar) - parseInt(total);
      $('[name="sisaA"]').val(result);
      $('[name="sisa"]').val(result);
      

    });

    //rapcale
    //function replace at
    String.prototype.replaceAt=function(index, replacement) {
    return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
    }

    //kondisi
    $('#kondisi').click(function () {
        if ($(this).is(":checked")) {
            var nofaktur = $('#nofaktur').val();
            var res = "B";
            var b= "N";
            var posisi =27;
            var result = [nofaktur.slice(0,posisi), b, nofaktur.slice(posisi)].join('');
            var txt = result.replaceAt(26,res);
            $('#nofaktur').val(txt);
            $('#kategori').val("kredit");
        } else {
            setCode();
        }
    });
    //ambil
    
    //simpan
    $('#btn_ambil').on('click',function(e){
      var sisa = $('#sisa').val();
      var kategori = $('#kategori').val();
      var bayar = $('#nama').val();
      var namabarang = $('#namabarang').val();
      var total = $('#total').val();
      var bayar = $('#bayar').val();
      var alamat = $('#alamat').val();
      var nofaktu = $('#nofaktur').val();
      var res = alamat.substring(0, 4);
      var kode_pemesanan = nofaktu.replaceAt(12,res);
      var kode_pemesanan2 = $('#kode_pemesanan2').val();
      // $('#nofaktur').val(txt);

      if(kategori == "kredit"){
        $.ajax({
          type : "POST",
          url  : "<?php echo site_url('Laporan_Pemesanan/edit')?>",
          dataType : "JSON",
          data : {kode_pemesanan:kode_pemesanan , bayar:bayar, kode_pemesanan2:kode_pemesanan2},
          success: function(data){
              $('#Modal_Ambil').modal('hide');
              
              showRecord();
          }
        });
      }else{
        if(parseInt(sisa) >= 0){
          $.ajax({
          type : "POST",
          url  : "<?php echo site_url('Laporan_Pemesanan/edit')?>",
          dataType : "JSON",
          data : {kode_pemesanan:kode_pemesanan , bayar:bayar, kode_pemesanan2:kode_pemesanan2},
          success: function(data){
              $('#Modal_Ambil').modal('hide');
              showRecord();
          }
          });
        }else{
          alert("cek bayar jika bukan credit");
        }
      }
      
      
      
    });
</script>
<!-- Script -->

</body>
</html>
