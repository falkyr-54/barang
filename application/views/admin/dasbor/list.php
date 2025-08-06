<?php
$site		= $this->konfigurasi_model->listing();
$id_user	= $this->session->userdata('id');
$user_aktif	= $this->user_model->detail($id_user);

?>

<hr>
<div class="alert alert-success">
	<p>Hai <strong><?php echo $user_aktif['nama_user'].' ('.$user_aktif['username'].')'; ?></strong>. Selamat datang di <strong><?php echo $site['namaweb'].' - '.$site['tagline'] ?></strong></p>
</div>

<script src="<?php echo base_url() ?>assets/charts/amcharts/amcharts.js" type="text/javascript"></script>

<div class="clearfix"></div>


<!-- BAR CHART -->
 <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Permintaan barang</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
     <?php include('grf_jns.php'); ?>
   </div><!-- /.box-body -->
 </div><!-- /.box -->

</div><!-- /.col (RIGHT) -->
</div><!-- /.row -->

<div class="box-body">

</div><!-- /.box-body -->
<!-- /.row -->
<div class="row"><br><br>
	<div class="col-md-12">
	</div>
</div>
<!-- /.row -->


