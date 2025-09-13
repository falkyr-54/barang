<?php
$site    = $this->konfigurasi_model->listing();
$id_user  = $this->session->userdata('id');
$user_aktif  = $this->user_model->detail($id_user);
$user_detail  = $this->user_model->detail($id_user);
$id_satker   = $user_detail['id_satker'];


// print_r($keluar);
?>

<?php
          // Pesan notifikasi
echo validation_errors('<div class="alert alert-success">','</div>');

          // Pesan sukses
if($this->session->flashdata('sukses')) {
 echo '<div class="alert alert-success">';
 echo $this->session->flashdata('sukses');
 echo '</div>';
}
?>

<section class="content-header">
  <h1>
    <div class="alert alert-success">
      <p>Hai <strong><?php echo $user_aktif['nama_user'] . ' (' . $user_aktif['username'] . ')'; ?></strong>. Selamat datang di <strong><?php echo $site['namaweb'] . ' - ' . $site['tagline'] ?></strong></p>
    </div>
  </h1>
</section>
<hr>






<?php
  // modal
include('tableModal.php');
include('detailModal.php');

?>

<!-- Main content -->
<section class="content" style="min-height: auto;">
  <!-- Small boxes (Stat box) -->
  
  <div class="row">
    <div class="col-lg-4 col-xs-9">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">

          <h4>
            <?= count($listing)?> Pemberitahuan
          </h4>
          <h5>
            Terdapat <?= count($listing)?> Permintaan yang belum di proses
          </h5>
        </div>
        <div class="icon">
          <i class="ion ion-home"></i>
        </div>
        <div class="small-box-footer" style="cursor: pointer;" data-toggle="modal" data-target="#myModal">KLIK DISINI UNTUK DETAIL <i class="fa fa-arrow-circle-right"></i></div>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->
</section>
<hr>

