<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/tempat/edit/'.$tempat['id_tempat']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">
			<div class="form-group">
				<label>Wilayah</label>
				<select name="wilayah" class="form-control">
					<option value="">-Pilih Kelurahan-</option>
					<option value="Pekayon" <?php if ($tempat['wilayah']=="Pekayon"){echo "selected";} ?>>Pekayon</option>
					<option value="Kalisari" <?php if ($tempat['wilayah']=="Kalisari"){echo "selected";} ?>>Kalisari</option>
					<option value="Baru" <?php if ($tempat['wilayah']=="Baru"){echo "selected";} ?>>Baru</option>
					<option value="Cijantung" <?php if ($tempat['wilayah']=="Cijantung"){echo "selected";} ?>>Cijantung</option>
					<option value="Gedong" <?php if ($tempat['wilayah']=="Gedong"){echo "selected";} ?>>Gedong</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="form-group">
				<label>Jenis Tempat</label>
				<select name="jenis_tempat" class="form-control">
					<option value="">-Pilih Jenis Tempat-</option>
					<option value="Luar Gedung"<?php if ($tempat['jenis_tempat']=="Luar Gedung") {
						echo "selected";
					} ?>>Luar Gedung</option>
					<option value="Dalam Gedung"<?php if ($tempat['jenis_tempat']=="Dalam Gedung") {
						echo "selected";
					} ?>>Dalam Gedung</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label>Nama Tempat</label>
			<input type="text" name="tempat" class="form-control" value="<?php echo $tempat['tempat'] ?>" placeholder="isi nama tempat" required>
		</div>

	</div>

	<div class="col-md-12">
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="Ubah">
			<input type="reset" name="reset" class="btn btn-primary" value="Reset">
		</div>
	</div>

</form>