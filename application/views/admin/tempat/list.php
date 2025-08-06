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
      <th>Wilayah</th>
      <th>Jenis Tempat</th>
      <th>Nama Tempat</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($tempat as $tempat) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $tempat['wilayah'] ?></td>
      <td><?php echo $tempat['jenis_tempat'] ?></td>
      <td><?php echo $tempat['tempat'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/tempat/edit/'.$tempat['id_tempat']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/tempat/delete/'.$tempat['id_tempat']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin menghapus jenis tempat ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
       <th>Nomor</th>
      <th>Wilayah</th>
      <th>Jenis Tempat</th>
      <th>Nama Tempat</th>
      <th>Action</th>
   </tr>
 </tfoot>
</table>