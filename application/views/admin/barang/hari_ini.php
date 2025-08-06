
<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">','</div>');

// Pesan sukses
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-info">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
?>

<div class="btn-group">
  <a href="<?php echo base_url('admin/barang/list_pkl/'.$id_satker) ?>" class="btn bg-green margin">
    <i class="fa fa-plus"></i> Tambah Transaksi Baru</a>
  </div>

  <div class="btn-group">
    <a href="<?php echo base_url('admin/barang/kelurahan') ?>" class="btn bg-orange margin">
      <i class="fa fa-mail-reply"></i> Kembali</a>
    </div>

    <div class="box-body table-responsive no-padding">
      <div class="box" style="width:99%;">
        <a class="btn btn-block btn-social btn-flickr">
          <i class="fa fa-linkedin"></i> Transaksi Barang Masuk
        </a>
        <br>

        <table id="example1" class="table table-bordered table-striped">
          <thead>

           <tr class="bg-primary">
            <th width="17">#</th>
            <th width="17">Nama Barang</th>
            <th width="27">Tanggal</th>
            <th width="27">Penyedia</th>
            <th width="74">Spesifikasi</th>
            <th width="27">Jumlah</th>
            <th width="27">harga</th>
            <th width="27">harga+ppn</th>
            <th width="174">Aksi</th>
          </tr>
        </thead>

        <tbody>
         <?php 


         $i=1; foreach ($masuk as $masuk) { ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $masuk['nama_barang'] ?></td>
            <td><?php echo $masuk['tgl_datang'] ?></td>
            <td><?php echo $masuk['nama_rekanan'] ?></td>
            <td><?php echo $masuk['spesifikasi'] ?></td>
            <td><?php echo $masuk['jumlah'] ?></td>
            <td><?php echo $masuk['harga'] ?></td>
            <td><?php echo ($masuk['harga']*11/100) + $masuk['harga'] ?></td>
            <td>
              <a href="<?php echo base_url('admin/brg_masuk_kel/edit/'.$masuk['id_barang_masuk']) ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-pencil"></i>Ubah</a> 
              </td>
            </tr>
            <?php $i++; } ?> 
          </tbody>
        </table>
      </div>
    </div>

    <br>
    <!-- riwayat rotasi -->
    <div class="box-body table-responsive no-padding">
      <div class="box" style="width:99%;">
        <a class="btn btn-block btn-social btn-dropbox">
          <i class="fa fa-dropbox"></i> Transaksi Barang Keluar
        </a>
        <br>
        <table id="tabel1" class="table table-bordered table-striped">
          <thead>
           <tr class="bg-success">
            <th width="37">No</th>
            <th width="138">Nama Barang</th>
            <th width="138">Nama Pegawai</th>
            <th width="138">Tanggal</th>
            <th width="375">Jumlah</th>
            <th width="375">Satker</th>
            <th width="375">Unit</th>
            <th width="375">Keterangan</th>
            <th width="376">Aksi</th>
          </tr>
        </thead>

        <tbody>
         <tr class="hasil">
          <?php $i=1; foreach ($keluar as $keluar) { ?>
            <td><?php echo $i ?></td>
            <td><?php echo $keluar['nama_barang'] ?></td>
            <td><?php echo $keluar['nama_lengkap'] ?></td>
            <td><?php echo $keluar['tanggal_minta'] ?></td>
            <td><?php echo $keluar['jumlah_keluar'] ?></td>
            <td><?php echo $keluar['nama_satker'] ?></td>
            <td><?php echo $keluar['unit'] ?></td>
            <td><?php echo $keluar['keterangan'] ?></td>
            <td>
              <a href="<?php echo base_url('admin/brg_keluar_kel/edit/'.$keluar['id_barang_keluar']) ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-pencil"></i></a> 
                <?php
                include('delete_keluarkel.php');
                ?>

              </td>
            </tr>
            <?php $i++; } ?> 
          </tbody>
        </table>
      </div>
    </div>
    <br>
    <!-- end riwayat rotasi -->





