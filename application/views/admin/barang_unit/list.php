
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
        <td> <?php  
        $statusMap = [
          'tolak_pj' => ['fa-calendar-times-o', 'danger', 'di tolak PJ'],
          'acc_pj'   => ['fa-calendar-check-o', 'warning', 'acc PJ'],
          'acc_p'    => ['fa-calendar-check-o', 'info', 'acc pengurus barang'],
          'tolak_p'  => ['fa-calendar-check-o', 'info', 'di tolak pengurus barang'],
          'belum'    => ['fa-calendar-check-o', 'danger', 'belum acc']
        ];

        if (isset($statusMap[$keluar['status_validasi']])) {
          list($icon, $color, $text) = $statusMap[$keluar['status_validasi']];
          echo '<i class="fa ' . $icon . ' btn btn-' . $color . ' btn-md" disabled> ' . $text . '</i>';


        } ?>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
</table>
</div>
</div>
<!-- end riwayat rotasi -->





