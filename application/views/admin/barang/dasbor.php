  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Transaksi Hari Ini
    </h1>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <?php 

    ?>

    <div class="row">
      <?php foreach ($lurah as $lurah) { ?>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box <?php echo $lurah['warna'] ?>">
            <div class="inner">

              <h4><?php echo $lurah['nama_satker'] ?></h4>
              <h4>
                <?php 
                $satker = $lurah['id_satker'];
                $masuk = $this->Brg_masuk_model->masuk_ini($satker);
                echo count($masuk).' Barang Masuk';
                ?>
              </h4>
              <h4>
                <?php 
                $satker = $lurah['id_satker'];
                $masuk = $this->Brg_masuk_model->keluar_ini($satker);
                echo count($masuk).' Barang Keluar';
                ?>
              </h4>
              
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
            
            <a href="<?php echo base_url('admin/barang/list_today/'.$lurah['id_satker']) ?>" class="small-box-footer">KLIK DISINI UNTUK DETAIL <i class="fa fa-arrow-circle-right"></i></a>

          </div>
        </div><!-- ./col -->
      <?php } ?>
    </div><!-- /.row -->
  </section>