
<div class="row">
  <div class="col-lg-2" style="width:11%">

    <i class="foto"> <?php if($detil['gambar'] != "") { ?>
      <img width="100" src="<?php echo base_url('assets/upload/image/'.$detil['gambar']) ?>">
    <?php }else{ ?>
      <p align="center">Tidak ada foto</p>
      <?php } ?></i> 
    </div>
  </div>


  <div class="box-body table-responsive no-padding">
    <div class="row invoice-info">
      <div class="col-lg-12 invoice-col">
        <table>
          <tr>
            <td>Nama Printer</td>
            <td>: <?php echo $detil['nama_barang'] ?></td>
          </tr>
           <tr>
            <td>Kode barang</td>
            <td>: <?php echo $detil['kode_barang'] ?></td>
          </tr>
          <tr>
            <td>Tahun Pengadaan</td>
            <td>: <?php echo $detil['tahun_pengadaan'] ?></td>
          </tr>
          <tr>
            <td>Nomor Seri</td>
            <td>: <?php echo $detil['seri'] ?></td>
          </tr>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>



  <div class="clearfix"></div>
</div><!-- /.content-wrapper -->

<!-- //riwayat servis -->
<div class="box-body table-responsive no-padding">
  <div class="box" style="width:99%;">
    <a class="btn btn-block btn-social btn-flickr">
      <i class="fa fa-wrench"></i> Riwayat Servis
    </a>
    <br>
    <table id="example1" class="table table-bordered table-striped">
      <div class="box-header with-border">
        <a href="<?php echo base_url('admin/transaksi_servis/tambah') ?>" class="btn btn-sm btn-primary pull-left">
          <i class="fa fa-plus"></i> Tambah</a> 
        </div>

        <thead>
          <tr class="tengah">
            <th rowspan="2" scope="col">No</th>
            <th rowspan="2" scope="col">Nama Barang</th>
            <th rowspan="2" scope="col">Kerusakan</th>
            <th rowspan="2" scope="col">Tanggal servis</th>
            <th colspan="2" scope="col" style="text-align:center">Petugas</th>
            <th rowspan="2" scope="col">Status</th>
            <th rowspan="2" scope="col">Tanggal Selesai</th>
            <th colspan="2" scope="col" style="text-align:center">Petugas</th>
            <th rowspan="2" scope="col">Perbaikan/Harga</th>
            <th rowspan="2" scope="col">Action</th>
          </tr>
          <tr class="tengah">
            <th width="11%" scope="col">Petugas IT</th>
            <th width="3%" scope="col">Petugas Servis</th>
            <th width="3%" scope="col">Petugas IT</th>
            <th width="3%" scope="col">Petugas Servis</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=1;foreach ($servis as $servis) { ?>
           <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $servis['merk'].' '.$servis['type'] ?></td>
            <td><?php echo $servis['kerusakan'] ?></td>
            <td><?php echo $servis['tgl_servis'] ?></td>
            <td><?php echo $servis['pemberi_it'] ?></td>
            <td><?php echo $servis['penerima_servis'] ?></td>
            <?php if ($servis['status']=="proses"){ ?>
              <td><span class="badge badge bg-red"><?php echo $servis['status'] ?></span></td>
            <?php }else{ ?>
              <td><span class="badge badge bg-green"><?php echo $servis['status'] ?></span></td>
            <?php } ?>
            <td><?php echo $servis['tgl_selesai'] ?></td>
            <td><?php echo $servis['penerima_it'] ?></td>
            <td><?php echo $servis['pemberi_servis'] ?></td>
            <td><?php echo $servis['keterangan'] ?><br>Biaya Servis :<?php echo $servis['harga'] ?></td>
            <td>
              <a href="<?php echo base_url('admin/transaksi_servis/ubah/'.$servis['id_servis']) ?>" class="btn btn-warning btn-xs">update</a>
              <a href="<?php echo base_url('admin/transaksi_servis/hapus/'.$servis['id_servis']) ?>" class="btn btn-danger btn-xs remove">hapus</a>
            </td>

          </tr>
          <?php $i++; } ?>
        </tbody>

      </table>
    </div>
  </div>
  <!-- end riwayt jabatan -->

  <br>
  <!-- riwayat rotasi -->
  <div class="box-body table-responsive no-padding">
    <div class="box" style="width:99%;">
      <a class="btn btn-block btn-social btn-instagram">
        <i class="fa fa-building-o"></i> Riwayat Penempatan
      </a>
      <br>
      <table id="tabel1" class="table table-bordered table-striped">
       <div class="box-header with-border">
        <a href="<?php echo base_url('admin/penempatan/tambah_baru'.'/'.$detil['id_barang_keluar']) ?>" class="btn btn-sm btn-primary pull-left">
          <i class="fa fa-plus"></i> Tambah</a> 
        </div>
        <thead>
          <tr class="bg-success">
            <th>No</th>
            <th>Satker</th>
            <th>Unit</th>
            <th>Penerima</th>
            <th>Tanggal penempatan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=1; foreach($penempatan as $penempatan) { ?>
           <tr class="hasil">
            <td><?php echo $i ?></td>
            <td><?php echo $penempatan['nama_satker'] ?></td>
            <td><?php echo $penempatan['unit'] ?></td>
            <td><?php echo $penempatan['penerima'] ?></td>
            <td><?php echo $penempatan['tgl_penempatan'] ?></td>
            <td><?php echo $penempatan['status'] ?></td>
            <td><a href="<?php echo base_url('admin/penempatan/ubah/'.$penempatan['id_tempat']) ?>" class="btn btn-primary btn-sm">
              <i class="fa fa-pencil"></i></a></td>
            </tr>
            <?php $i++; } ?> 
          </tbody>
        </table>
      </div>
    </div>
    <br>
    <!-- end riwayat rotasi -->
