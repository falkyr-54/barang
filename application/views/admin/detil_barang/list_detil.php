<?php
// Validasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

?>

<form name="form1" method="post" action="<?php echo base_url('admin/detil_barang/tambah/'.$id_barang.'/'.$id_jenis) ?>" enctype="multipart/form-data">

  <div class="form-group">
    <label>Merk</label>
    <input type="text" name="merk" class="form-control" value="<?php echo $m_barang['merk'] ?>" placeholder="NIP atasan" required readonly>
  </div>

  <div class="form-group">
    <label>Type</label>
    <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $m_barang['type'] ?>" placeholder="" required readonly>
  </div>

  <div class="form-group">
    <label>Kode barang</label>
    <input type="text" name="kd_barang" class="form-control" value="<?php echo set_value('kd_barang') ?>" placeholder="" required>
  </div>

  <div class="form-group">
    <label>Tahun</label>
    <input type="text" name="tahun" class="form-control" value="<?php echo set_value('tahun') ?>" placeholder="Tahun pembelian" required>
  </div>

  <div class="form-group">
    <label>Upload gambar</label>
    <input type="file" name="gambar" class="form-control">
  </div>


  <div class="form-group">
    <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
    <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
  </div>
  <div class="clearfix"></div>

  <?php
// Form close 
  echo form_close();
  ?>


  <p class="text-right">
    <a href="<?php echo base_url('admin/master_barang') ?>" class="btn btn-info btn-xs"><i class="fa fa-backward"></i> Kembali ke menu awal</a>
  </p>

  <div class="table-responsive mailbox-messages">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
         <th>No.</th>
         <th>Gambar</th>
         <th>Kode Barang</th>
         <th>Merk</th>
         <th>Type</th>
         <th>Tahun</th>
         <th>Action</th>
       </tr>
     </thead>
     <tbody>
      <?php $i=1; foreach($barang as $barang) { ?>
        <tr>
          <td><?php echo $i ?></td>
          <td>
           <?php if($barang['gambar']=="") { echo "No photo"; }else{ ?>
            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$barang['gambar']) ?>" style="max-width: 50px; height:auto;">
          <?php } ?>
        </td>
        <td><?php echo $barang['kd_barang'] ?></td>
        <td><?php echo $barang['merk'] ?></td>
        <td><?php echo $barang['type'] ?></td>     
        <td><?php echo $barang['tahun'] ?></td>
        <td>  
          <a href="<?php echo base_url('admin/detil_barang/ubah/'.$barang['id_detil'].'/'.$id_barang.'/'.$id_jenis) ?>" class="btn btn-info btn-sm" onclick="confirmation(event)">Ubah</a>
          <a href="<?php echo base_url('admin/detil_barang/riwayat/'.$barang['id_detil']) ?>" class="btn btn-info btn-sm" onclick="confirmation(event)">Riwayat</a>
          <a href="<?php echo base_url('admin/detil_barang/delete/'.$barang['id_detil']) ?>" class="btn btn-danger btn-sm" onclick="confirmation(event)">Hapus</a>
          </td>
        </tr>
        <?php $i++; } ?> 
      </tbody>
    </table>

  </div>
  <!-- /.mail-box-messages -->

