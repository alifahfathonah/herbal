<!DOCTYPE html>
<html>
<head>
  <title>
    
  </title>
  
</head>
<body>

    <div>
      
      <div >
        <h4 >
          <h1><B>PT. Jatim Herbal Perkasa</B></h1>
          Pasar, Sengon, Kec. Mantingan, Kabupaten Ngawi, Jawa Timur 
          <br>
          Telp. 085883680093
        </h4>
        <br>
        <br>
        <h5><B>
          <?php foreach ($print as $t): ?> nofaktur : <?php echo $t->nofaktur?> <?php endforeach; ?>
        </B></h5>
        <h5><B>
          <?php foreach ($print as $t): ?> Kasir : <?php echo $t->username?> <?php endforeach; ?>
        </B></h5>
      
      </div>
    </div>

    <div >

      <div class="col-sm-2 ">
        <br>
          <h4 align="right">
          <h5>Ngawi, <?php $tgl=date('d-m-Y'); echo $tgl;?></h5>
          <h5 align="center">Kepada Yth.</h5>
          <?php foreach ($print as $t): ?>  <?php echo $t->nama?> <?php endforeach; ?>
          <br> 
          </h4>
          
      </div>

      <div > 
      <div >
          <table width="500px" border="1" border-collapse: collapse  align="center">
            <thead>
             <tr align="center" >
                <th>nama barang</th>
                <th>jumlah</th>
                <th>harga</th>
                <th>subtotal</th>
            </tr> 
            </thead>

            <tbody>
            
              <?php foreach ($print as $t): ?>
                <tr>
                  <td>
                  <?php echo $t->namabarang?>
                  </td>
                     <td>
                  <?php echo $t->jumlah;
                  $subtotal = $t->jumlah * $t->harga;
                  ?>
                  </td>
               
                  <td>
                  <?php echo $t->harga?>
                  </td>    
                  <td>
                  <?php echo $subtotal?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr align="center" >
                  <th colspan="2"></th>
                  <th>total</th>
                  <th><?php echo $t->harga ?></th>
              </tr> 
            </tfoot>

          </table>
           
          <div >
           <div >
            <br>
            <h4 align="right">
            <h5>Tanda Terima, </h5>
            </h4>
            </div>

          </div>

    <div class="form-group">

      <div class="col-sm-5 ">
        <h4 align="right">
        <h5 align="right" >Hormat Kami, </h5>
        </h4>
      </div>

    </div>
      </div>
    </div>
    </div>
</body>
<script>
		window.print();
    document.location.href = "http://localhost/herbal/Transaksi"; 
	</script>
</html>

