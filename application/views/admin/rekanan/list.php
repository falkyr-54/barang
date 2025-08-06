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
      <th>Nama Rekanan</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($rekanan as $rekanan) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $rekanan['nama_rekanan'] ?></td>
      <td><?php echo $rekanan['alamat'] ?></td>
      <td><?php echo $rekanan['telepon'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/rekanan/edit/'.$rekanan['id_rekanan']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/rekanan/delete/'.$rekanan['id_rekanan']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus rekanan ini?')"><i class="fa fa-trash"></i></a>

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