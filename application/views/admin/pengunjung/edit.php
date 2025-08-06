<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/pengunjung/edit/'.$pengunjung['id_pengunjung']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">


			<div class="form-group">
				<label>Nama pengunjung</label>
				<input type="text" name="jenis" class="form-control" value="<?php echo $pengunjung['jenis'] ?>" placeholder="Ubah Nama" required>
			</div>   

			<div class="form-group">
				<label>Singkatan</label>
				<input type="text" name="singkatan" class="form-control" value="<?php echo $pengunjung['singkatan'] ?>" placeholder="Ubah singkatan" required>
			</div>    

		</div>

		<div class="col-md-12">
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				<input type="reset" name="reset" class="btn btn-primary" value="Reset">
			</div>
		</div>

	</form>