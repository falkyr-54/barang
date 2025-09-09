<section id="new">
  <h4 class="page-header">
    Nama Barang : <?php echo $barang['nama_barang'] ?>
    <br>
    Jenis : <?php echo $barang['nama_jenis'] ?>
    <br>
    <?php
    $hasil = (int)$jml_masuk['total'] - (int)$jml_keluar['total'];
    ?>
    Stok Tersedia : <?php echo $hasil . ' ' . $barang['satuan'] ?>
  </h4>
</section>

<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">', '</div>');

// Pesan sukses
if ($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
?>

<div class="clearfix"></div>
</div><!-- /.content-wrapper -->

<!-- //riwayat jabatan -->
<div class="box-body table-responsive no-padding">
  <div class="box" style="width:99%;">
    <a class="btn btn-block btn-social btn-flickr">
      Transaksi Barang Masuk
    </a>
    <br>

    <table id="example1" class="table table-bordered table-striped">
      <thead>

      <?php if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "pptk") { ?>
        <a href="<?php echo base_url('admin/brg_masuk/tambah/' . $barang['id_barang']) ?>" class="btn bg-maroon margin">
          <i class="fa fa-plus"></i> Tambah</a> 
      <?php } ?>

      <tr class="bg-primary">
        <th width="17">#</th>
        <th width="17">Gambar</th>
        <th width="17">Nama Barang</th>
        <th width="27">Tanggal</th>
        <th width="27">Sumber</th>
        <th width="27">TKDN</th>
        <th width="27">Penyedia</th>
        <th width="74">Spesifikasi</th>
        <th width="27">Jumlah</th>
        <th width="27">harga+ppn</th>
        <th width="27">Stok</th>
        <th width="174">Aksi</th>
      </tr>
      </thead>

      <tbody>
      <?php
      // --- Hitung stok dan filter di sini ---
      $filtered_masuk = [];
      foreach ($masuk as $m) {
        $id_barang       = $m['id_barang'];
        $id_barang_masuk = $m['id_barang_masuk'];
        $stok_id         = $this->Brg_keluar_model->get_total_id($id_barang, $id_barang_masuk);
        $stok_tersisa    = $m['jumlah'] - $stok_id['total'];
        $m['stok_tersisa'] = $stok_tersisa;

        // Filter: admin unit hanya lihat stok > 0
       if (
    ($this->session->userdata('level') == "admin_poli" 
     || $this->session->userdata('level') == "kelurahan") 
    && $stok_tersisa <= 0
) {
    continue;
}


        $filtered_masuk[] = $m;
      }

      $level = $this->session->userdata('level');
$stok_aktif = true; // hanya stok lama pertama yg masih ada bisa transaksi
$i = 1;
foreach ($filtered_masuk as $masuk): ?>
  <tr>
    <td><?= $i ?></td>
    <td>
      <?php if ($masuk['gambar'] == ""): ?>
        No photo
      <?php else: ?>
        <img src="<?= base_url('assets/upload/image/thumbs/' . $masuk['gambar']) ?>" style="max-width: 50px; height:auto;">
      <?php endif; ?>
    </td>
    <td><?= $masuk['nama_barang'] ?></td>
    <td><?= $masuk['tgl_datang'] ?></td>
    <td><?= $masuk['sumber'] ?></td>
    <td><?= $masuk['tkdn'] ?></td>
    <td><?= $masuk['nama_rekanan'] ?></td>
    <td><?= $masuk['spesifikasi'] ?></td>
    <td><?= $masuk['jumlah'] ?></td>
    <td><?= $masuk['harga'] ?></td>
    <td><?= $masuk['stok_tersisa'] ?></td>
    <td>
      <?php if ($level == "admin"): ?>
        <a href="<?= base_url('admin/brg_masuk/edit/' . $masuk['id_barang_masuk']) ?>" class="btn btn-primary btn-sm">
          <i class="fa fa-pencil"></i> Ubah</a>
      <?php endif; ?>

      <?php if ($masuk['stok_tersisa'] == 0): ?>
        <!-- stok habis -->
        <button class="btn btn-danger btn-sm" disabled>
          <i class="fa fa-times"></i> STOK HABIS</button>

      <?php else: ?>
        <?php if ($level == "admin_poli" || $level == "kelurahan"): ?>
          <?php if ($stok_aktif): ?>
            <!-- stok pertama aktif -->
            <a href="<?= base_url('admin/brg_keluar/tambah/' . $masuk['id_barang'] . '/' . $id_satker . '/' . $masuk['id_barang_masuk']) ?>" 
               class="btn btn-info btn-sm">
              <i class="fa fa-paper-plane"></i> Transaksi Keluar</a>
            <?php $stok_aktif = false; ?>
          <?php else: ?>
            <!-- stok baru dikunci -->
            <button class="btn btn-secondary btn-sm" disabled>
              <i class="fa fa-lock"></i> Tunggu stok lama habis</button>
          <?php endif; ?>
        <?php else: ?>
          <!-- selain admin_poli & kelurahan, bebas transaksi -->
          <a href="<?= base_url('admin/brg_keluar/tambah/' . $masuk['id_barang'] . '/' . $id_satker . '/' . $masuk['id_barang_masuk']) ?>" 
             class="btn btn-info btn-sm">
            <i class="fa fa-paper-plane"></i> Transaksi Keluar</a>
        <?php endif; ?>
      <?php endif; ?>
    </td>
  </tr>
<?php $i++; endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- end riwayat jabatan -->

<br>
<!-- riwayat rotasi -->
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
          <th width="138">Tanggal Expired</th>
          <th width="375">Jumlah</th>
          <th width="375">Satker</th>
          <th width="375">Unit</th>
          <th width="375">keterangan</th>
          <th width="376">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <?php $i = 1;
          foreach ($keluar as $keluar) { ?>
            <td><?php echo $i ?></td>
            <td><?php echo $keluar['nama_barang'] ?></td>
            <td><?php echo $keluar['seri'] ?></td>
            <td><?php echo $keluar['akl'] ?></td>
            <td><?php echo $keluar['daya'] ?></td>
            <td><?php echo $keluar['nama_lengkap'] ?></td>
            <td><?php echo $keluar['tanggal_minta'] ?></td>
            <td><?php echo $keluar['tanggal_expired'] ?></td>
            <td><?php echo $keluar['jumlah_keluar'] ?></td>
            <td><?php echo $keluar['nama_satker'] ?></td>
            <td><?php echo $keluar['unit'] ?></td>
            <td><?php echo $keluar['keterangan'] ?></td>
            <td>
              <?php if ($this->session->userdata('level') == "admin") { ?>
                <a href="<?= base_url('admin/brg_keluar/edit/' . $keluar['id_barang_keluar']) ?>" class="btn btn-primary btn-sm">Ubah</a>
                <a href="<?= base_url('admin/detil_barang/riwayat/' . $keluar['id_barang_keluar']) ?>" class="btn btn-info btn-sm">Riwayat</a><br>
                <?php include('delete_keluar.php'); ?>
                <a href="<?= base_url('admin/brg_masuk_kel/kirim/' . $keluar['id_barang_keluar'] . '/' . $keluar['id_satker']) ?>" class="btn btn-success btn-sm">kirim pustu</a>
              <?php } else { 
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
                }
              } ?>
            </td>
          </tr>
          <?php $i++; } ?>
      </tbody>
    </table>
  </div>
</div>
<!-- end riwayat rotasi -->
