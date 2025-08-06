<?php
// Tambah baru
include('tambah.php');

// Validasi
echo validation_errors('<div class="alert alert-warning">','</div>');

// Notifikasi
if($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
}

// Error upload file
if(isset($error)) {
	echo '<div class="alert alert-success">';
	echo $error;
	echo '</div>';
}
?>

<table id="example1" class="table table-bordered table-striped example1">
  <thead>
  <tr>
    <th>#</th>
    <th>Jenis</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>No SK</th>
    <th>Tgl SK</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php $no =1; foreach($cuti as $cuti) { ?>
  <tr>
    <td><?php echo $no ?></td>
    <td><?php echo $cuti->keterangan ?></td>
    <td><?php echo date('d-m-y',strtotime($cuti->tmt)) ?></td>
    <td><?php echo date('d-m-y',strtotime($cuti->tgakhir)) ?></td>
    <td><?php echo $cuti->nosk ?></td>
    <td><?php echo date('d-m-y',strtotime($cuti->tgsk)) ?></td>
    <td>
    
    <a href="<?php echo base_url('cuti/edit/'.$cuti->id_pers_cuti_hist) ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
    
	<?php include('delete.php') ?>
    
    </td>
  </tr>
  <?php $no++; } ?>
  </tbody>
  <tfoot>
  </tfoot>
</table>