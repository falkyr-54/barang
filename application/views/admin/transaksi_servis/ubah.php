 <?php
// Check error
 echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
 if(isset($error)) {
  echo '<div class="alert alert-warning">'.$error.'</div>';   
}
?>

<!-- DATA PRIBADI -->
<div class="box-header with-border">
  <a href="<?php echo base_url('admin/transaksi_servis') ?>" class="btn btn-sm btn-primary pull-right">
  Kembali</a> 
  <h3 class="box-title"><i class="fa fa-tag"></i> Update data perbaikan</h3>
</div>

<div class="body">
  <form name="form1" method="post" action="<?php echo base_url('admin/transaksi_servis/ubah/'.$servis['id_servis']) ?>" enctype="multipart/form-data">
   <div class="box-body">
    <div class="col-md-6">

      <label>Nama Barang</label>
      <div class="form-group">
        <div class="form-line">
          <input type="text" class="form-control" placeholder="🔍 Barang" name="nama_barang" id="nama_barang" value="<?php echo $servis['merk'].'-'.$servis['type'].'-'.$servis['kd_barang'].'-'.$servis['nama_satker'].'-'.$servis['unit'] ?>" readonly>
        </div>
      </div>

      <div class="form-group">
        <input type="hidden" name="id_jenis" class="form-control" value="<?php echo $servis['id_jenis'] ?>" placeholder="id jenis" required id="jenis" readonly>
      </div>

      <div class="form-group">
        <input type="hidden" name="id_detil" class="form-control" value="<?php echo $servis['id_detil'] ?>" placeholder="id detil" required id="id_detil" readonly>
      </div>

      <div class="form-group">
        <input type="hidden" name="id_unit" class="form-control" value="<?php echo $servis['id_unit'] ?>" placeholder="id detil" required id="id_unit" readonly>
      </div>

      <div class="form-group">
        <input type="hidden" name="id_satker" class="form-control" value="<?php echo $servis['id_satker'] ?>" placeholder="id detil" required id="id_satker" readonly>
      </div>

      <label for="username">Kerusakan</label>
      <div class="form-group">
        <textarea name="kerusakan" class="form-control" placeholder="misal: blue screen, roll print patah dll"><?php echo $servis['kerusakan'] ?></textarea>
      </div>

      <div class="form-group">
        <input type="number" name="harga" class="form-control" value="<?php echo $servis['harga'] ?>" placeholder="biaya servis" required>
      </div>

      <label for="username">Perbaikan/Sparepart yang diganti</label>
      <div class="form-group">
        <textarea name="keterangan" class="form-control" placeholder="misal: ganti roll, ganti ram dll"><?php echo $servis['keterangan'] ?></textarea>
      </div>

    </div>

    <div class="col-md-6">

      <label>Rekanan</label>
      <div class="form-group">
        <div class="form-line">
          <select name="id_rekanan" class="form-control">
            <?php foreach($rekanan as $rekanan) { ?>
              <option value="<?php echo $rekanan['id_rekanan'] ?>" class="<?php echo $rekanan['id_rekanan'] ?>">
                <?php echo $rekanan['nama_rekanan'] ?></option>
              <?php } ?>

            </select>
          </div>
        </div>

        <label>Status Servis</label>
        <div class="form-group">
          <div class="form-line">
            <select name="status" class="form-control">
              <option value="di kerjakan" <?php if ($servis['status']=="proses") { echo "selected"; } ?>>Sedang Proses</option>
              <option value="selesai" <?php if ($servis['status']=="selesai") { echo "selected"; } ?>>Selesai</option>
            </select>
          </div>
        </div>

        <label>Tanggal Servis</label>
        <div class="form-group">
          <div class="form-line">
            <input type="text" class="form-control datepicker" placeholder="tanggal servis" name="tgl_servis" value="<?php echo $servis['tgl_servis'] ?>" autocomplete="off"> 
          </div>
        </div>

        <label>Tanggal Selesai</label>
        <div class="form-group">
          <div class="form-line">
            <input type="text" class="form-control datepicker" placeholder="tanggal selesai" name="tgl_selesai" value="<?php echo $servis['tgl_selesai'] ?>" autocomplete="off"> 
          </div>
        </div>

        <label>Petugas penyerahan barang(rekanan)</label>
        <div class="form-group">
          <div class="form-line">
            <input type="text" class="form-control" placeholder="" name="pemberi_servis" value="<?php echo $servis['pemberi_servis'] ?>" autocomplete="off"> 
          </div>
        </div>

        <label>Petugas Penerima barang(IT)</label>
        <div class="form-group">
          <div class="form-line">
            <input type="text" class="form-control" placeholder="" name="penerima_it" value="<?php echo $servis['penerima_it'] ?>" autocomplete="off"> 
          </div>
        </div>


      </div>
    </div>


  </div>

  <div class="box-footer" style="text-align:left">
    <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
    <input type="reset" name="reset" value="Reset" class="btn btn-warning btn-md">
  </div>

</form>
</div>

<script>
  $(function() {
    $( ".datepicker" ).datepicker({
     changeYear: true,
     changeMonth: true,
     yearRange: "2021:<?php echo date('Y') ?>",
     dateFormat: "yy-mm-dd"
   });
  });
</script>

<script>
  $(function() {                     
    $( "#type" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/transaksi_servis/getbarang') ?>",
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
        $("#id_detil").val(ui.item.value);
        $("#jenis").val(ui.item.jenis);
        $("#id_unit").val(ui.item.unit);
        $("#id_satker").val(ui.item.satker);
      },

    });
  }); 
</script>  
