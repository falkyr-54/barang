<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/unit/edit/'.$unit['id_unit']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">
			<div class="form-group">
				<div class="form-group">
					<label>unit</label>
					<input type="text" name="unit" class="form-control" value="<?php echo $unit['unit'] ?>" placeholder="isi kode barang" required>
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="Ubah">
			<input type="reset" name="reset" class="btn btn-primary" value="Reset">
		</div>
	</div>

</form>