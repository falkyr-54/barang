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
      <th>Satuan</th>
      <th>Keterangan</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($satuan as $satuan) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $satuan['satuan'] ?></td>
      <td><?php echo $satuan['keterangan'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/satuan/edit/'.$satuan['id_satuan']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/satuan/delete/'.$satuan['id_satuan']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus satuan ini?')"><i class="fa fa-trash"></i></a>

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