<?php
$site    = $this->konfigurasi_model->listing();
$id_user  = $this->session->userdata('id');
$user_aktif  = $this->user_model->detail($id_user);
$user_detail  = $this->user_model->detail($id_user);
$id_satker   = $user_detail['id_satker'];


// print_r($keluar);
?>

<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">', '</div>');

// Pesan sukses
if ($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
}

// pesan error
if ($this->session->flashdata('error')) {
	echo '<div class="alert alert-danger">';
	echo $this->session->flashdata('error');
	echo '</div>';
}
?>

<section class="content-header">
	<h1>
		<div class="alert alert-success">
			<p>Hai <strong><?php echo $user_aktif['nama_user'] . ' (' . $user_aktif['username'] . ')'; ?></strong>. Selamat datang di <strong><?php echo $site['namaweb'] . ' - ' . $site['tagline'] ?></strong></p>
		</div>
	</h1>
</section>
<hr>



<div class="panel panel-default">
	<!-- <div class="panel-heading">
		<h3 class="panel-title" >Cari List diapprove : </h3>
	</div> -->
	<div class="panel-body">


		<!-- <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/pj_klaster/pencarian_klast/' . $tmt . '/' . $sampai . '/' . $status . '/' . $id_klaster) ?>" enctype="multipart/form-data">

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
							<option value="belum">Belum validasi</option>
							<option value="acc_pj">Sudah divalidasi</option>
							<option value="tolak_pj">Di tolak</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
					</div>
				</div>
			<div class="box-footer">
		</form> -->


		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				<div class="nav-tabs-custom">

					<div class="box-body table-responsive no-padding">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>no</th>
									<th>Nama Barang</th>
									<th>Nama Peminta</th>
									<th>Level</th>
									<th>Tanggal Minta</th>
									<th>Status approval</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($pengadaan as $pengadaan) { ?>
									<tr>

										<td><?php echo $i ?></td>
										<td><?php echo $pengadaan['nama_barang'] ?></td>
										<td><?php echo $pengadaan['nama_request'] ?></td>
										<td><?php echo $pengadaan['level'] ?></td>
										<td><?php echo $pengadaan['tanggal_request'] ?></td>
										<td>
											<?php if ($pengadaan['status'] == "proses_pptk") { ?>
												<span class="label label-warning">Belum di approve</span>
											<?php } elseif ($pengadaan['status'] == "disetujui_pptk") { ?>
												<span class="label label-success">Disetujui</span>
											<?php } else { ?>
												<span class="label label-danger">Ditolak</span>
											<?php } ?>
										</td>
										<td>
											<button class="btn btn-info btn-sm lihat"
												data-id="<?php echo $pengadaan['id_request'] ?>"
												data-nama="<?php echo $pengadaan['nama_barang'] ?>">Detail</button>
											<a href="<?php echo base_url('admin/brg_masuk/tambah/' . $pengadaan['id_request']); ?>"
												target="_blank"
												class="btn btn-primary btn-sm proses <?php echo ($pengadaan['status'] == 'disetujui_pptk') ? '' : 'disabled'; ?>">
												Proses
											</a>
										</td>

									</tr>
									<?php $i++ ?>
								<?php } ?>
							</tbody>
						</table>
						<div class="modal fade" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="modalLihatLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content" style="border-radius:8px; box-shadow:0 5px 15px rgba(0,0,0,.5);">

									<!-- Form -->
									<form action="<?php echo base_url('admin/permintaan_pengadaan/aksi'); ?>" method="post">
										<div class="modal-header" style="background-color:#337ab7; color:#fff; border-bottom:none;">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="modalLihatLabel">
												<span class="glyphicon glyphicon-list-alt"></span> Detail Pengadaan
											</h4>
										</div>

										<div class="modal-body" style="padding:20px;">
											<!-- Hidden ID -->
											<input type="hidden" name="id_request" id="modalIdRequest">

											<div class="form-group">
												<label class="control-label"><strong>Nama Barang:</strong></label>
												<p id="modalNamaBarang"
													style="padding:10px; background:#f5f5f5; border:1px solid #ddd; border-radius:4px;"></p>
											</div>

											<div class="form-group">
												<label for="modalKeterangan" class="control-label"><strong>Keterangan</strong></label>
												<textarea name="keterangan" id="modalKeterangan" class="form-control" rows="4" placeholder="Masukkan keterangan jika ditolak..."></textarea>
											</div>
										</div>

										<div class="modal-footer">
											<?php if ($pengadaan['status'] == "disetujui_pptk") { ?>
												<button type="button" class="btn btn-success btn-sm" disabled>
													<span class="glyphicon glyphicon-ok"></span> Sudah Disetujui
												</button>
											<?php } else { ?>
												<button type="submit" name="action" value="setujui_pptk" class="btn btn-success btn-sm">
													<span class="glyphicon glyphicon-ok"></span> Setujui
												</button>
											<?php } ?>

											<button type="submit" name="action" value="tolak_pptk"
												class="btn btn-danger btn-sm"
												<?php echo ($pengadaan['status'] == "disetujui_pptk") ? 'disabled' : ''; ?>>
												<span class="glyphicon glyphicon-remove"></span> Tolak
											</button>
										</div>

									</form>
								</div>
							</div>
						</div>



						<script>
							$(document).ready(function() {
								$('.lihat').click(function() {
									var id = $(this).data('id');
									var nama = $(this).data('nama');
									$('#modalIdRequest').val(id);
									$('#modalNamaBarang').text(nama);
									$('#modalLihat').modal('show');

									// simpan id untuk aksi setujui/tolak
									$('#modalSetujui, #modalTolak').data('id', id);
								});

								$('#modalSetujui').click(function() {
									var id = $(this).data('id');
									var keterangan = $('#modalKeterangan').val();

									// lakukan ajax atau submit ke controller setujui
									console.log('Setujui id:', id, 'Keterangan:', keterangan);
								});

								$('#modalTolak').click(function() {
									var id = $(this).data('id');
									var keterangan = $('#modalKeterangan').val();

									// lakukan ajax atau submit ke controller tolak
									console.log('Tolak id:', id, 'Keterangan:', keterangan);
								});
							});
						</script>

						<script>
							$(function() {

								$(".tanggal_max").datepicker({
									// inline: true,
									changeYear: true,
									changeMonth: true,
									yearRange: "2023:<?php echo date('Y') ?>",
									dateFormat: "yy-mm-dd",
								});
							});
						</script>