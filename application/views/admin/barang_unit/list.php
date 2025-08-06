
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

<div class="clearfix"></div>
</div><!-- /.content-wrapper -->

<!-- riwayat -->
<div class="box-body table-responsive no-padding">
  <div class="box" style="width:99%;">
    <a class="btn btn-block btn-social btn-instagram">
      Transaksi Barang keluar
    </a>
    <br>

    <table id="tabel1" class="table table-bordered table-striped">
      <thead>

       <tr class="bg-primary">
         <th width="37">No</th>
         <th width="138">Nama Barang</th>
         <th width="138">Nomor Seri</th>
         <th width="138">AKL/AKD</th>
         <th width="138">Daya</th>
         <th width="138">Nama Pegawai</th>
         <th width="138">Tanggal</th>
         <th width="375">Jumlah</th>
         <th width="375">Satker</th>
         <th width="375">Unit</th>
         <th width="375">keterangan</th>
         <th width="138">status validasi</th>
         <th width="376">Aksi</th>
       </tr>
     </thead>

     <tbody>
      <tr>
       <?php $i=1; foreach ($keluar as $keluar) { ?>
        <td><?php echo $i ?></td>
        <td><?php echo $keluar['nama_barang'] ?></td>
        <td><?php echo $keluar['seri'] ?></td>
        <td><?php echo $keluar['akl'] ?></td>
        <td><?php echo $keluar['daya'] ?></td>
        <td><?php echo $keluar['nama_lengkap'] ?></td>
        <td><?php echo $keluar['tanggal_minta'] ?></td>
        <td><?php echo $keluar['jumlah_keluar'] ?></td>
        <td><?php echo $keluar['nama_satker'] ?></td>
        <td><?php echo $keluar['unit'] ?></td>
        <td><?php echo $keluar['keterangan'] ?></td>
        <td>  <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#Approve<?php echo $keluar['id_barang_keluar'] ?>">
          <?php if ($keluar['status_validasi']=="belum"){ ?>
            <i class="fa  fa-calendar-minus-o btn btn-danger btn-md"> Belum Acc</i>
          <?php }elseif($keluar['status_validasi']=="acc_pj"){ ?>
            <i class="fa fa-calendar-times-o btn btn-warning btn-md"> Acc PJ Unit</i>
          <?php }elseif($keluar['status_validasi']=="approve"){ ?>
            <i class="fa fa-calendar-check-o btn btn-success btn-md"> <?php echo $keluar['status_validasi'] ?></i>
          <?php } ?>
        </button></td>
        <td>

          <?php if($this->session->userdata('level') == "Admin") { ?>

            <a href="<?php echo base_url('admin/brg_keluar/edit/'.$keluar['id_barang_keluar']) ?>" class="btn btn-primary btn-sm">
            Ubah</a>

            <a href="<?php echo base_url('admin/detil_barang/riwayat/'.$keluar['id_barang_keluar']) ?>" class="btn btn-info btn-sm">Riwayat</a><br>

            <?php include('delete_keluar.php'); ?>

            <!--   <a href="<?php echo base_url('admin/brg_masuk_kel/kirim/'.$keluar['id_barang_keluar'].'/'.$keluar['id_satker']) ?>" class="btn btn-success btn-sm">kirim pustu</a> -->

          <?php } ?>
        </td>
      </tr>
      <?php $i++; } ?> 
    </tbody>
  </table>
</div>
</div>
<!-- end riwayat rotasi -->





