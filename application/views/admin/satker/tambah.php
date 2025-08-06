<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
	echo '<div class="alert alert-warning">'.$error.'</div>';	
}
?>

<form name="form1" method="post" action="<?php echo base_url('admin/satker/tambah') ?>" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">

                <div class="col-md-12">
                    <div class="col-md-4">

                     <div class="form-group has-warning">
                        <label>Nama Satuan Kerja</label>
                        <input type="text" name="nama_satker" class="form-control" placeholder="Puskesmas....." value="<?php echo set_value('nama_satker') ?>" required>
                    </div>

                    <div class="form-group has-warning">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="email..." value="<?php echo set_value('email') ?>" required>
                    </div>

                </div>

                <div class="col-md-4">
                   <div class="form-group has-warning">
                    <label>Telpon</label>
                    <input type="text" name="telepon" class="form-control" placeholder="telepon..." value="<?php echo set_value('telepon') ?>" required>
                </div>

                <div class="form-group has-warning">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="misal: Kertas HVS F4" value="<?php echo set_value('alamat') ?>" required>
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


