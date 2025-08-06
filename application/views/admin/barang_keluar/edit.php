<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
  echo '<div class="alert alert-warning">'.$error.'</div>'; 
}
?>


<sup>
  <a href="<?php echo base_url('admin/barang/riwayat_kel/'.$brg['id_barang'].'/'.$brg['id_satker']) ?>" class="btn btn-warning btn-sm">
    <i class="fa fa-angle-double-left"></i> Kembali</a>
  </sup>


  <form name="form1" method="post" action="<?php echo base_url('admin/brg_keluar/edit/'.$brg['id_barang_keluar']) ?>" enctype="multipart/form-data">

<!-- 
   <sup>
    <a href="<?php echo base_url('admin/barang/riwayat/'.$brg['id_barang'].'/'.$id_satker) ?>" class="btn btn-warning btn-sm">
      <i class="fa fa-angle-double-left"></i> Kembali</a>
    </sup>

    <form name="form1" method="post" action="<?php echo base_url('admin/Brg_keluar/edit/'.$brg['id_barang_keluar']) ?>" enctype="multipart/form-data"> -->


      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Barang keluar</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <!-- text input -->
          <div class="col-md-6">

            <div class="form-group">
              <label>Nama Pegawai</label>
              <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $brg['nama_lengkap'] ?>" placeholder="Cari nama pegawai..." required id="nama_lengkap">
            </div>

            <div class="form-group" hidden="">
              <label>ID</label>
              <input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $brg['id_pegawai'] ?>" placeholder="NIP pegawai Pengganti" required id="id_pegawai" readonly>
            </div>

            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="nama_barang" class="form-control" placeholder="Cari ..." value="<?php echo $brg['nama_barang'] ?>" required id="nama_barang" readonly>
            </div>

            <div class="form-group" hidden="">
              <input type="hidden" class="form-control" name="id_barang" value="<?php echo $brg['id_barang'] ?>" id="id_barang" readonly>
            </div>

            <div class="form-group" hidden="">
              <input type="text" class="form-control" name="id_jenis" value="<?php echo $brg['id_jenis'] ?>" id="id_jenis" readonly>
            </div>

            <div class="form-group">
              <div class="row">

                <div class="col-lg-6">

                  <label>Jumlah</label>
                  <input type="text" class="form-control" placeholder="Qty" name="jumlah_keluar" value="<?php echo $brg['jumlah_keluar'] ?>">
                </div>

                <div class="col-lg-6">
                  <label>Satuan</label>
                  <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $brg['satuan'] ?>" readonly>
                </div>
              </div>

            </div>

            <?php if ($this->session->userdata('level')=="kelurahan") { ?>

              <div class="form-group" hidden="">
                <input type="text" class="form-control" name="id_satker" value="<?php echo $brg['id_satker'] ?>" readonly>
              </div>
            <?php }else{ ?>

               <div class="form-group" hidden="">
                <input type="text" class="form-control" name="id_satker" value="<?php echo $id_satker ?>">
              </div>

             <!--  <div class="form-group">
                <label>Satuan Kerja (Satker)</label>
                <select name="id_satker" class="form-control">
                 <option value="">Pilih Satker</option>       
                 <?php foreach($satker as $satker) { ?>
                  <option value="<?php echo $satker['id_satker'] ?>" class="<?php echo $satker['id_satker'] ?>"
                    <?php if($brg['id_satker']==$satker['id_satker']) { echo "selected"; } ?>>
                    <?php echo $satker['nama_satker'] ?></option>
                  <?php } ?>
                </select>
              </div> -->

            <?php } ?>

            <div class="form-group">
              <label>Unit Bagian Kerja</label>
              <select name="id_unit" class="form-control">
               <option value=" ">Pilih Unit</option>
               <?php foreach($unit as $unit) { ?>
                <option value="<?php echo $unit['id_unit'] ?>" class="<?php echo $unit['id_unit'] ?>"
                  <?php if($brg['id_unit']==$unit['id_unit']) { echo "selected"; } ?>>
                  <?php echo $unit['unit'] ?></option>
                <?php } ?>
              </select>
            </div>   
          </div>


          <div class="col-md-6">

            <div class="form-group">
              <label class="control-label">Tanggal Permintaan</label>
              <input type="date" name="tanggal_minta" value="<?php echo $brg['tanggal_minta'] ?>" class="form-control" placeholder="...">
            </div>

            <div class="form-group">
              <label class="control-label">Tanggal Expired</label>
              <input type="date" name="tanggal_exp" value="<?php echo $brg['tanggal_expired'] ?>" class="form-control" placeholder="...">
            </div>

            <div class="form-group">
              <label class="control-label"> Keterangan</label>
              <textarea class="form-control" name="keterangan" placeholder="..."><?php echo $brg['keterangan'] ?></textarea>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
              <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
            </div>
          </div>

        </div>
      </div>
    </form>

    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>    

    <script>
      $(function() {                     
    $( "#nama_barang" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/brg_keluar/getbarang') ?>",
          dataType: "json",
          data: request,
          success: function(data){
            if(data.response == 'true') {
              response(data.message);
            }
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        event.preventDefault();
        $(this).val(ui.item.label);
        $("#id_barang").val(ui.item.value);
        $("#satuan").val(ui.item.satuan);

      },
    });
  }); 
</script>

<script>
  $(function() {                     
    $( "#nama_lengkap" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/brg_keluar/getnip') ?>",
          dataType: "json",
          data: request,
          success: function(data){
            if(data.response == 'true') {
              response(data.message);
            }
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        event.preventDefault();
        $(this).val(ui.item.label);
        $("#id_pegawai").val(ui.item.value);
      },

    });
  }); 
</script>  