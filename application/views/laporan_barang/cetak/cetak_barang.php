<h4 style="text-align: center;">
  Jatim Herbal Perkasa
  <br>
  JL. Raya Sukowono Jember
</h4>
<h5 style="text-align: center;">
  <u>Cetak Penjualan Kategori Barang</u><br>
</h5>
<table border="1px" class="tabel" align="center">
  <thead>
    <tr>
      <th>Nama Barang</th>
      <th>Satuan</th>
      <th>Harga</th>
      <th>Stok</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($laporan_barang as $t) : ?>
      <tr>
        <td>
          <?php echo $t->namabarang ?>
        </td>
        <td>
          <?php echo $t->satuan ?>
        </td>
        <td>
          <?php echo $t->harga ?>
        </td>
        <td>
          <?php echo $t->stok ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>