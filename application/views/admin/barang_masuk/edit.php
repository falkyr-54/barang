<?php
// Tampilkan error validasi
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Tampilkan error upload file jika ada
if (isset($error)) {
    echo '<div class="alert alert-warning">' . $error . '</div>';
}

// Tentukan readonly otomatis
$today = date('Y-m-d');
$readonly = false;

// jika hari ini sudah lewat tanggal_bast_akhir
if (!empty($brg['tanggal_bast_akhir']) && $today > $brg['tanggal_bast_akhir']) {
    $readonly = false; // semua bisa diedit
    $brg['jenis_bast'] = 'level2'; // override jenis_bast jadi level2
} else {
    $readonly = ($brg['jenis_bast'] == 'level1'); // behavior normal
}
?>

<sup>
    <a href="<?php echo base_url('admin/barang/riwayat/' . $brg['id_barang'] . '/' . $brg['id_satker']) ?>" class="btn btn-warning btn-sm">
        <i class="fa fa-angle-double-left"></i> Kembali
    </a>
</sup>

<form name="form1" method="post" action="<?php echo base_url('admin/Brg_masuk/edit/' . $brg['id_barang_masuk']) ?>" enctype="multipart/form-data">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Barang Masuk</h3>
        </div>
        <div class="box-body">

            <!-- Kolom Kiri -->
            <div class="col-md-6">

                <!-- Rekanan (hanya admin) -->
                <?php if ($this->session->userdata('level') == "admin") { ?>
                    <div class="form-group">
                        <label>Rekanan</label>
                        <select name="id_rekanan" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Pilih Rekanan</option>
                            <?php foreach ($rekanan as $rekanan) { ?>
                                <option value="<?php echo $rekanan['id_rekanan'] ?>" <?= ($brg['id_rekanan'] == $rekanan['id_rekanan']) ? 'selected' : ''; ?>>
                                    <?php echo $rekanan['nama_rekanan'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <!-- Nama Barang -->
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Search ..." value="<?php echo $brg['nama_barang'] ?>" required id="nama_barang" readonly>
                </div>

                <input type="hidden" name="id_barang" value="<?php echo $brg['id_barang'] ?>" id="id_barang" readonly>

                <!-- Upload Gambar -->
                <div class="form-group">
                    <label>Upload gambar</label>

                    <!-- Preview gambar lama -->
                    <?php if (!empty($brg['gambar'])): ?>
                        <div id="preview-lama" style="margin-bottom:10px;">
                            <img src="<?php echo base_url('assets/upload/image/' . $brg['gambar']); ?>" alt="Gambar Barang" style="max-height:150px; border:1px solid #ccc; padding:3px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Belum ada gambar</p>
                    <?php endif; ?>

                    <!-- Input upload -->
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" <?= $readonly ? 'disabled' : ''; ?>>

                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>

                    <!-- Preview gambar baru -->
                    <div id="preview-baru" style="margin-top:10px; display:none;">
                        <p class="text-muted">Preview gambar baru:</p>
                        <img id="img-preview" src="#" alt="Preview" style="max-height:150px; border:1px solid #ccc; padding:3px;">
                    </div>
                </div>

                <!-- Jumlah dan Satuan -->
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" placeholder="Qty" name="jumlah" value="<?php echo $brg['jumlah'] ?>">
                    </div>
                    <div class="col-lg-6">
                        <label>Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $brg['satuan'] ?>" readonly>
                    </div>
                </div>

                <!-- Tanggal Permintaan -->
                <div class="form-group">
                    <label>Tanggal Permintaan</label>
                    <input type="date" name="tgl_permintaan" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>

                <!-- Harga, Nilai Pesanan, TKDN, ID Paket -->
                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="text" name="harga" class="form-control" value="<?php echo $brg['harga_satuan'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label class="control-label">Nilai Pesanan</label>
                    <input type="text" readonly name="nilai_pesanan" class="form-control" value="<?php echo $brg['nilai_pesenan'] ?>" placeholder="Rp...">
                </div>
                <div class="form-group">
                    <label>TKDN</label>
                    <input type="text" name="tkdn" class="form-control" placeholder="TKDN" value="<?php echo $brg['tkdn'] ?>">
                </div>
                <div class="form-group">
                    <label>ID Paket Ekatalog</label>
                    <input type="text" name="id_paket_ekatalog" class="form-control" value="<?php echo $brg['id_paket_ekatalog'] ?>" placeholder="ID Paket ...">
                </div>

                <!-- ED Barang & Tahun Pengadaan -->
                <div class="form-group">
                    <label class="control-label">ED Barang</label>
                    <input type="date" name="ed_barang" class="form-control" value="<?php echo $brg['ed_barang'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Tahun Pengadaan</label>
                    <input type="number" name="tahun_pengadaan" class="form-control" value="<?php echo $brg['tahun_pengadaan'] ?>" id="inputSuccess" placeholder="Tahun ...">
                </div>

            </div> <!-- End Kolom Kiri -->

            <!-- Kolom Kanan -->
            <div class="col-md-6">

                <!-- Sumber Pengadaan -->
                <div class="form-group">
                    <label>Sumber pengadaan</label>
                    <select name="sumber" class="form-control select2" style="width: 100%;">
                        <option value="">Pilih Rekanan</option>
                        <option value="apbd" <?= ($brg['sumber'] == 'apbd') ? 'selected' : ''; ?>>APBD</option>
                        <option value="blud" <?= ($brg['sumber'] == 'blud') ? 'selected' : ''; ?>>BLUD</option>
                        <option value="hibah" <?= ($brg['sumber'] == 'hibah') ? 'selected' : ''; ?>>Hibah</option>
                    </select>
                </div>

                <!-- Jenis Pemesanan -->
                <div class="form-group">
                    <label>Jenis Pemesanan</label>
                    <select name="jenis_pemesanan" class="form-control select2" style="width: 100%;">
                        <option value="">Pilih Jenis</option>
                        <option value="pdn" <?= ($brg['jenis_pemesanan'] == 'pdn') ? 'selected' : ''; ?>>PDN</option>
                        <option value="impor" <?= ($brg['jenis_pemesanan'] == 'impor') ? 'selected' : ''; ?>>IMPOR</option>
                    </select>
                </div>

                <!-- Metode Pengadaan -->
                <div class="form-group">
                    <label>Metode Pengadaan</label>
                    <select name="metode_pengadaan" class="form-control select2" style="width: 100%;">
                        <option value="">Pilih Metode</option>
                        <option value="epurchasing" <?= ($brg['metode_pengadaan'] == 'epurchasing') ? 'selected' : ''; ?>>Epurchasing</option>
                        <option value="pl" <?= ($brg['metode_pengadaan'] == 'pl') ? 'selected' : ''; ?>>PL</option>
                    </select>
                </div>

                <!-- Tanggal Datang & SP -->
                <div class="form-group">
                    <label class="control-label">Tanggal Datang</label>
                    <input type="date" name="tgl_datang" class="form-control" value="<?php echo $brg['tgl_datang'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label class="control-label">Tanggal SP</label>
                    <input type="date" name="tgl_sip" class="form-control" value="<?php echo $brg['tgl_sip'] ?>" placeholder="tgl sip ...">
                </div>
                <div class="form-group">
                    <label>NO SP</label>
                    <input type="text" name="no_sp" class="form-control" value="<?php echo $brg['no_sp'] ?>" placeholder="No SP ...">
                </div>
                
                <!-- id_jenis -->
                <div class="form-group">
                    <label class="control-label">ID Jenis</label>
                    <input type="text" name="id_jenis" class="form-control" value="<?php echo $brg['id_jenis'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>

                <!-- No Batch & Jenis BAST -->
                <div class="form-group">
                    <label class="control-label">No Batch / Lot Barang</label>
                    <input type="text" name="no_batch" class="form-control" value="<?php echo $brg['no_bacth_lot_barang'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label class="control-label">Jenis BAST</label>
                    <select name="jenis_bast" id="jenis_bast" class="form-control select2" style="width: 100%;">
                        <option value="">Pilih Jenis</option>
                        <option value="level1" <?= ($brg['jenis_bast'] == 'level1') ? 'selected' : ''; ?>>Level 1 (7-14 Hari)</option>
                        <option value="level2" <?= ($brg['jenis_bast'] == 'level2') ? 'selected' : ''; ?>>Level 2 (14-30 Hari)</option>
                        <option value="level3" <?= ($brg['jenis_bast'] == 'level3') ? 'selected' : ''; ?>>Level 3 (30-90 Hari)</option>
                    </select>
                </div>

                <!-- Tanggal BAST -->
                <div class="form-group">
                    <label>Tanggal BAST</label>
                    <input type="text" id="kalender-bast" name="tgl_bast" class="form-control" placeholder="Pilih tanggal" value="<?php echo $brg['tanggal_bast_awal'] ?> sampai <?php echo $brg['tanggal_bast_akhir'] ?>">
                    <small id="range-info" class="text-muted"></small>
                    <input type="hidden" name="tgl_bast_start" id="tgl_bast_start" value="<?php echo $brg['tanggal_bast_awal'] ?>">
                    <input type="hidden" name="tgl_bast_end" id="tgl_bast_end" value="<?php echo $brg['tanggal_bast_akhir'] ?>">
                </div>

                <!-- No BAST & Spesifikasi -->
                <div class="form-group">
                    <label class="control-label">No BAST</label>
                    <input type="text" name="no_bast" class="form-control" value="<?php echo $brg['no_bacth'] ?>" <?= $readonly ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label class="control-label">Spesifikasi</label>
                    <textarea class="form-control" name="spesifikasi" placeholder="Spek barang..."><?php echo $brg['spesifikasi'] ?></textarea>
                </div>

            </div> <!-- End Kolom Kanan -->

            <!-- Tombol Submit & Reset -->
            <div class="col-md-12">
                <div class="form-group">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-md">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default btn-md">
                </div>
            </div>

        </div> <!-- End Box Body -->
    </div> <!-- End Box -->
</form>

<!-- Script JS -->
<script>
    $(function() {
        $(".select2").select2();
    });

    $(document).ready(function() {
        // hilangkan readonly jika hari ini > tanggal_bast_akhir
        const tglBastAkhir = $("#tgl_bast_end").val();
        const jenisBast = $("#jenis_bast").val();

        function setReadonly(status) {
            $("#gambar").prop("disabled", status);
            $("input[name='harga'], input[name='ed_barang'], input[name='no_bast'], input[name='tgl_datang'], input[name='no_batch']").prop("readonly", status);
        }

        // Default: readonly jika jenis_bast NULL
        if (!jenisBast) {
            setReadonly(true);
        }

        $("#jenis_bast").on("change", function() {
            const val = $(this).val();
            if (val === "level1" && (!tglBastAkhir || new Date() <= new Date(tglBastAkhir))) {
                setReadonly(true);
            } else if (val === "level2" || val === "level3") {
                setReadonly(false);
            }
        });
        if (tglBastAkhir && new Date() > new Date(tglBastAkhir)) {
            $("#gambar").prop("disabled", false);
            $("input[name='harga'], input[name='ed_barang'], input[name='no_bast'], input[name='tgl_datang'], input[name='no_batch']").prop("readonly", false);
            $("#jenis_bast").val('level2').trigger('change');
        }

        // preview gambar baru
        $("#gambar").change(function() {
            let input = this;
            if (input.files && input.files[0]) {
                $("#preview-baru").empty().show().append('<p class="text-muted">Preview gambar baru:</p>');
                Array.from(input.files).forEach(file => {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img>").attr("src", e.target.result)
                            .css({
                                'max-height': '150px',
                                'border': '1px solid #ccc',
                                'padding': '3px',
                                'margin-top': '5px'
                            })
                            .appendTo("#preview-baru");
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // Flatpickr kalender BAST
        var calendar = flatpickr("#kalender-bast", {
            mode: "single",
            dateFormat: "Y-m-d",
            clickOpens: false,
        });

        function formatView(d) {
            const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return d.getDate() + " " + bulan[d.getMonth()] + " " + d.getFullYear();
        }

        function setRange(jenis) {
            var today = new Date(),
                minDate, maxDate;
            if (jenis === "level1") {
                minDate = new Date(today);
                minDate.setDate(10);
                maxDate = new Date(minDate);
                maxDate.setDate(minDate.getDate() + 14);
            }
            if (jenis === "level2") {
                minDate = new Date(today);
                minDate.setDate(today.getDate() + 15);
                maxDate = new Date(today);
                maxDate.setDate(today.getDate() + 30);
            }
            if (jenis === "level3") {
                minDate = new Date(today);
                minDate.setDate(today.getDate() + 31);
                maxDate = new Date(today);
                maxDate.setDate(today.getDate() + 90);
            }
            if (jenis) {
                calendar.set("clickOpens", true);
                calendar.set("minDate", minDate);
                calendar.set("maxDate", maxDate);
                if (!$("#kalender-bast").val()) calendar.setDate(minDate);
                $("#tgl_bast_start").val(flatpickr.formatDate(minDate, "Y-m-d"));
                $("#tgl_bast_end").val(flatpickr.formatDate(maxDate, "Y-m-d"));
                $("#range-info").text("Range tanggal: " + formatView(minDate) + " s/d " + formatView(maxDate));
            } else {
                calendar.clear();
                calendar.set("clickOpens", false);
                $("#tgl_bast_start").val("");
                $("#tgl_bast_end").val("");
                $("#range-info").text("Pilih jenis BAST terlebih dahulu");
            }
        }

        $("#jenis_bast").on("change", function() {
            setRange($(this).val());
        });
        if ($("#jenis_bast").val()) setRange($("#jenis_bast").val());

        // Autocomplete nama barang
        $("#nama_barang").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url('admin/brg_masuk/getbarang') ?>",
                    dataType: "json",
                    data: request,
                    success: function(data) {
                        if (data.response == 'true') response(data.message);
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