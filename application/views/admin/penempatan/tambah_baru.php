 <script src="<?php echo base_url('assets/js/jquery.chained.js') ?>"></script>

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
  <form name="form1" method="post" action="<?php echo base_url('admin/penempatan/tambah_baru'.'/'.$detail['id_detil']) ?>" enctype="multipart/form-data">
   <div class="box-body">
    <div class="col-md-6">

     <div class="form-group">
      <label>Kode Barang</label>
      <input type="text" name="type" class="form-control" value="<?php echo $detail['kd_barang'] ?>" placeholder="Ketik nama barang.." required id="type" disabled>
    </div>

    <div class="form-group">
      <label>Merk</label>
      <input type="text" name="type" class="form-control" value="<?php echo $detail['merk'] ?>" placeholder="" required id="type" disabled>
    </div>

    <div class="form-group">
      <label>Merk</label>
      <input type="text" name="type" class="form-control" value="<?php echo $detail['id_detil'] ?>" placeholder="" required id="type" disabled>
    </div>

    <div class="form-group">
      <label>Type</label>
      <input type="text" name="type" class="form-control" value="<?php echo $detail['type'] ?>" placeholder="" required id="type" disabled>
    </div>


    <div class="form-group">
      <!-- <label>id jenis</label> -->
      <input type="hidden" name="id_jenis" class="form-control" value="<?php echo $detail['id_jenis'] ?>" placeholder="id jenis" required id="jenis" readonly>
      <input type="hidden" name="id_detil" class="form-control" value="<?php echo $detail['id_detil'] ?>" placeholder="id jenis" required id="jenis" readonly>
    </div>

  </div>

  <div class="col-md-6">
   <label for="username">Satuan Kerja</label>
   <div class="form-group">
     <div class="form-line">
      <select name="id_satker" class="form-control" id="id_satker" onchange="showUser(this.value)">
        <?php foreach ($satker as $satker) { ?>
          <option value="<?php echo $satker['id_satker'] ?>"><?php echo $satker['nama_satker'] ?></option>
        <?php  } ?>
      </select>
    </div>
  </div>

  <label>unit</label>
  <div class="form-group">
    <select name="id_unit" class="form-control" id="id_unit" style="width: 100%;">
      <?php foreach ($unit as $key => $value):?>
        <option value="<?php echo $value['id_unit'] ?>" class="<?php echo $value['id_satker'] ?>">

          <?php echo $value['unit'] ?>

        </option>
      <?php endforeach ?>
    </select>
  </div>
  <label for="username">Tanggal penempatan baru</label>
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

</div>
</div>

<div class="box-footer" style="text-align:right">
  <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
  <input type="reset" name="reset" value="Reset" class="btn btn-warning btn-md">
</div>

</form>
</div>

<script>
  $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });

  $("#id_unit").chained("#id_satker");
</script>

