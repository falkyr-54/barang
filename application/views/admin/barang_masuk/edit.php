<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
  echo '<div class="alert alert-warning">'.$error.'</div>'; 
}
?>

<sup>
  <a href="<?php echo base_url('admin/barang/riwayat/'.$brg['id_barang'].'/'.$brg['id_satker']) ?>" class="btn btn-warning btn-sm">
    <i class="fa fa-angle-double-left"></i> Kembali</a>
  </sup>

  <form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/edit/'.$brg['id_barang_masuk']) ?>" enctype="multipart/form-data">


     <!-- <sup>
      <a href="<?php echo base_url('admin/barang/riwayat/'.$brg['id_barang'].'/'.$id_satker) ?>" class="btn btn-warning btn-sm">
        <i class="fa fa-angle-double-left"></i> Kembali</a>
      </sup>

      <form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/edit/'.$brg['id_barang_masuk']) ?>" enctype="multipart/form-data"> -->

        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Barang Masuk</h3>
          </div><!-- /.box-header -->

          <div class="box-body">
            <!-- text input -->
            <div class="col-md-6">

              <?php if ($this->session->userdata('level')=="admin"){ ?>

                <div class="form-group">
                  <label>Rekanan</label>
                  <select name="id_rekanan" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Pilih Rekanan</option>
                    <?php foreach($rekanan as $rekanan) { ?>
                      <option value="<?php echo $rekanan['id_rekanan'] ?>" <?php if($brg['id_rekanan']==$rekanan['id_rekanan']) { echo "selected"; } ?>>
                        <?php echo $rekanan['nama_rekanan'] ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              <?php } ?>


              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Search ..." value="<?php echo $brg['nama_barang'] ?>" required id="nama_barang" readonly>
              </div>

              <div class="form-group">
                <input type="hidden" class="form-control" name="id_barang" value="<?php echo $brg['id_barang'] ?>" id="id_barang" readonly>
              </div>

              <div class="form-group">
                <div class="row">

                  <div class="col-lg-6">

                    <label>Jumlah</label>
                    <input type="text" class="form-control" placeholder="Qty" name="jumlah" value="<?php echo $brg['jumlah'] ?>">
                  </div>

                  <div class="col-lg-6">
                    <label>Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $brg['satuan'] ?>" readonly>
                  </div>
                </div>

              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" placeholder="Rp..." value="<?php echo $brg['harga'] ?>">
              </div>

              <!-- textarea -->


            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="inputSuccess">Tahun Pengadaan</label>
                <input type="number" name="tahun_pengadaan" class="form-control" value="<?php echo $brg['tahun_pengadaan'] ?>" id="inputSuccess" placeholder="Tahun ...">
              </div>

              <div class="form-group">
                <label class="control-label">Tanggal Datang</label>
                <input type="date" name="tgl_datang" value="<?php echo $brg['tgl_datang'] ?>" class="form-control" placeholder="tgl datang ...">
              </div>

              <div class="form-group">
                <label class="control-label"> Spesifikasi</label>
                <textarea class="form-control" name="spesifikasi" placeholder=" spek barang..."><?php echo $brg['spesifikasi'] ?></textarea>
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
          url: "<?php echo base_url('admin/brg_masuk/getbarang') ?>",
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