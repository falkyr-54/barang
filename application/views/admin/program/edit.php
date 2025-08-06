<?php
echo validation_errors('<div class="alert alert-warning">','</div>');
?>
<form action="<?php echo base_url('admin/program/edit/'.$program['id_program']) ?>" method="post">
        
<div class="col-md-6">

<div class="form-group">


<div class="form-group">
<label>Nama Program</label>
<input type="text" name="nama" class="form-control" value="<?php echo $program['nama'] ?>" placeholder="Ubah Nama" required>
</div>    

</div>

<div class="col-md-12">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
<input type="reset" name="reset" class="btn btn-primary" value="Reset">
</div>
</div>

</form>