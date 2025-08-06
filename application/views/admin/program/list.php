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
      <th>Nama Program</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($program as $program) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $program['nama'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/program/edit/'.$program['id_program']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/program/delete/'.$program['id_program']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin menghapus Data Program ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
     <th>Nomor</th>
     <th>Nama Program</th>
     <th>Action</th>
   </tr>
 </tfoot>
</table>