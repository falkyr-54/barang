<?php
// Validasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

?>

<form name="form1" method="post" action="<?php echo base_url('admin/penempatan/tambah'.'/'.$id_unit.'/'.$id_satker) ?>" enctype="multipart/form-data">

  <div class="form-group" hidden="">
    <label>Nama Unit</label>
    <input type="text" name="id_unit" class="form-control" value="<?php echo $id_unit ?>" required readonly>
  </div>

  <div class="form-group" hidden="">
    <label>Nama Satker</label>
    <input type="text" name="id_satker" class="form-control" value="<?php echo $id_satker ?>" required readonly>
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


<div class="form-group">
  <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
  <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
</div>
<div class="clearfix"></div>

<?php
// Form close 
echo form_close();
?>


<p class="text-right">
  <a href="<?php echo base_url('admin/penempatan/list_unit'.'/'.$id_satker) ?>" class="btn btn-info btn-xs"><i class="fa fa-backward"></i> Kembali ke menu awal</a>
</p>

<div class="table-responsive mailbox-messages">
 <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama Barang</th>
      <th>Kode barang</th>
      <th>Tanggal Penempatan</th>
      <th>Penerima</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($tempat as $tempat) { ?>
      <tr>
        <td><?php echo $i ?></td>
        <td>
          <?php if($tempat['gambar']=="") { echo "No photo"; }else{ ?>
            <img src="<?php echo base_url('assets/upload/image/thumbs/'.$tempat['gambar']) ?>" style="max-width: 50px; height:auto;">
          <?php } ?>
        </td>
        <td><?php echo $tempat['merk'].' '.$tempat['type'] ?> </td>
        <td><?php echo $tempat['kd_barang'] ?></td>
        <td><?php echo $tempat['tgl_penempatan'] ?></td>
        <td><?php echo $tempat['penerima'] ?></td>
        <td><a href="<?php echo base_url('admin/penempatan/ubah/'.$tempat['id_tempat']) ?>" class="btn btn-warning btn-xs">Ubah</a>
        </td>
      </tr>
      <?php $i++; } ?> 
    </tbody>
  </table>

</div>
<!-- /.mail-box-messages -->




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