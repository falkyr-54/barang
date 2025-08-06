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
<?php if ($this->session->userdata('level')== "admin"){ ?>

    <div class="btn-group">
      <a href="<?php echo base_url('admin/barang/tambah') ?>" class="btn btn-primary">
       <i class="fa fa-plus"></i> Tambah Barang</a>
     </div>
     <div class="btn-group">
       <a href="<?php echo base_url('admin/barang/kelurahan') ?>" class="btn bg-orange margin">
        <i class="fa fa-mail-reply"></i> Kembali</a>
      </div>
  <?php } ?>

  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nomor</th>
        <th>Kode Barang</th>
        <th>Jenis Barang</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php   

      $id_satker = $this->session->userdata('id_satker');
      $i=1; foreach($barang as $barang) 

      { ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $barang['kode_barang'] ?></td>
          <td><?php echo $barang['nama_barang'] ?></td>
          <td>  

            <?php if ($id_satkerku==1){ ?>

              <a href="<?php echo base_url('admin/barang/edit/'.$barang['id_barang']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

              <a href="<?php echo base_url('admin/barang/delete/'.$barang['id_barang']) ?>" class="btn btn-danger btn-sm" onClick="return confirm('Apa anda ingin menghapus barang ini?')"><i class="fa fa-trash"></i></a>

              <a href="<?php echo base_url('admin/barang/riwayat/'.$barang['id_barang'].'/'.$id_satker) ?>" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-ticket" title="info"></i></a>

            <?php }else{ ?>

              <a href="<?php echo base_url('admin/barang/riwayat_kel/'.$barang['id_barang'].'/'.$id_satkerku) ?>" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-ticket" title="info"></i></a>

            <?php } ?>



          </td>
        </tr>
        <?php $i++; } ?> 
      </tbody>
      <tfoot>
        <tr>
         <th>Nomor</th>
         <th>Kode Barang</th>
         <th>Jenis Barang</th>
         <th>Action</th>
       </tr>
     </tfoot>
   </table>