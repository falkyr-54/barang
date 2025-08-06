
<section id="new">
  <h4 class="page-header">
    Nama Barang : <?php echo $barang['nama_barang']?>
    <br>
    Jenis : <?php echo $barang['nama_jenis'] ?>
    <br>

    <?php 
    $hasil = (int)$jml_masuk['total'] - (int)$jml_keluar['total'];
    ?>

    
    Stok Tersedia : <?php echo $hasil.' '.$barang['satuan'] ?> 
  </h4>
</section>

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

<!-- //riwayat jabatan -->
<div class="box-body table-responsive no-padding">
  <div class="box" style="width:99%;">
    <a class="btn btn-block btn-social btn-flickr">
      <i class="fa fa-linkedin"></i> Transaksi Barang Masuk
    </a>
    <br>
    
    <table id="example1" class="table table-bordered table-striped">
      <thead>

        <a href="<?php echo base_url('admin/brg_masuk_kel/tambah/'.$barang['id_barang'].'/'.$id_satker) ?>" class="btn bg-maroon margin">
         <i class="fa fa-plus"></i> Tambah</a>

         <tr class="bg-primary">
          <th width="17">#</th>
          <th width="17">Nama Barang</th>
          <th width="27">Tanggal</th>
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


       $i=1; foreach ($masuk as $masuk) { ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $masuk['nama_barang'] ?></td>
          <td><?php echo $masuk['tgl_datang'] ?></td>
          <td><?php echo $masuk['nama_rekanan'] ?></td>
          <td><?php echo $masuk['spesifikasi'] ?></td>
          <td><?php echo $masuk['jumlah'] ?></td>
          <td><?php echo $masuk['harga'] ?></td>
          <!-- <td><?php echo ($masuk['harga']*11/100) + $masuk['harga'] ?></td> -->
          <td>
            <?php 

            $id_barang       = $masuk['id_barang'];
            $id_barang_masuk = $masuk['id_msk_kel'];
            $stok_id = $this->Brg_keluarkel_model->get_total_id($id_barang,$id_barang_masuk);
            $hasil = $masuk['jumlah'] - $stok_id['total'];

            echo $hasil;
            ?>           
          </td>
          <td>
            <?php             
            $id_barang       = $masuk['id_barang'];
            $id_barang_masuk = $masuk['id_msk_kel'];
            $stok_id = $this->Brg_keluarkel_model->get_total_id($id_barang,$id_barang_masuk);
            $hasil = $masuk['jumlah'] - $stok_id['total'];
            ?>           

            <a href="<?php echo base_url('admin/brg_masuk_kel/edit/'.$masuk['id_msk_kel']) ?>" class="btn btn-primary btn-sm">
              <i class="fa fa-pencil"></i>Ubah</a> 

              <?php if ($hasil==0){ ?>

                <a href="#" class="btn btn-danger btn-sm">
                  <i class="fa fa-paper-plane"></i> STOK HABIS</a>

                <?php }else{ ?>

                  <a href="<?php echo base_url('admin/brg_keluar_kel/tambah/'.$barang['id_barang'].'/'.$id_satker.'/'.$masuk['id_msk_kel']) ?>" class="btn btn-info btn-sm">
                    <i class="fa fa-paper-plane"></i> Transaksi Keluar</a>

                  <?php } ?>
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
            <i class="fa fa-instagram"></i> Transaksi Barang keluar
          </a>
          <br>

          <table id="tabel1" class="table table-bordered table-striped">
            <thead>


              <tr class="bg-primary">
               <th width="37">No</th>
               <th width="138">Nama Barang</th>
               <th width="138">Nama Pegawai</th>
               <th width="138">Tanggal</th>
               <th width="375">Jumlah</th>
               <th width="375">Satker</th>
               <th width="375">Unit</th>
               <th width="375">keterangan</th>
               <th width="376">Aksi</th>
             </tr>
          </thead>

          <tbody>
           <tr>
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
                  <a href="<?php echo base_url('admin/brg_keluar_kel/edit/'.$keluar['id_luar_kel']) ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-pencil"></i></a> 
                    <?php include('delete_keluarkel.php'); ?>

                  </td>
                </tr>
                <?php $i++; } ?> 
              </tbody>
            </table>
          </div>
        </div>



        <!-- end riwayat barang satker -->





