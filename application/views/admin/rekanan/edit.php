<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/rekanan/edit/'.$rekanan['id_rekanan']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">
			<div class="form-group">
				<div class="form-group">
					<label>Nama Rekanan</label>
					<input type="text" name="nama_rekanan" class="form-control" value="<?php echo $rekanan['nama_rekanan'] ?>" placeholder="isi kode barang" required>
				</div>
			</div>

			<div class="form-group">
				<label>Alamat</label>
				<input type="text" name="alamat" class="form-control" value="<?php echo $rekanan['alamat'] ?>" placeholder="misal: Jl.RayaBogor No.15" required>
			</div>

			<div class="form-group">
				<label>Telepon</label>
				<input type="text" name="telepon" class="form-control" value="<?php echo $rekanan['telepon'] ?>" placeholder="misal: 0877xxxxx" required>
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