 
<!-- <?php include('form_approval.php') ?> -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >List barang acc : </h3>
  </div>
  <div class="panel-body">
    <!-- <form class="form-horizontal" action="" name="form_laporan" method="post"> -->
      <?php if ($this->session->userdata('level')=="pj"){ ?>

        <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/libur/pencarian/'.$id_satker.'/'.$id_unit.'/'.$tmt.'/'.$sampai) ?>" enctype="multipart/form-data">
        <?php } ?>

        <?php if ($this->session->userdata('level')=="kapustu"){ ?>
          <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/libur/pencarian/'.$id_satker.'/'.$tmt.'/'.$sampai) ?>" enctype="multipart/form-data">
          <?php } ?>

          <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/libur/pencarian/'.$tmt.'/'.$sampai) ?>" enctype="multipart/form-data">

           <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
              <div class="col-sm-4">
               <input type="text" class="form-control tanggal_max" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
             </div>
           </div>
           <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Sampai Tanggal</label>
            <div class="col-sm-4">
              <input type="text" class="form-control tanggal_max" placeholder="YYYY-MM-DD" name="sampai" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
              <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer -->
      </form>


      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">

           <div class="box-body table-responsive no-padding">
             <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Nama Pegawai</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Satker</th>
                  <th>Unit</th>
                  <th>keterangan</th>
                  <th>status validasi</th>
                  <th>Aksi</th>
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
                    <?php }elseif($keluar['status_validasi']=="pj"){ ?>
                      <i class="fa fa-calendar-times-o btn btn-warning btn-md"> <?php echo $keluar['status_validasi'] ?></i>
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
            <script>
              $(function() {

               $( ".tanggal_max" ).datepicker({
      // inline: true,
      changeYear: true,
      changeMonth: true,
      yearRange: "<?php echo $taun['thn_awal'] ?>:<?php echo $taun['thn_akhir'] ?>",
      dateFormat: "yy-mm-dd",
    });
             });
           </script>




