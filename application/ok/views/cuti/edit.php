<style>
.clsDatePicker {
    z-index: 100000;
}
.datepicker{
z-index:1151;
}
</style>
<?php 
//Error
echo validation_errors('<div class="alert alert-warning">','</div>');

echo form_open(base_url('cuti/edit/'.$cuti->id_pers_cuti_hist)); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
  <tr>
    <td>Jenis cuti</td>
    <td><span class="form-group">
      <select name="jencuti" class="form-control">
        <?php foreach($jencuti as $jencuti) { ?>
        <option value="<?php echo $jencuti->jencuti ?>" <?php if($cuti->jencuti==$jencuti->jencuti) { echo "selected"; } ?>> <?php echo $jencuti->jencuti ?> - <?php echo $jencuti->keterangan ?> </option>
        <?php } ?>
      </select>
    </span></td>
    <td><span class="form-group">
      <label>Nomor SK</label>
    </span></td>
    <td><span class="form-group">
      <input type="text" name="nosk" class="form-control" value="<?php echo $cuti->nosk ?>" placeholder="Nomor SK">
    </span></td>
  </tr>
  <tr>
    <td><span class="form-group">
      <label>Pejabat Penandatangan SK</label>
    </span></td>
    <td><span class="form-group">
      <select name="pejtt" class="form-control">
        <option value="">Pilih PEJTT</option>
        <?php foreach($pejtt as $pejtt) { ?>
        <option value="<?php echo $pejtt->kdpejtt ?>" <?php if($pejtt->kdpejtt==$cuti->pejtt) { echo "selected"; } ?>> <?php echo $pejtt->kdpejtt.' - '.$pejtt->napejtt ?> </option>
        <?php } ?>
      </select>
    </span></td>
    <td><span class="form-group">
      <label>Tanggal mulai cuti</label>
    </span></td>
    <td><span class="form-group">
      <input type="text" name="tmt" class="form-control datepicker" value="<?php echo $cuti->tmt ?>" placeholder="YYYY-MM-DD">
    </span></td>
  </tr>
  <tr>
    <td><span class="form-group">
      <label>Tanggal SK</label>
    </span></td>
    <td><span class="form-group">
      <input type="text" name="tgsk" class="form-control datepicker" value="<?php echo $cuti->tgsk ?>" placeholder="YYYY-MM-DD">
    </span></td>
    <td><span class="form-group">
      <label>Tanggal selesai cuti</label>
    </span></td>
    <td><span class="form-group">
      <input type="text" name="tgakhir" class="form-control datepicker" value="<?php echo $cuti->tgakhir ?>" placeholder="YYYY-MM-DD">
    </span></td>
  </tr>
</table>


<div class="col-md-12 text-center">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Simpan Data">
<input type="reset" name="reset" class="btn btn-primary btn-lg" value="Reset">
</div>
</div>
<div class="clearfix"></div>
<?php echo form_close() ?>

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
var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$confModal.on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});

$confModal.modal({ backdrop : false });
</script>