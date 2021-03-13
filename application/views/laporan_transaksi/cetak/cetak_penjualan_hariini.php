<h4 style="text-align: center;">
  <br><h1><B>PT. Jatim Herbal Perkasa</B></h1>
  Pasar, Sengon, Kec. Mantingan, Kabupaten Ngawi, Jawa Timur 
  <br>
  Telp. 085883680093
</h4>
<h5 style="text-align: center;">
  <hr>
  <br><h4>LAPORAN PENJUALAN JAMU HARI INI</h4>
</h5>
<hr>
<br>
<table border-collapse: collapse class="tabel" align="center">
  <thead>
   <tr align="center"  bgcolor="yellow">
      <th>tanggal</th>
      <th>nofaktur</th>
      <th>penjual</th>
      <th>pelanggan</th>
      <th>total</th>
      <th>kategori</th>
  </tr> 
  </thead>
  <tbody>
  <?php $i =0 ;?>
    <?php foreach ($laporan_transaksi as $t): ?>
      <tr>
        <td>
          <?php echo $t->tangal?>
        </td>
        <td>
          <?php echo $t->nofaktur?>
        </td>
        <td>
          <?php echo $t->penjual?>
        </td>
        <td>
          <?php echo $t->pelanggan?>
        </td>
        <td  style="text-align:right">
          <?php echo $t->total; $i=$i+$t->total?>

        </td>
        <td>
          <?php echo $t->kategori?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  
  
</table>
<h1>Total Pendapatan </h1><h2><?php echo $i?></h2>

          
        