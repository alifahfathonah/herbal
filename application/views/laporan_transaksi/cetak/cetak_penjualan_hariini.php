<h4 style="text-align: center;">
  PrimaPs
  <br>
  JL. Raya Sukowono Jember
</h4>
<h5 style="text-align: center;">
  <u>Cetak Penjualan Hariini</u><br>
</h5>
<table border="1px" class="tabel" align="center">
  <thead>
   <tr>
      <th>tanggal</th>
      <th>nofaktur</th>
      <th>penjual</th>
      <th>pelanggan</th>
      <th>total</th>
      <th>kategori</th>
  </tr> 
  </thead>
  <tbody>
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
        <td>
          <?php echo $t->total?>
        </td>
        <td>
          <?php echo $t->kategori?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>