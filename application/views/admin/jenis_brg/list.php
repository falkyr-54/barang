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
      <th>Nomorbb</th>
      <th>Kode Barang</th>
      <th>Jenis Barang</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($jenis as $jenis) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $jenis['kode_jns_brg'] ?></td>
      <td><?php echo $jenis['nama_jenis'] ?></td>
      <td>  
        
        <a href="<?php echo base_url('admin/jenis_brg/edit/'.$jenis['id_jenis']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <!-- <a href="<?php echo base_url('admin/jenis_brg/delete/'.$jenis['id_jenis']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Apa anda ingin menghapus jenis barang ini?')"><i class="fa fa-trash"></i></a> -->

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