<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">','</div>');

// Pesan sukses
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}

include('tambah.php');
?>

<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nomor</th>
      <th>Nama Pegawai</th>
      <th>Nip</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($pegawai as $pegawai) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $pegawai['nama_lengkap'] ?></td>
      <td><?php echo $pegawai['nip'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/pegawai/edit/'.$pegawai['id_pegawai']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/pegawai/delete/'.$pegawai['id_pegawai']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus pegawai ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
     <th>Nomor</th>
      <th>Nama Pegawai</th>
      <th>Nip</th>
      <th>Action</th>
   </tr>
 </tfoot>
</table>