<?php
$site    = $this->konfigurasi_model->listing();
$id_user  = $this->session->userdata('id');
$user_aktif  = $this->user_model->detail($id_user);
$user_detail  = $this->user_model->detail($id_user);
$id_satker   = $user_detail['id_satker'];
?>



<section class="content-header">
	<h1>
		<div class="alert alert-success">
			<p>Hai <strong><?php echo $user_aktif['nama_user'] . ' (' . $user_aktif['username'] . ')'; ?></strong>. Selamat datang di <strong><?php echo $site['namaweb'] . ' - ' . $site['tagline'] ?></strong></p>
		</div>
	</h1>
</section>
<hr>

<?php
          // Pesan notifikasi
echo validation_errors('<div class="alert alert-warning">','</div>');

          // Pesan sukses
if($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success" style="width: 500px;">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
}else if ($this->session->flashdata('gagal')) {
	echo '<div class="alert alert-warning" style="width: 500px;">';
	echo $this->session->flashdata('gagal');
	echo '</div>';
}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title" >Cari List diapprove : </h3>
	</div>
	<div class="panel-body">


		<form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/admin_barang/pencarian/'.$tmt.'/'.$sampai.'/'.$status) ?>" enctype="multipart/form-data">

			<div class="box-body">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
					<div class="col-sm-4">
						<input type="text" class="form-control tanggal_max" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Sampai Tanggal</label>
					<div class="col-sm-4">
						<input type="text" class="form-control tanggal_max" placeholder="YYYY-MM-DD" name="sampai" autocomplete="off">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword4" class="col-sm-2 control-label">Status validasi</label>
					<div class="col-sm-4">
						<select name="status_validasi" class="form-control">
							<option value="">-Pilih Status-</option>
							<option value="0">Semua</option>
							<option value="acc_pj">Sudah divalidasi PJ</option>
							<option value="tolak_pj">Di tolak PJ</option>
							<option value="acc_p">Sudah validasi Pengurus barang</option>
							<option value="tolak_p">Di tolak Pengurus barang</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
						<input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer">
			</div><!-- /.box-footer -->
		</form>


		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				<div class="nav-tabs-custom">

					<div class="box-body table-responsive no-padding">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>no</th>
									<th>nama pegawai</th>
									<th>unit</th>
									<th>nama barang</th>
									<th>jumlah permintaan</th>
									<th>tanggal permintaan</th>
									<th>Status approval</th>
									<!-- <th>Aksi</th> -->
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach ($klast as $klast) { ?>
									<tr>

										<td><?php echo $i ?></td>
										<td><?php echo $klast['nama_lengkap'] ?></td>
										<td><?php echo $klast['unit'] ?></td>
										<td><?php echo $klast['nama_barang'] ?></td>
										<td><?php echo $klast['jumlah_keluar'] ?></td>
										<td><?php echo $klast['tanggal_minta'] ?></td>
										<td>
											<?php if ($klast['status_validasi']=="acc_p"||$klast['status_validasi']=="tolak_p"||$klast['status_validasi']=="tolak_pj"){ ?>
												
												<?php if($klast['status_validasi']=="tolak_pj"){ ?>
													<i class="fa fa-calendar-times-o btn btn-danger btn-md" disabled> di tolak PJ</i>
												<?php }elseif($klast['status_validasi']=="acc_p"){ ?>
													<i class="fa fa-calendar-check-o btn btn-info btn-md" disabled> acc pengurus barang</i>
												<?php }elseif($klast['status_validasi']=="tolak_p"){ ?>
													<i class="fa fa-calendar-check-o btn btn-danger btn-md" disabled> di tolak pengurus barang</i>
													<?php } ?></i>

												<?php }else{ ?>
													<?php
													include('approvall.php');
													?>
												<?php } ?>
											</td>
										</tr>
										<?php $i++ ?>
									<?php } ?>
								</tbody>
							</table>


							<script>
								$(function() {

									$( ".tanggal_max" ).datepicker({
      // inline: true,
      changeYear: true,
      changeMonth: true,
      yearRange: "2023:<?php echo date('Y') ?>",
      dateFormat: "yy-mm-dd",
  });
								});
							</script>



