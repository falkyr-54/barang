 <style>
  #imagePreview {
    width: 150px;
    height: 150px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
  }
</style>
<script type="text/javascript">
  $(function() {
    $("#file").on("change", function()
    {
      var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
              $("#imagePreview").css("background-image", "url("+this.result+")");
            }
          }
        });
  });
</script>


<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
  echo '<div class="alert alert-warning">'.$error.'</div>';   
}
?>

<div class="box-header with-border">
  <a href="<?php echo base_url('admin/master_barang') ?>" class="btn btn-sm btn-primary pull-right">
  Kembali</a> 
</div>

<div class="body">
  <form name="form1" method="post" action="<?php echo base_url('admin/detil_barang/ubah/'.$barang['id_detil'].'/'.$id_barang.'/'.$id_jenis) ?>" enctype="multipart/form-data">
   <div class="box-body">
     <div class="col-md-6">

      <label for="username">Merk</label>
      <div class="form-group">
        <div class="form-line">
          <input type="text" class="form-control" placeholder="" name="kd_barang" autocomplete="off" value="<?php echo $barang['kd_barang'] ?>">
        </div>
      </div>

      <label for="username">Type</label>
      <div class="form-group">
        <div class="form-line">
          <input type="text" class="form-control" placeholder="" name="tahun" autocomplete="off" value="<?php echo $barang['tahun'] ?>">
        </div>
      </div>

      <div class="form-group">
        <label>Upload gambar baru</label>
        <input type="file" name="gambar" class="form-control" id="file">
        <div id="imagePreview"></div>
      </div>
    </div>
    
    <div class="col-md-6">
      <label>Gambar sebelumnya</label><br>
      <img src="<?php echo base_url('assets/upload/image/'.$barang['gambar']) ?>" style="max-width:200px; height:auto;">
    </div>
  </div>
</div>

<div class="box-footer" style="text-align:left">
  <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
  <input type="reset" name="reset" value="Reset" class="btn btn-warning btn-md">
</div>

</form>
</div>
