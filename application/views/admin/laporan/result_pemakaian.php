  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cari tanggal : </h3>
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


      <div class="row">
        <div class="col-md-12">
          <h2 class="page-header">
            Laporan Perencanaan
            <?php echo strftime('%d %B %Y', strtotime($tmt)); ?>
            -
            <?php echo strftime('%d %B %Y', strtotime($tmtdua)); ?>
          </h2>

          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">


            <div class="box-body table-responsive no-padding">
              <div class="box" style="width:99%;">
                <a class="btn btn-block btn-social btn-flickr">
                  Laporan Stok
                </a>
                <br>
                <table id="tabel_laporan_pemakaian" class="table table-bordered table-striped">
                  <thead>
                    <tr class="bg-primary text-center">
                      <th rowspan="2" width="37">No</th>
                      <th rowspan="2" width="138">Nama Barang</th>
                      <th rowspan="2" width="37">Satuan</th>

                      <?php
                      $year_start = date('Y', strtotime($tmt)) - 1; // tahun awal dikurangi 1
                      $year_end   = date('Y', strtotime($tmtdua)) - 1; // tahun akhir dikurangi 1
                      ?>
                      <th colspan="12" style="text-align: center;">
                        Barang Masuk <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?>
                      </th>
                      <th colspan="12" style="text-align: center;">
                        Barang Keluar <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?>
                      </th>


                      <th rowspan="2" width="100">Barang Masuk JAN-DES <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?></th>
                      <th rowspan="2" width="100">Barang Keluar JAN-DES <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?></th>
                      <th rowspan="2" width="100">Total Barang Masuk JAN-DES <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?></th>
                      <th rowspan="2" width="100">Total Barang Keluar JAN-DES <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?></th>

                      <th rowspan="2" width="100">RATA - RATA Barang Keluar JAN - DES <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?></th>
                      <th rowspan="2" width="100">
                        Rencana Belanja Barang <?php echo date('Y', strtotime($tmt)) + 1; ?>
                      </th>
                      <th rowspan="2" width="138">Sisa Stock Des 2025</th>
                      <th rowspan="2" width="150">Harga Satuan + PPN 12%</th>
                      <th rowspan="2" width="150">Jumlah</th>
                    </tr>
                    <!-- barang -->
                    <tr class="bg-primary text-center">
                      <!-- Bulan Barang Masuk -->
                      <th width="40">Jan</th>
                      <th width="40">Feb</th>
                      <th width="40">Mar</th>
                      <th width="40">Apr</th>
                      <th width="40">Mei</th>
                      <th width="40">Jun</th>
                      <th width="40">Jul</th>
                      <th width="40">Agu</th>
                      <th width="40">Sep</th>
                      <th width="40">Okt</th>
                      <th width="40">Nov</th>
                      <th width="40">Des</th>

                      <!-- Bulan Barang Keluar -->
                      <th width="40">Jan</th>
                      <th width="40">Feb</th>
                      <th width="40">Mar</th>
                      <th width="40">Apr</th>
                      <th width="40">Mei</th>
                      <th width="40">Jun</th>
                      <th width="40">Jul</th>
                      <th width="40">Agu</th>
                      <th width="40">Sep</th>
                      <th width="40">Okt</th>
                      <th width="40">Nov</th>
                      <th width="40">Des</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($brg as $brg_item) {

                      $id_barang = $brg_item['id_barang'];


                      // Hitung stok tersedia dan data lainnya
                      $jml_masuk  = $this->Brg_masuk_model->get_jumlah_stok($id_barang, $tmt, $tmtdua);
                      $jml_keluar = $this->Brg_keluar_model->get_jumlah_stok($id_barang, $tmt, $tmtdua);

                      $masuk  = isset($jml_masuk['total']) ? $jml_masuk['total'] : 0;
                      $keluar = isset($jml_keluar['total']) ? $jml_keluar['total'] : 0;
                      $hasil  = $masuk - $keluar;


                      // Hitung total update stok
                      $total_masuk  = $this->Brg_masuk_model->get_jumlah_msk($id_barang);
                      $total_keluar = $this->Brg_keluar_model->get_jumlah_klr($id_barang);
                      $update       = (isset($total_masuk['total']) ? $total_masuk['total'] : 0) - (isset($total_keluar['total']) ? $total_keluar['total'] : 0);

                      // Ambil tahun dari tanggal mulai ($tmt)
                      $tahun_masuk  = date('Y', strtotime($tmt)) - 1;  // Barang Masuk tahun sebelumnya
                      $tahun_keluar = date('Y', strtotime($tmt)) - 1;

                      // Hitung pemakaian Jan–Des tahun tersebut
                      $bulan_pemakaian = array();
                      for ($bulan = 1; $bulan <= 12; $bulan++) {
                        $start_date = $tahun_masuk . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT) . "-01";
                        $end_date   = date("Y-m-t", strtotime($start_date));
                        // echo "<br>" . $end_date;
                        $pemakaian  = $this->Brg_masuk_model->get_jumlah_stok_per_bulan($id_barang, $start_date, $end_date);
                        $bulan_pemakaian[$bulan] = isset($pemakaian['total']) ? $pemakaian['total'] : 0;
                      }

                      $keluar_pemakaian = array();
                      for ($bulan = 1; $bulan <= 12; $bulan++) {
                        $start_date = $tahun_keluar . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT) . "-01";
                        $end_date   = date("Y-m-t", strtotime($start_date));

                        $pemakaian  = $this->Brg_keluar_model->get_jumlah_stok_per_bulan($id_barang, $start_date, $end_date);
                        $keluar_pemakaian[$bulan] = isset($pemakaian['total']) ? $pemakaian['total'] : 0;
                      }


                    ?>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $brg_item['nama_barang'] ?></td>
                        <td><?php echo $brg_item['satuan'] ?></td>
                        <?php foreach ($bulan_pemakaian as $total): ?>
                          <td><?php echo $total; ?></td>
                        <?php endforeach; ?>
                        <?php foreach ($keluar_pemakaian as $totals): ?>
                          <td><?php echo $totals; ?></td>
                        <?php endforeach; ?>
                        <!-- Total barang masuk setahun -->
                        <td><?php echo array_sum($bulan_pemakaian); ?></td>
                        <td><?php echo array_sum($keluar_pemakaian); ?></td>
                        <td><?php echo array_sum($bulan_pemakaian); ?></td>
                        <td><?php echo array_sum($keluar_pemakaian); ?></td>


                        <td>
                          <?php
                          $total_pemakaian = array_sum($keluar_pemakaian);
                          $rata_rata = $total_pemakaian / 12;
                          $rata_rata = round($rata_rata, 0); // dibulatkan ke angka bulat
                          echo $rata_rata;

                          ?>
                        </td>


                        <?php
                        $total_keluar = array_sum($keluar_pemakaian); // total barang keluar Jan–Des
                        $rencana_belanja = $total_keluar * 0.3; // 30%


                        ?>
                        <td><?php echo  number_format($rencana_belanja, 0, ',', '.') ?> </td>
                        <!-- sisa stock 2025 -->

                        <?php
                        $masuk_tahun_lalu = array_sum($bulan_pemakaian);
                        $keluar_tahun_lalu = array_sum($keluar_pemakaian);
                        $sisa_stok_tahun = $masuk_tahun_lalu - $keluar_tahun_lalu;
                        ?>
                        <td><?php echo number_format($sisa_stok_tahun, 0, ',', '.'); ?></td>

                        <!-- Harga satuan -->
                        <td><?php echo 'Rp ' . number_format($brg_item['harga'], 0, ',', '.'); ?></td>
                        <!-- Jumlah -->
                        <td>
                          <?php
                          $harga  = $brg_item['harga']; // harga asli
                          $jumlah = $sisa_stok_tahun * $harga;

                          echo 'Rp ' . number_format($jumlah, 0, ',', '.');
                          ?>
                        </td>

                      </tr>
                    <?php $i++;
                    } ?>
                  </tbody>
                </table>
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