<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/jenis_brg/edit/'.$jenis['id_jenis']) ?>" method="post">

	<div class="col-md-6">

		<div class="form-group">
			<div class="form-group">
				<div class="form-group">
					<label>Kode Jenis Barang</label>
					<input type="text" name="kode_jns_brg" class="form-control" value="<?php echo $jenis['kode_jns_brg'] ?>" placeholder="isi kode barang" required>
				</div>
			</div>

			<div class="form-group">
				<label>Nama Jenis Barang</label>
				<input type="text" name="nama_jenis" class="form-control" value="<?php echo $jenis['nama_jenis'] ?>" placeholder="isi nama jenis barang" required>
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