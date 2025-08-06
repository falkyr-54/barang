<!-- Button trigger modal -->
<p><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus"></i> Tambah satuan
</button></p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah satuan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="<?php echo base_url('admin/satuan') ?>" method="post">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form-control" value="<?php echo set_value('satuan') ?>" placeholder="isi Satuan" required>
                </div>
              </div>

              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="<?php echo set_value('keterangan') ?>" placeholder="isi nama satuan" required>
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