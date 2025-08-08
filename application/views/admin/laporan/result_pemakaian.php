  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cari tanggal : </h3>
    </div>
    <div class="panel-body">


      <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/tampil_pemakaian/' . $tmt . '/' . $tmtdua . '/' . $id_jenis) ?>" enctype="multipart/form-data">

        <div class="box-body" style="width: auto;">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
            <div class="col-sm-4">
              <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>
            <div class="col-sm-4">
              <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmtdua" autocomplete="off">
            </div>
          </div>


          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>
            <div class="col-sm-4">
              <select class="form-control" name="id_jenis">
                <option value="">Pilih Jenis Barang</option>
                <?php foreach ($barang as $barang) { ?>
                  <option value="<?php echo $barang['id_jenis'] ?>"
                    <?php if (isset($_POST['id_jenis']) && $_POST['id_jenis'] == $barang['id_jenis']) {
                      echo "selected";
                    } ?>><?php echo $barang['nama_jenis'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
            <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
            <a href="<?php echo base_url('admin/laporan/excel_keluar/' . $tmt . '/' . $tmtdua . '/' . $id_jenis) ?>" class="btn btn-danger btn-md" target="_blank"><i class="fa fa-file-excel-o"></i> Export Excel</a>
          </div>
        </div>

    </div><!-- /.box-body -->
    <div class="box-footer">
    </div><!-- /.box-footer -->
    </form>


    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          Laporan Barang
          <?php echo strftime('%d %B %Y', strtotime($tmt)); ?>
          -
          <?php echo strftime('%d %B %Y', strtotime($tmtdua)); ?>
        </h2>

        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">


          <div class="box-body table-responsive no-padding">
            <div class="box" style="width:99%;">
              <a class="btn btn-block btn-social btn-flickr">
                <i class="fa fa-linkedin"></i> Laporan Stok
              </a>
              <br>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-primary text-center">
                    <th rowspan="2" width="37">No</th>
                    <th rowspan="2" width="138">Nama Barang</th>
                    <th rowspan="2" width="138">Satuan</th>

                    <?php
                    $year_start = date('Y', strtotime($tmt));
                    $year_end   = date('Y', strtotime($tmtdua));
                    ?>
                    <th colspan="12" style="text-align: center;">
                      Pemakaian <?php echo ($year_start == $year_end) ? $year_start : $year_start . ' - ' . $year_end; ?>
                    </th>


                    <th rowspan="2" width="138">Rata</th>
                    <th rowspan="2" width="138">Harga</th>
                    <th rowspan="2" width="375">Stok tersedia</th>
                    <th rowspan="2" width="138">Barang masuk</th>
                    <th rowspan="2" width="138">Pemakaian barang</th>
                    <th rowspan="2" width="375">Harga sisa stok</th>
                  </tr>
                  <tr class="bg-primary text-center">
                    <th width="90">Jan</th>
                    <th width="90">Feb</th>
                    <th width="90">Mar</th>
                    <th width="90">Apr</th>
                    <th width="90">Mei</th>
                    <th width="90">Jun</th>
                    <th width="90">Jul</th>
                    <th width="90">Agu</th>
                    <th width="90">Sep</th>
                    <th width="90">Okt</th>
                    <th width="90">Nov</th>
                    <th width="90">Des</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $i = 1;
                  foreach ($brg as $brg_item) {

                    $id_barang = $brg_item['id_barang_masuk'];


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
                    $tahun = date('Y', strtotime($tmt));

                    // Hitung pemakaian Jan–Des tahun tersebut
                    $bulan_pemakaian = array();
                    for ($bulan = 1; $bulan <= 12; $bulan++) {
                      $start_date = $tahun . "-" . str_pad($bulan, 2, "0", STR_PAD_LEFT) . "-01";
                      $end_date   = date("Y-m-t", strtotime($start_date));

                      $pemakaian  = $this->Brg_keluar_model->get_jumlah_stok_per_bulan($id_barang, $start_date, $end_date);
                      $bulan_pemakaian[$bulan] = isset($pemakaian['total']) ? $pemakaian['total'] : 0;
                    }

                  ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $brg_item['nama_barang'] ?></td>
                      <td><?php echo $brg_item['satuan'] ?></td>
                      <?php foreach ($bulan_pemakaian as $total): ?>
                        <td><?php echo $total; ?></td>
                      <?php endforeach; ?>
                      <td><?php echo $brg_item['tanggal_minta'] ?></td>
                      <td><?php echo 'Rp' . number_format($brg_item['harga'], 0, ',', '.') ?></td>
                      <td><?php echo $update ?></td>
                      <!-- <td>
                  <?php if ($hasil < 0) {
                      echo "0";
                    } else {
                      echo $hasil;
                    }
                  ?></td> -->

                      <td> <?php if ($masuk == null) {
                              echo "0";
                            } else {
                              echo $masuk;
                            }
                            ?></td>

                      <td><?php echo $keluar ?></td>
                      <td><?php echo 'Rp' . number_format($brg_item['harga'] * $update, 0, ',', '.') ?> </td>
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