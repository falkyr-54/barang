<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">','</div>');

// Pesan sukses
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}

?>
<p><a href="<?php echo base_url('admin/satker/tambah') ?>" class="btn btn-primary">
 <i class="fa fa-plus"></i> Tambah Satker</a></p>

 <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nomor</th>
      <th>Nama satker</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($satker as $satker) { ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $satker['nama_satker'] ?></td>
        <td><?php echo $satker['alamat'] ?></td>
        <td><?php echo $satker['telepon'] ?></td>
        <td>  
          <a href="<?php echo base_url('admin/satker/edit/'.$satker['id_satker']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

          <a href="<?php echo base_url('admin/satker/delete/'.$satker['id_satker']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus satker ini?')"><i class="fa fa-trash"></i></a>

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