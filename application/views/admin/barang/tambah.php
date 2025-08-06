<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
	echo '<div class="alert alert-warning">'.$error.'</div>';	
}
?>

<form name="form1" method="post" action="<?php echo base_url('admin/barang/tambah') ?>" enctype="multipart/form-data">
    <div class="col-md-12">

        <div class="box box-primary">
            <div class="box-header with-border">

                <div class="col-md-12">
                    <h3 class="box-title">Data Barang</h3>
                </div>
                <br>
                <br>

                <div class="col-md-12">
                    <div class="col-md-4">
                     <div class="form-group has-warning">
                        <label>Jenis Barang</label>
                        <select class="form-control" name="id_jenis">
                            <option value="">Pilih Jenis Barang</option>
                            <?php foreach ($jenis_brg as $jenis_brg) { ?>
                                <option value="<?php echo $jenis_brg['id_jenis'] ?>"
                                    <?php if(isset($_POST['id_jenis']) && $_POST['id_jenis']==$jenis_brg['id_jenis']) { 
                                        echo "selected"; } ?>><?php echo $jenis_brg['nama_jenis'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                   
                   <div class="col-md-4">
                    <div class="form-group has-warning">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" placeholder="misal:001" value="<?php echo set_value('kode_barang') ?>" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group has-warning">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="misal: Kertas HVS F4" value="<?php echo set_value('nama_barang') ?>" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group has-warning">
                        <label>Satuan</label>
                        <select class="form-control" name="id_satuan">
                            <option  value="">-Pilih Satuan-</option>
                            <?php foreach ($satuan as $satuan) { ?>
                                <option value="<?php echo $satuan['id_satuan'] ?>"
                                    <?php if(isset($_POST['id_satuan']) && $_POST['id_satuan']==$satuan['id_satuan']) { 
                                        echo "selected"; } ?>><?php echo $satuan['satuan'] ?>
                                    </option>
                                <?php } ?>
                            </select>
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


