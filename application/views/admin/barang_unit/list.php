
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

    <table id="tabelku" class="table table-bordered table-striped">
      <thead>

       <tr class="bg-primary">
         <th width>No</th>
         <th width>Nama Barang</th>
        <!--  <th width>Nomor Seri</th>
         <th width>AKL/AKD</th>
         <th width>Daya</th> -->
         <th width>Nama Pegawai</th>
         <th width>Tanggal</th>
         <th width>Jumlah</th>
         <th width>Satker</th>
         <th width>Unit</th>
         <th width>keterangan</th>
         <th width>status validasi</th>
       </tr>
     </thead>

     <tbody>
       <?php $i=1; foreach ($keluar as $row) { ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row['nama_barang'] ?></td>
         <!--  <td><?php echo $row['seri'] ?></td>
          <td><?php echo $row['akl'] ?></td>
          <td><?php echo $row['daya'] ?></td> -->
          <td><?php echo $row['nama_lengkap'] ?></td>
          <td><?php echo $row['tanggal_minta'] ?></td>
          <td><?php echo $row['jumlah_keluar'] ?></td>
          <td><?php echo $row['nama_satker'] ?></td>
          <td><?php echo $row['unit'] ?></td>
          <td><?php echo $row['keterangan'] ?></td>
          <td>
            <?php  
            $statusMap = [
              'tolak_pj' => ['fa-calendar-times-o', 'danger', 'di tolak PJ'],
              'acc_pj'   => ['fa-calendar-check-o', 'warning', 'acc PJ'],
              'acc_p'    => ['fa-calendar-check-o', 'info', 'acc pengurus barang'],
              'tolak_p'  => ['fa-calendar-check-o', 'info', 'di tolak pengurus barang'],
              'belum'    => ['fa-calendar-check-o', 'danger', 'belum acc']
            ];

            if (isset($statusMap[$row['status_validasi']])) {
              list($icon, $color, $text) = $statusMap[$row['status_validasi']];
              echo '<i class="fa ' . $icon . ' btn btn-' . $color . ' btn-md" disabled> ' . $text . '</i>';
            }
            ?>
          </td>
        </tr>
        <?php $i++; } ?>
      </tbody>
    </table>
  </div>
</div>
<!-- end riwayat rotasi -->





