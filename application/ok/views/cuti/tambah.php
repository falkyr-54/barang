<!-- Trigger the modal with a button -->
<p>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
<i class="fa fa-plus"></i> Tambah
</button>
</p>
<hr>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Cuti</h4>
      </div>
      <div class="modal-body">

<?php echo form_open(base_url('cuti')); ?>

<div class="col-md-6">
<div class="form-group">
<label>Jenis cuti</label>
<select name="jencuti" class="form-control">
	<?php foreach($jencuti as $jencuti) { ?>
    <option value="<?php echo $jencuti->jencuti ?>">
    <?php echo $jencuti->jencuti ?> - <?php echo $jencuti->keterangan ?>
    </option>
    <?php } ?>
</select>
</div>

<div class="form-group">
<label>Pejabat Penandatangan SK</label>
<select name="pejtt" class="form-control">
	<option value="">Pilih PEJTT</option>
    <?php foreach($pejtt as $pejtt) { ?>
    <option value="<?php echo $pejtt->kdpejtt ?>">
    <?php echo $pejtt->kdpejtt.' - '.$pejtt->napejtt ?>
    </option>
    <?php } ?> 
</select>
</div>

<div class="form-group">
<label>Tanggal SK</label>
<input type="text" name="tgsk" class="form-control datepicker" value="<?php echo set_value('tgsk') ?>" placeholder="YYYY-MM-DD">
</div>
</div>

<div class="col-md-6">

<div class="form-group">
<label>Nomor SK</label>
<input type="text" name="nosk" class="form-control" value="<?php echo set_value('nosk') ?>" placeholder="Nomor SK">
</div>

<div class="form-group">
<label>Tanggal mulai cuti</label>
<input type="text" name="tmt" class="form-control datepicker" value="<?php echo set_value('tmt') ?>" placeholder="YYYY-MM-DD">
</div>

<div class="form-group">
<label>Tanggal selesai cuti</label>
<input type="text" name="tgakhir" class="form-control datepicker" value="<?php echo set_value('tgakhir') ?>" placeholder="YYYY-MM-DD">
</div>
</div>

<div class="col-md-12 text-center">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Simpan Data">
<input type="reset" name="reset" class="btn btn-primary btn-lg" value="Reset">
</div>
</div>
<div class="clearfix"></div>
<?php echo form_close() ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
// Datepicker
<?php 
date_default_timezone_set('Asia/Jakarta');
$dahulu	= date('Y')-100;
?>
$( ".datepicker" ).datepicker({
	inline: true,
	changeYear: true,
	changeMonth:true,
	dateFormat: "yy-mm-dd",
	yearRange: "<?php echo $dahulu ?>:<?php echo date('Y') ?>"
});
</script>