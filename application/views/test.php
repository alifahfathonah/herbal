     <div class="box box-info formtambah" >
                <div class="box-header with-border">
                  <center><h3 class="box-title">Tambah Barang</h3></center>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool click-hide" type="button" ><i class="fa fa-remove"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="<?= site_url('barang/add'); ?>" enctype="multipart/form-data" class="form-horizontal" >
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
                  <?php echo form_error('gambar') ?>
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