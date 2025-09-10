<?php
// Check error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Error upload file
if (isset($error)) {
  echo '<div class="alert alert-warning">' . $error . '</div>';
}
?>


<form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/tambah/' . $barang['id_barang'] . '/' . $id_satker) ?>" enctype="multipart/form-data">

  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Barang Masuk</h3>
    </div>

    <div class="box-body">

      <?php if ($this->session->userdata('level') == "pptk") { ?>
        <!-- ============= TAMPIL UNTUK PPTK ============= -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
              value="<?php echo $barang['nama_barang'] ?>" readonly>
            <input type="hidden" name="id_barang" value="<?php echo  $barang['id_barang'] ?>">

          </div>

          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" name="jumlah" class="form-control" placeholder="Qty">
          </div>
          <div class="form-group">
            <label>Tanggal Permintaan</label>
            <input type="date" name="tgl_permintaan" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>

        </div>

      <?php } else { ?>
        <!-- ============= TAMPIL UNTUK ADMIN ============= -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Rekanan</label>
            <select name="id_rekanan" class="form-control select2" style="width: 100%;">
              <?php foreach ($rekanan as $key => $value): ?>
                <option value="<?php echo $value['id_rekanan'] ?>"><?php echo $value['nama_rekanan'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
              value="<?php echo $barang['nama_barang'] ?>" readonly>
            <input type="hidden" name="id_barang" value="<?php echo  $barang['id_barang'] ?>">
          </div>

          <div class="form-group">
            <label>Upload gambar</label>
            <input type="file" name="gambar" class="form-control">
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-lg-6">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah">
              </div>
              <div class="col-lg-6">
                <label>Satuan</label>
                <input type="text" class="form-control"
                  value="<?php echo $barang['satuan'] ?>" readonly>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Tanggal Permintaan</label>
            <input type="date" name="tgl_permintaan" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="form-group">
            <label>Harga Satuan</label>
            <input type="text" name="harga" class="form-control" placeholder="Rp...">
          </div>

          <div class="form-group">
            <label class="control-label">Nilai Pesanan</label>
            <input type="text" readonly name="nilai_pesanan" class="form-control">
          </div>

          <div class="form-group">
            <label>TKDN</label>
            <input type="text" name="tkdn" class="form-control" placeholder="TKDN">
          </div>

          <div class="form-group">
            <label>ID Paket Ekatalog</label>
            <input type="text" name="id_paket_ekatalog" class="form-control">
          </div>

          <div class="form-group">
            <label class="control-label">ED Barang</label>
            <input type="date" name="ed_barang" class="form-control">
          </div>

          <div class="form-group">
            <label class="control-label">Tahun Pengadaan</label>
            <input type="number" name="tahun_pengadaan" class="form-control" placeholder="Tahun ...">
          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group">
            <label>Sumber pengadaan</label>
            <select name="sumber" class="form-control select2" style="width: 100%;">
              <option value="">Pilih Rekanan</option>
              <option value="apbd">APBD</option>
              <option value="blud">BLUD</option>
              <option value="hibah">Hibah</option>
            </select>
          </div>

          <div class="form-group">
            <label>Jenis Pemesanan</label>
            <select name="jenis_pemesanan" class="form-control select2" style="width: 100%;">
              <option value="">Pilih Jenis</option>
              <option value="pdn">PDN</option>
              <option value="impor">IMPOR</option>
            </select>
          </div>

          <div class="form-group">
            <label>Metode Pengadaan</label>
            <select name="metode_pengadaan" class="form-control select2" style="width: 100%;">
              <option value="">Pilih Metode</option>
              <option value="epurchasing">Epurchasing</option>
              <option value="pl">PL</option>
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal Datang</label>
            <input type="date" name="tgl_datang" class="form-control">
          </div>

          <div class="form-group">
            <label class="control-label">Tanggal SP</label>
            <input type="date" name="tgl_sip" class="form-control">
          </div>

          <div class="form-group">
            <label>NO SP</label>
            <input type="text" name="no_sp" class="form-control">
          </div>

          <div class="form-group">
            <label class="control-label">No Batch / Lot Barang</label>
            <input type="text" name="no_batch" class="form-control">
          </div>

          <div class="form-group">
            <label class="control-label">Jenis BAST</label>
            <select name="jenis_bast" id="jenis_bast" class="form-control select2" style="width: 100%;">
              <option value="">Pilih Jenis</option>
              <option value="level1">Level 1 (7 Sampai 14 Hari)</option>
              <option value="level2">Level 2 (14 Sampai 30 Hari)</option>
              <option value="level3">Level 3 (30 Sampai 90 Hari)</option>
            </select>
          </div>

          <div class="form-group">
            <label>Tanggal BAST</label>
            <input type="text" id="kalender-bast" name="tgl_bast" class="form-control" placeholder="Pilih tanggal">
            <small id="range-info" class="text-muted"></small>

            <!-- hidden input untuk DB -->
            <input type="hidden" name="tgl_bast_start" id="tgl_bast_start">
            <input type="hidden" name="tgl_bast_end" id="tgl_bast_end">
          </div>



          <div class="form-group">
            <label class="control-label">No BAST</label>
            <input type="text" name="no_bast" class="form-control">
          </div>



          <div class="form-group">
            <label class="control-label">Spesifikasi</label>
            <textarea class="form-control" name="spesifikasi"></textarea>
          </div>
        </div>
      <?php } ?>

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
    var calendar = flatpickr("#kalender-bast", {
      mode: "single",
      dateFormat: "Y-m-d",
      clickOpens: false, // nonaktif sebelum pilih jenis
      onChange: function(selectedDates) {
        if (selectedDates.length > 0) {
          $("#tgl_bast_start").val(flatpickr.formatDate(selectedDates[0], "Y-m-d"));
        }
      }
    });

    $("#jenis_bast").on("change", function() {
      var jenis = $(this).val();
      var today = new Date();

      var minDate, maxDate;

      if (jenis === "level1") {
        minDate = new Date(today);
        maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 14); // 24/9/2025
      }

      if (jenis === "level2") {
        minDate = new Date(today);
        minDate.setDate(today.getDate() + 15); // 25/9/2025
        maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 30); // 10/10/2025
      }

      if (jenis === "level3") {
        minDate = new Date(today);
        minDate.setDate(today.getDate() + 31); // 11/10/2025
        maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 90); // 9/12/2025
      }

      if (jenis) {
        calendar.set("clickOpens", true);
        calendar.set("minDate", minDate);
        calendar.set("maxDate", maxDate);

        // default pilih minDate
        calendar.setDate(minDate);

        // isi hidden input otomatis
        $("#tgl_bast_start").val(flatpickr.formatDate(minDate, "Y-m-d"));
        $("#tgl_bast_end").val(flatpickr.formatDate(maxDate, "Y-m-d"));

        // tampilkan info range
        function formatView(d) {
          const bulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
          ];
          return d.getDate() + " " + bulan[d.getMonth()] + " " + d.getFullYear();
        }

        $("#range-info").text("Range tanggal: " + formatView(minDate) + " s/d " + formatView(maxDate));
      } else {
        calendar.clear();
        calendar.set("clickOpens", false);
        $("#tgl_bast_start").val("");
        $("#tgl_bast_end").val("");
        $("#range-info").text("Pilih jenis BAST terlebih dahulu");
      }
    });

    function hitungNilaiPesanan() {
      var jumlah = parseFloat($("input[name='jumlah']").val()) || 0;
      var harga = parseFloat($("input[name='harga']").val()) || 0;
      var total = jumlah * harga;

      $("input[name='nilai_pesanan']").val(total);
    }

    // Jalankan saat user mengetik jumlah atau harga
    $("input[name='jumlah'], input[name='harga']").on("input", function() {
      hitungNilaiPesanan();
    });
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