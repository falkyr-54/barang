        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Cari laporan : </h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" name="form1" method="post"
              action="<?php echo base_url('admin/laporan/tampil_pemakaian') ?>"
              enctype="multipart/form-data">

              <div class="box-body">

                <!-- Tahun Laporan -->
                <div class="form-group">
                  <label for="tahun_laporan" class="col-sm-2 control-label">Tahun Laporan</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="tahun" required>
                      <option value="">Pilih Tahun</option>
                      <?php
                      $tahun_sekarang = date('Y');
                      for ($i = 2020; $i <= $tahun_sekarang + 1; $i++) { ?>
                        <option value="<?php echo $i; ?>"
                          <?php if (isset($_POST['tahun']) && $_POST['tahun'] == $i) echo "selected"; ?>>
                          <?php echo $i; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <!-- Jenis Barang -->
                <div class="form-group">
                  <label for="id_jenis" class="col-sm-2 control-label">Jenis Barang</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="id_jenis">
                      <option value="">Pilih Jenis Barang</option>
                      <?php foreach ($barang as $barang) { ?>
                        <option value="<?php echo $barang['id_jenis'] ?>"
                          <?php if (isset($_POST['id_jenis']) && $_POST['id_jenis'] == $barang['id_jenis']) echo "selected"; ?>>
                          <?php echo $barang['nama_jenis'] ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

              </div>

              <!-- Tombol -->
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
                </div>
              </div>

            </form>



          </div>
        </div>

        <script>
          $(function() {
            $(".datepicker").datepicker({
              changeYear: true,
              changeMonth: true,
              yearRange: "2023:<?php echo date('Y') ?>",
              dateFormat: "yy-mm-dd"
            });
          });
        </script>

        <script>
          $(function() {
            $("#unit").autocomplete({ //the recipient text field with id #username
              source: function(request, response) {
                $.ajax({
                  url: "<?php echo base_url('admin/brg_keluar/getunit') ?>",
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
                $("#id_unit").val(ui.item.value);
              },

            });
          });
        </script>