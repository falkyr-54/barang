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
  <h3 class="box-title"><i class="fa fa-tag"></i> Input data perbaikan</h3>
</div>

<div class="body">
  <form name="form1" method="post" action="<?php echo base_url('admin/transaksi_servis/tambah/') ?>" enctype="multipart/form-data">
   <div class="box-body">
    <div class="col-md-6">

      <label>Nama Barang</label>
      <div class="form-group">
        <div class="form-line">
          <input type="text" class="form-control" placeholder="🔍 Barang" name="nama_barang" id="type" value="<?php echo set_value('nama') ?>">
        </div>
      </div>

      <div class="form-group">
        <input type="hidden" name="id_barang_keluar" class="form-control" value="<?php echo set_value('id_barang_keluar') ?>" placeholder="" required id="id_barang_keluar" readonly>
      </div>

      <div class="form-group">
        <input type="text" name="nm_unit" class="form-control" value="<?php echo set_value('nm_unit') ?>" placeholder="" required id="nm_unit" readonly>
      </div>

      <div class="form-group">
        <input type="text" name="satker" class="form-control" value="<?php echo set_value('satker') ?>" placeholder="" required id="satker" readonly>
      </div>

      <div class="form-group">
        <input type="text" name="nm_barang" class="form-control" value="<?php echo set_value('nm_barang') ?>" placeholder="" required id="nm_barang" readonly>
      </div>

       <div class="form-group">
        <input type="hidden" name="id_unit" class="form-control" value="<?php echo set_value('id_unit') ?>" placeholder="" required id="id_unit" readonly>
      </div>

       <div class="form-group">
        <input type="hidden" name="id_satker" class="form-control" value="<?php echo set_value('id_satker') ?>" placeholder="" required id="id_satker" readonly>
      </div>

      <label for="username">Kerusakan</label>
      <div class="form-group">
        <textarea name="kerusakan" class="form-control" placeholder="misal: blue screen, roll print patah dll"><?php echo set_value('keluhan') ?></textarea>
      </div>

    </div>

    <div class="col-md-6">

     <label for="username">Rekanan</label>
     <div class="form-group">
      <select name="id_rekanan" class="form-control select2" style="width: 100%;">
        <option selected="selected">Pilih Rekanan</option>
        <?php foreach ($rekanan as $rekanan) { ?>
          <option value="<?php echo $rekanan['id_rekanan'] ?>"><?php echo $rekanan['nama_rekanan'] ?></option>
        <?php } ?>
      </select>
    </div>

    <label>Tanggal Servis</label>
    <div class="form-group">
      <div class="form-line">
        <input type="text" class="form-control datepicker" placeholder="tanggal servis" name="tgl_servis" value="<?php echo set_value('tgl_servis') ?>" autocomplete="off"> 
      </div>
    </div>

    <label>Petugas penyerahan barang</label>
    <div class="form-group">
      <div class="form-line">
        <input type="text" class="form-control" placeholder="" name="pemberi_it" value="<?php echo set_value('pemberi_it') ?>" autocomplete="off"> 
      </div>
    </div>

    <label>Petugas Pengambil barang</label>
    <div class="form-group">
      <div class="form-line">
        <input type="text" class="form-control" placeholder="" name="penerima_servis" value="<?php echo set_value('penerima_servis') ?>" autocomplete="off"> 
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
        $("#id_barang_keluar").val(ui.item.value);
        $("#nm_unit").val(ui.item.nu);
        $("#satker").val(ui.item.sat);
        $("#nm_barang").val(ui.item.bar);
        $("#id_unit").val(ui.item.unit);
        $("#id_satker").val(ui.item.satker);
      },

    });
  }); 
</script>  