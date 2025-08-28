<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-warning">','</div>');

// Pesan sukses
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-warning">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
?>


<form name="form1" method="post" action="<?php echo base_url('admin/brg_keluar/tambah/'.$barang['id_barang'].'/'.$id_satker.'/'.$id_barang_masuk) ?>" enctype="multipart/form-data"> 

  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Barang keluar</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
      <!-- text input -->
      <div class="col-md-6">

        <div class="form-group">
          <label>Nama Pegawai</label>
          <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $pegawai['nama_lengkap'] ?>" placeholder="Cari nama pegawai..." required id="nama_lengkap" readonly>
        </div>

        <div class="form-group">
          <label>Unit Bagian</label>
          <input type="text" name="unit" class="form-control" value="<?php echo $pegawai['unit'] ?>" placeholder="Cari nama unit..." required id="unit" readonly>
        </div>

   <!--    <div class="form-group">
        <label>Unit Bagian</label>
        <input type="text" name="unit" class="form-control" value="<?php echo $pegawai['unit'] ?>" placeholder="Cari nama unit..." required id="unit">
      </div> -->

      <div class="form-group">
        <label>Id unit</label>
        <input type="text" name="id_unit" class="form-control" value="<?php echo $pegawai['id_unit'] ?>" placeholder="" required id="id_unit" readonly>
      </div>

      <div class="form-group">
        <label>id pegawai</label>
        <input type="text" name="id_pegawai" class="form-control" value="<?php echo $pegawai['id_pegawai'] ?>" placeholder="" required id="id_pegawai" readonly>
      </div>

       <div class="form-group">
        <label>id satker</label>
        <input type="text" name="id_satker" class="form-control" value="<?php echo $pegawai['id_satker'] ?>" placeholder="" required id="id_pegawai" readonly>
      </div>




      <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" placeholder="Cari ..." value="<?php echo $barang['nama_barang'] ?>" required id="nama_barang" readonly>
      </div>


      <div class="form-group">
        <label>id Barang</label>
        <input type="text" class="form-control" name="id_barang" value="<?php echo $barang['id_barang'] ?>" id="id_barang" readonly>
      </div>

      <div class="form-group">
        <label>id jenis barang</label>
        <input type="text" class="form-control" name="id_jenis" value="<?php echo $barang['id_jenis'] ?>" id="id_jenis" readonly>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-lg-6">

            <label>Jumlah</label>
            <input type="text" class="form-control" placeholder="Qty" name="jumlah_keluar">
          </div>

          <div class="col-lg-6">
            <label>Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $barang['satuan'] ?>" readonly>
          </div>
        </div>

      </div>

      <?php if ($this->session->userdata('level')=='admin') { ?>

        <div class="form-group">
          <label>Satuan Kerja (Satker)</label>
          <select name="id_satker" class="form-control">
           <option value="">Pilih Satker</option>       
           <?php foreach($satker as $satker) { ?>
             <option value="<?php echo $satker['id_satker'] ?>"
               <?php if(isset($_POST['id_satker']) && $_POST['id_satker']==$satker['id_satker']) { 
                echo "selected"; } ?> 
                >
                <?php echo $satker['nama_satker'] ?></option>
              <?php } ?>
            </select>
          </div> 

      <?php } ?>

    </div>

    <div class="col-md-6">

      <div class="form-group">
        <label>Nomor Seri</label>
        <input type="text" name="seri" class="form-control" value="<?php echo set_value('seri') ?>" placeholder="jika tidak ada isi 0">
      </div>

      <div class="form-group">
        <label>Nomor AKL/AKD</label>
        <input type="text" name="akl" class="form-control" value="<?php echo set_value('seri') ?>" placeholder="jika tidak ada isi 0">
      </div>

      <div class="form-group">
        <label>Daya</label>
        <input type="text" name="daya" class="form-control" value="<?php echo set_value('seri') ?>" placeholder="jika tidak ada isi 0">
      </div>



      <div class="form-group">
        <label class="control-label">Tanggal Permintaan</label>
        <input type="date" name="tanggal_minta" value="<?php echo set_value('tanggal_minta') ?>" class="form-control" placeholder="...">
      </div>
     <!--    <div class="form-group">
          <label class="control-label">Tanggal Expired</label>
          <input type="date" name="tanggal_exp" value="<?php echo set_value('tanggal_exp') ?>" class="form-control" placeholder="...">
        </div> -->

        <div class="form-group">
          <label class="control-label"> Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="..."></textarea>
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
  $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>    

    <script>
      $(function() {                     
    $( "#unit" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/brg_keluar/getunit') ?>",
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
        $("#id_unit").val(ui.item.value);
      },

    });
  }); 
</script>  

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
        $("#id_unit").val(ui.item.depan);
      },

    });
  }); 
</script>