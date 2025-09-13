
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari List diapprove : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/pj_klaster/pencarian/'.$tmt.'/'.$sampai.'/'.$id_klaster) ?>" enctype="multipart/form-data">

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
            <th>no</th>
            <th>nama pegawai</th>
            <th>unit</th>
            <th>nama barang</th>
            <th>jumlah keluar</th>
            <th>tanggal permintaan</th>
            <th>Status approval</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;foreach ($klast as $klast) { ?>
            <tr>

              <td><?php echo $i ?></td>
              <td><?php echo $klast['nama_pegawai'] ?></td>
              <td><?php echo $klast['unit'] ?></td>
              <td><?php echo $klast['nama_barang'] ?></td>
              <td><?php echo $klast['jumlah_keluar'] ?></td>
              <td><?php echo $klast['tanggal_minta'] ?></td>
              <td>
                <?php
                include('approve.php');
                ?>
              </td>
            </tr>
            <?php $i++ ?>
          <?php } ?>
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