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

<p><a href="<?php echo base_url('admin/user/tambah') ?>" class="btn btn-primary">
 <i class="fa fa-plus"></i> Tambah</a></p>

<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nomor</th>
      <th>Nama User</th>
      <th>Username</th>
      <th>Ruangan</th>
      <th>Akses</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($user as $user) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $user['nama_user'] ?></td>
      <td><?php echo $user['username'] ?></td>
      <td><?php echo $user['unit'] ?></td>
      <td><?php echo $user['akses_level'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" class="btn btn-primary btn-sm">
          <i class="fa fa-pencil"></i></a>
          <a href="<?php echo base_url('admin/user/delete/'.$user['id_user']) ?>" class="btn btn-danger btn-sm" onClick="return confirm('Yakin ingin menghapus User ini?')">
            <i class="fa fa-trash"></i></a>
          </td>
        </tr>
        <?php $i++; } ?> 
      </tbody>
      <tfoot>
        <tr>
         <th>Nomor</th>
         <th>Nama User</th>
         <th>Username</th>
         <th>Akses</th>
         <th>Action</th>
       </tr>
     </tfoot>
   </table>