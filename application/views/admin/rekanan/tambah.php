<!-- Button trigger modal -->
<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Tambah Rekanan
</button></p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Rekanan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="<?php echo base_url('admin/rekanan') ?>" method="post">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-group">
                  <label>Nama Rekanan</label>
                  <input type="text" name="nama_rekanan" class="form-control" value="<?php echo set_value('nama_rekanan') ?>" placeholder="" required>
                </div>
              </div>

              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo set_value('alamat') ?>" placeholder="misal:jl.raya bogor" required>
              </div>

              <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?php echo set_value('telepon') ?>" placeholder="misal:0877xxxxx" required>
              </div>

            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                <input type="reset" name="reset" class="btn btn-primary" value="Reset">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>