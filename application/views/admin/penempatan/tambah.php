 <?php
// Check error
 echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
 if(isset($error)) {
  echo '<div class="alert alert-warning">'.$error.'</div>';   
}
?>

<div class="box-header with-border">
 <a href="<?php echo base_url('admin/penempatan') ?>" class="btn btn-sm btn-primary pull-right">
 Kembali</a> 
</div>

<div class="body">
  <form name="form1" method="post" action="<?php echo base_url('admin/penempatan/tambah') ?>" enctype="multipart/form-data">
   <div class="box-body">
    <div class="col-md-6">

      <div class="form-group" hidden="">
        <label>Nama Unit</label>
        <input type="text" name="id_unit" class="form-control" value="<?php echo $unit ?>" required readonly>
      </div>

      <div class="form-group" hidden="">
        <label>Nama Satker</label>
        <input type="text" name="id_satker" class="form-control" value="<?php echo $satker ?>" required readonly>
      </div>

      <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="type" class="form-control" value="<?php echo set_value('type') ?>" placeholder="Ketik nama barang.." required id="type">
      </div>

       <label for="username">Tanggal penempatan</label>
      <div class="form-group">
        <div class="form-line">
         <input type="date" name="tgl_penempatan" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo set_value('tgl_penempatan') ?>">
       </div>
     </div>

     <label for="username">Penerima</label>
     <div class="form-group">
       <div class="form-line">
         <input type="text" name="penerima" class="form-control" placeholder="nama penerima" value="<?php echo set_value('penerima') ?>">
       </div>
     </div>

      <div class="form-group" hidden="">
        <label>id jenis</label>
        <input type="text" name="id_jenis" class="form-control" value="<?php echo set_value('id_jenis') ?>" placeholder="id jenis" required id="jenis" readonly>
      </div>

      <div class="form-group" hidden="">
        <label>id detil</label>
        <input type="text" name="id_detil" class="form-control" value="<?php echo set_value('id_detil') ?>" placeholder="id detil" required id="id_detil" readonly>
      </div>

    </div>
 </div>

 <div class="box-footer" style="text-align:right">
  <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
  <input type="reset" name="reset" value="Reset" class="btn btn-warning btn-md">
</div>

</form>
</div>



<script>
  $(function() {                     
    $( "#type" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/penempatan/getbarang') ?>",
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
      },

    });
  }); 
</script>  