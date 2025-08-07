<?php
// Check error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Error upload file
if (isset($error)) {
  echo '<div class="alert alert-warning">' . $error . '</div>';
}
?>


<form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/tambah/' . $barang['id_barang'] . '/' . $id_satker) ?>" enctype="multipart/form-data">


  <!--  <form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/tambah/' . $barang['id_barang']) ?>" enctype="multipart/form-data"> -->

  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Barang Masuk</h3>
    </div><!-- /.box-header -->

    <div class="box-body">
      <!-- text input -->
      <div class="col-md-6">
        <?php if ($this->session->userdata('level') == "admin") { ?>

          <div class="form-group">
            <label>Rekanan</label>
            <select name="id_rekanan" class="form-control select2" style="width: 100%;">
              <?php foreach ($rekanan as $key => $value): ?>
                <option value="<?php echo $value['id_rekanan'] ?>"><?php echo $value['nama_rekanan'] ?></option>
              <?php endforeach ?>
            </select>
          </div>



        <?php } ?>
        <!--  <div class="form-group" hidden="">
            <label>id rekanan</label>
            <input type="text" name="id_jenis" class="form-control" placeholder="Search ..." value=""  readonly>
          </div> -->


        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control" placeholder="Search ..." value="<?php echo $barang['nama_barang'] ?>" required id="nama_barang" readonly>
        </div>

        <div class="form-group" hidden="">
          <label>Nama Barang</label>
          <input type="text" name="id_jenis" class="form-control" placeholder="Search ..." value="<?php echo $barang['id_jenis'] ?>" required id="id_jenis" readonly>
        </div>

        <div class="form-group">
          <label>Upload gambar</label>
          <input type="file" name="gambar" class="form-control">
        </div>

        <div class="form-group">
          <input type="hidden" class="form-control" name="id_barang" value="<?php echo $barang['id_barang'] ?>" id="id_barang" readonly>
        </div>

        <div class="form-group">
          <div class="row">

            <div class="col-lg-6">

              <label>Jumlah</label>
              <input type="text" class="form-control" placeholder="Qty" id="jumlah" name="jumlah">
            </div>

            <div class="col-lg-6">
              <label>Satuan</label>
              <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $barang['satuan'] ?>" readonly>
            </div>
          </div>

        </div>

        <div class="form-group">
          <label>Harga Satuan</label>
          <input type="text" name="harga" id="harga" class="form-control" placeholder="Rp...">
        </div>

        <div class="form-group">
          <label>TKDN</label>
          <input type="text" name="tkdn" class="form-control" placeholder="TKDN">
        </div>

        <div class="form-group">
          <label>NO SP</label>
          <input type="text" name="no_sp" class="form-control" placeholder="NO SP ...">
        </div>
        <div class="form-group">
          <label>ID Paket Ekatalog</label>
          <input type="text" name="id_paket_ekatalog" class="form-control" placeholder="ID Paket Ekatalog ...">
        </div>
        <div class="form-group">
          <label class="control-label">ED Barang</label>
          <input type="date" name="ed_barang" value="" class="form-control" placeholder="ED Barang ...">
        </div>
        <div class="form-group">
          <label class="control-label">No BAST</label>
          <input type="text" name="no_bast" value="" class="form-control" placeholder="No BAST ...">
        </div>
        <!-- textarea -->


      </div>


      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="inputSuccess">Tahun Pengadaan</label>
          <input type="number" name="tahun_pengadaan" class="form-control" id="inputSuccess" placeholder="Tahun ...">
        </div>

        <div class="form-group">
          <label>Sumber pengadaan</label>
          <select name="sumber" class="form-control select2" style="width: 100%;">
            <option selected="selected">Pilih Rekanan</option>
            <option value="apbd">APBD</option>
            <option value="blud">blud</option>
            <option value="hibah">hibah</option>
          </select>
        </div>

        <div class="form-group">
          <label>Status Pesanan</label>
          <select name="status_pesanan" class="form-control select2" style="width: 100%;">
            <option selected="selected">Pilih Status</option>
            <option value="sudah">Sudah Datang</option>
            <option value="belum">Belum Datang</option>
          </select>
        </div>

        <div class="form-group">
          <label>Jenis Pemesanan</label>
          <select name="jenis_pemesanan" class="form-control select2" style="width: 100%;">
            <option selected="selected">Pilih Jenis</option>
            <option value="pdn">PDN</option>
            <option value="impor">IMPOR</option>
          </select>
        </div>

        <div class="form-group">
          <label>Metode Pengadaan</label>
          <select name="metode_pengadaan" class="form-control select2" style="width: 100%;">
            <option selected="selected">Pilih Metode</option>
            <option value="epurchasing">Epurchasing</option>
            <option value="pl">PL</option>
          </select>
        </div>

        <div class="form-group">
          <label class="control-label">Tanggal Datang</label>
          <input type="date" name="tgl_datang" value="<?php echo set_value('tgl_datang') ?>" class="form-control" placeholder="tgl datang ...">
        </div>

        <div class="form-group">
          <label class="control-label">Tanggal SIP</label>
          <input type="date" name="tgl_sip" value="" class="form-control" placeholder="tgl SIP ...">
        </div>

        <div class="form-group">
          <label class="control-label">Nilai Pesanan</label>
          <input type="text" readonly name="nilai_pesanan" id="nilai_pesanan" class="form-control" placeholder="Nilai Pesanan">
        </div>

        <div class="form-group">
          <label class="control-label">No Batch / Lot Barang</label>
          <input type="text" name="no_batch" value="" class="form-control" placeholder="No Batch / Lot Barang">
        </div>



        <div class="form-group">
          <label class="control-label"> Spesifikasi</label>
          <textarea class="form-control" name="spesifikasi" placeholder=" spek barang..."></textarea>
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
  $(document).ready(function() {
    //get name jumlah
    $('#harga, #jumlah').on('keyup change', function() {
      let jumlah = parseFloat($('#jumlah').val()) || 0;
      let harga = parseFloat($('#harga').val()) || 0;
      let total = jumlah * harga;

      $('#nilai_pesanan').val(total);
    });
  });

  $(function() {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>

<script>
  $(function() {
    $("#nama_barang").autocomplete({ //the recipient text field with id #username
      source: function(request, response) {
        $.ajax({
          url: "<?php echo base_url('admin/brg_masuk/getbarang') ?>",
          dataType: "json",
          data: request,
          success: function(data) {
            if (data.response == 'true') {
              response(data.message);
            }
          }
        });
      },
      minLength: 3,
      select: function(event, ui) {
        event.preventDefault();
        $(this).val(ui.item.label);
        $("#id_barang").val(ui.item.value);
        $("#satuan").val(ui.item.satuan);

      },
    });
  });
</script>