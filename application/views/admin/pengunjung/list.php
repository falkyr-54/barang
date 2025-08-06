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
      <th>Jenis Pengunjung</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($pengunjung as $pengunjung) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $pengunjung['jenis'] ?> (<?php echo $pengunjung['singkatan']; ?>)</td>
      <td>  
        <a href="<?php echo base_url('admin/pengunjung/edit/'.$pengunjung['id_pengunjung']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/pengunjung/delete/'.$pengunjung['id_pengunjung']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin menghapus jenis pengunjung ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
      <th>Nomor</th>
      <th>Jenis Pengunjung</th>
      <th>Action</th>
   </tr>
 </tfoot>
</table>