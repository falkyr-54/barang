<script src="<?php echo base_url('assets/js/jquery.chained.js') ?>"></script>

<script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else { 
      if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET","<?php echo base_url('admin/jabatan/angka') ?>/"+str,true);
          xmlhttp.send();
        }
      }
    </script>
    <?php
    echo validation_errors('<div class="alert alert-warning">','</div>');
// Error upload file
    if(isset($error)) {
     echo '<div class="alert alert-warning">'.$error.'</div>';	
   }
   ?>

   <form method="post" action="<?php echo base_url('admin/jabatan/add/'.$pegawai['nip']) ?>" enctype="multipart/form-data">

    <div class="col-md-6">

     <div class="form-group">
      <label>Status Barang</label>
      <select class="form-control"  name="status_jabatan">
       <option value="Aktif">Aktif, masih berlaku</option>
       <option value="Non Aktif">Non aktif, sudah tidak berlaku</option>
     </select>
   </div>

   <div class="form-group">
    <label>Nama lengkap (NIP)</label>
    <input type="text" name="nama" value="<?php echo $pegawai['nama_lengkap'].' ('.$pegawai['nip'].')'; ?>" class="form-control" required disabled>
  </div>


  <div class="form-group">
    <label>Kategori jabatan</label>
    <select name="id_satker" class="form-control" id="id_satker"  onchange="showUser(this.value)">
    	<option value="">-Pilih-</option>

      <?php foreach($kategori as $kategori) { ?>
        <option value="<?php echo $kategori['id_satker'] ?>" 

          <?php if(isset($_POST['id_satker']) && $_POST['id_satker']==$kategori['id_satker']) { 
            echo "selected"; } ?>
            >
            <?php echo $kategori['nama_kategori'] ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <label>Jabatan</label>
        <select name="id_sub_kategori" class="form-control" id="id_sub_kategori">
         <option value="">-Pilih Jabatan-</option>

         <?php foreach($sub as $sub) { ?>
          <option value="<?php echo $sub['id_sub_kategori'] ?>" class="<?php echo $sub['id_kategori'] ?>" 

            <?php if(isset($_POST['id_sub_kategori']) && $_POST['id_sub_kategori']==$sub['id_sub_kategori']) { 
              echo "selected"; } ?> 

              >
              <?php echo $sub['nama_sub_kategori'] ?></option>
            <?php } ?>

          </select>
        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">
          <label>Upload Scan/File SK</label>
          <input type="file" name="gambar" class="form-control">
        </div>


        <div class="form-group" id="txtHint">
          <label>Angka Kredit</label>
          <input type="text" name="angka_kredit" class="form-control" placeholder="Angka kredit" value="<?php echo set_value('angka_kredit') ?>" readonly>
        </div>

        <div class="form-group">
          <label>TMT Jabatan (Terhitung Mulai Tanggal)</label>
          <input type="text" name="tmt" class="form-control datepicker" placeholder="YYYY-MM-DD" value="<?php echo set_value('tmt') ?>">
        </div>

        <div class="form-group">
          <label>Nama pejabat penandatangan SK</label>
          <input type="text" name="nama_pejabat" class="form-control" placeholder="Nama pejabat" value="<?php echo set_value('nama_pejabat') ?>">
        </div>

        <div class="form-group">
          <label>NIP pejabat penandatangan SK</label>
          <input type="text" name="nip_pejabat" class="form-control" placeholder="NIP pejabat" value="<?php echo set_value('nip_pejabat') ?>">
        </div>

        <div class="form-group">
          <label>Keterangan</label>
          <textarea name="keterangan" class="form-control" placeholder="Keterangan lain"><?php echo set_value('keterangan') ?></textarea>
        </div>

        <div class="form-group">
          <input type="submit" name="submit" value="Simpan Data Jabatan" class="btn btn-primary btn-lg">
          <input type="reset" name="reset" value="Reset" class="btn btn-default btn-lg">
        </div>

      </div>

    </form>

    <script>
// Koneksi jenis dengan satker
$("#id_unit").chained("#id_satker");
// $("#id_sub_kategori").chained("#id_kategori");
// Tanggal 
$(function() {
  $( ".datepicker" ).datepicker({
   changeYear: true,
   changeMonth: true,
   yearRange: "1980:<?php echo date('Y') ?>",
   dateFormat: "yy-mm-dd"
 });
});


</script>

