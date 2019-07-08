<center>
<h4 style="text-align: center;">
  <br><h1><B>PT. Jatim Herbal Perkasa</B></h1>
  Pasar, Sengon, Kec. Mantingan, Kabupaten Ngawi, Jawa Timur 
  <br>
  Telp. 085883680093
</h4>


<?php foreach ($print as $t): ?>
nofaktur :
<?php echo $t->nofaktur?>
<?php endforeach; ?>
<br>
<table border="1" border-collapse: collapse class="tabel" align="center">
  <thead>
   <tr align="center" >
      <th>tanggal</th>
      <th>nofaktur</th>
      <th>penjual</th>
      <th>pelanggan</th>
      <th>total</th>
      <th>kategori</th>
  </tr> 
  </thead>
  <tbody>
    <?php foreach ($print as $t): ?>
      <tr>
        <td>
        <?php echo $t->id_barang?>
        </td>
        <td>
        <?php echo $t->jumlah?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>
</center>
<script>
</script>