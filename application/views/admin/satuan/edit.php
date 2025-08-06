<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/satuan/edit/'.$satuan['id_satuan']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">
			<div class="form-group">
				<div class="form-group">
					<label>Satuan</label>
					<input type="text" name="satuan" class="form-control" value="<?php echo $satuan['satuan'] ?>" placeholder="isi kode barang" required>
				</div>
			</div>

			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" name="keterangan" class="form-control" value="<?php echo $satuan['keterangan'] ?>" placeholder="isi keterangan" required>
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