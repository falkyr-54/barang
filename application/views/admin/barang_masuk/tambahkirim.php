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


  <form name="form1" method="post" action="<?php echo base_url('admin/brg_masuk_kel/kirim/'.$brg['id_barang_keluar'].'/'.$id_satker) ?>" enctype="multipart/form-data">


    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Barang keluar</h3>
      </div><!-- /.box-header -->

      <div class="box-body">
        <!-- text input -->
        <div class="col-md-6">

          <div class="form-group">
            <label>Nama Rekanan</label>
            <input type="text" name="nama_rekanan" class="form-control" value="<?php echo $rekanan['nama_rekanan'] ?>" placeholder="" readonly>
          </div>

          <div class="form-group" hidden="">
            <label>ID</label>
            <input type="text" name="id_rekanan" class="form-control" value="<?php echo $rekanan['id_rekanan'] ?>" placeholder="id rekanan" readonly>
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
                <input type="text" class="form-control" placeholder="Qty" name="jumlah" value="<?php echo $brg['jumlah_keluar'] ?>" readonly>
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

        <?php } ?>

      </div>


      <div class="col-md-6">

       <div class="form-group">
        <label>Harga</label>
        <input type="text" name="harga" value="<?php echo $brg['harga'] ?>" class="form-control" placeholder="harga barang" readonly>
      </div>

      <div class="form-group">
        <label class="control-label">Tanggal Permintaan</label>
        <input type="date" name="tgl_datang" value="<?php echo $brg['tanggal_minta'] ?>" class="form-control" placeholder="...">
      </div>

      <div class="form-group">
        <label class="control-label"> Keterangan</label>
        <textarea class="form-control" name="spesifikasi" placeholder="isi keterangan"><?php echo $brg['keterangan'] ?></textarea>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <input type="submit" name="submit" value="Kirim Data" class="btn btn-success btn-md">
        <!--<input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">-->
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