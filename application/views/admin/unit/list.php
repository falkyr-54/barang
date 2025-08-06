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
      <th>No</th>
      <th>unit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($unit as $unit) { ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $unit['unit'] ?></td>
        <td>  
          <a href="<?php echo base_url('admin/unit/edit/'.$unit['id_unit']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

          <a href="<?php echo base_url('admin/unit/delete/'.$unit['id_unit']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus unit ini?')"><i class="fa fa-trash"></i></a>

        </td>
      </tr>
      <?php $i++; } ?> 
    </tbody>
  </table>