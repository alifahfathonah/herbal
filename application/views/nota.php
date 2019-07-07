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
    <?php foreach ($print as $t): ?>
      <tr>
        <td>
          <?php echo $t->nofaktur?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>