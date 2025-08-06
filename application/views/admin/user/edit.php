<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
	echo '<div class="alert alert-warning">'.$error.'</div>';	
}
?>

<form name="form1" method="post" action="<?php echo base_url('admin/user/edit/'.$user['id_user']) ?>" enctype="multipart/form-data">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">

        <div class="col-md-12">
          <h3 class="box-title">Data User</h3>
        </div>
        <br>
        <br>

        <div class="col-md-12">

          <div class="col-md-4">

           <div class="form-group has-warning">
            <label>Satker</label>
            <select class="form-control" name="id_satker">
              <option value="">Pilih Satker</option>
              <?php foreach($satker as $satker) { ?>
                <option value="<?php echo $satker['id_satker'] ?>" <?php if($user['id_satker']==$satker['id_satker']) { echo "selected"; } ?>>
                  <?php echo $satker['nama_satker'] ?>
                </option>
              <?php } ?>
            </select>
          </div>


          <div class="form-group has-warning">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_user" class="form-control" value="<?php echo $user['nama_lengkap'] ?>" placeholder="Cari nama pegawai..." required id="nama_lengkap">
          </div>

          <div class="form-group" hidden="">
            <label>ID</label>
            <input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $user['id_pegawai'] ?>" placeholder="NIP pegawai Pengganti" required id="id_pegawai" readonly>
          </div>

          <div class="form-group has-warning">
            <label>Akses Level</label>
            <select class="form-control" name="akses_level">
              <option value="admin" <?php if ($user['akses_level']=="admin") { echo "Selected"; } ?>>admin</option>
              <option value="kelurahan" <?php if ($user['akses_level']=="kelurahan") { echo "Selected"; } ?>>kelurahan</option>
            </option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group has-warning">
          <label>username</label>
          <input type="text" name="username" class="form-control" placeholder="" value="<?php echo $user['username'] ?>" required>
        </div>

        <div class="form-group has-warning">
          <label>Password</label>
          <input type="text" name="password" class="form-control" placeholder="" value="<?php echo $user['password_hint'] ?>" required>
        </div>
      </div>

    </div>

  </div>
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

