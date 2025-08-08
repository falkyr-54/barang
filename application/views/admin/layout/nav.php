<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">        
        <img src="<?php echo base_url() ?>assets/admin/dist/img/ukm.png" class="img-circle" alt="<?php echo $user_detail['nama_user'] ?>">
      </div>
      <div class="pull-left info">
        <p><?php echo $user_detail['nama_user'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- Dasbor -->
      <li><a href="<?php echo base_url('admin/barang/kelurahan') ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span> </a></li>

      <li class="treeview">
        <a href="#"><i class="fa fa-balance-scale"></i> <span>Transaksi Barang</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">


         <?php if($this->session->userdata('level') == "admin_poli"||$this->session->userdata('level') == "kelurahan") { ?>
          <li><a href="<?php echo base_url('admin/barang_unit') ?>"><i class="fa fa-cubes"></i>Data barang yang diajukan </a></li>
        <?php } ?>

        <li><a href="<?php echo base_url('admin/barang/proses') ?>"><i class="fa fa-cubes"></i>Proses Transaksi </a></li>

        <?php if($this->session->userdata('level') == "pj_klaster") { ?>
          <li><a href="<?php echo base_url('admin/pj_klaster/cari_approval') ?>"><i class="fa fa-cubes"></i>Data barang acc </a></li>
        <?php } ?>

        <?php if($this->session->userdata('level') == "admin_barang") { ?>
          <li><a href="<?php echo base_url('admin/admin_barang') ?>"><i class="fa fa-cubes"></i>Validasi admin barang</a></li>
        <?php } ?>


        <?php if($this->session->userdata('level') == "admin") { ?>

          <li><a href="<?php echo base_url('admin/barang/cari_masuk') ?>"><i class="fa fa-mail-forward"></i>Data Transaksi Masuk </a></li>
          <li><a href="<?php echo base_url('admin/barang/cari_keluar') ?>"><i class="fa fa-mail-reply"></i>Data Transaksi Keluar </a></li>
        <?php } ?>
<!--  -->

        <?php if($this->session->userdata('level') == "kapustu") { ?>

          <li><a href="<?php echo base_url('admin/barang/validasi') ?>"><i class="fa fa-cubes"></i>validasi kapustu/pj klaster</a></li>

        <?php } ?> 
      </ul>
    </li>

    <?php if ($this->session->userdata('level')=="admin"){ ?>

      <li class="treeview">
        <a href="#"><i class="fa fa-book"></i> <span>Laporan Kecamatan</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">

         <li><a href="<?php echo base_url('admin/laporan/cari_stok') ?>"><i class="fa fa-cubes"></i>Laporan barang masuk</a></li>
         <li><a href="<?php echo base_url('admin/laporan/cari_keluar') ?>"><i class="fa fa-cubes"></i>Laporan barang keluar</a></li>
         <li><a href="<?php echo base_url('admin/laporan/cari_pemakaian') ?>"><i class="fa fa-cubes"></i>Laporan Pemakaian</a></li>

         <!-- <li><a href="<?php echo base_url('admin/laporan/opname') ?>"><i class="fa fa-cubes"></i>Laporan Rekap Stok Opname</a></li> -->

       </ul>
     </li>


     <li class="treeview">
      <a href="#"><i class="fa fa-book"></i> <span>Laporan Kelurahan</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">

       <li><a href="<?php echo base_url('admin/laporan/masuk_kel') ?>"><i class="fa fa-cubes"></i>Laporan barang masuk</a></li>
       <li><a href="<?php echo base_url('admin/laporan/keluar_kel') ?>"><i class="fa fa-cubes"></i>Laporan barang keluar</a></li>

       <!-- <li><a href="<?php echo base_url('admin/laporan/opname') ?>"><i class="fa fa-cubes"></i>Laporan Rekap Stok Opname</a></li> -->

     </ul>
   </li>


   <!-- Data Master -->
   <li class="treeview">
    <a href="#"><i class="fa fa-database"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

      <li><a href="<?php echo base_url('admin/jenis_brg') ?>"><i class="fa fa-cubes"></i>Master Jenis Barang</a></li>
      <li><a href="<?php echo base_url('admin/barang') ?>"><i class="fa fa-cart-plus"></i>Master Barang</a></li>
      <li><a href="<?php echo base_url('admin/satuan') ?>"><i class="fa  fa-chain-broken"></i>Master Satuan</a></li>
      <li><a href="<?php echo base_url('admin/rekanan') ?>"><i class="fa fa-hand-grab-o"></i>Master Rekanan</a></li>
      <li><a href="<?php echo base_url('admin/pegawai') ?>"><i class="fa fa-users"></i>Master Pegawai</a></li>
      <li><a href="<?php echo base_url('admin/satker') ?>"><i class="fa fa-building-o"></i>Master Satker</a></li>
      <li><a href="<?php echo base_url('admin/unit') ?>"><i class="fa fa-home"></i>Master Unit</a></li>

    </ul>
  </li>

  <!-- Data User -->
  <li class="treeview">
    <a href="#"><i class="fa fa-circle"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-plus"></i>Data User</a></li>
    </ul>
  </li>

  <!-- Data Konfigurasi website -->
  <li class="treeview">
    <a href="#"><i class="fa fa-wrench"></i> <span>KONFIGURASI</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url('admin/dasbor/konfigurasi') ?>"><i class="fa fa-plus"></i> Konfigurasi Umum</a></li>
      <li><a href="<?php echo base_url('admin/dasbor/icon') ?>"><i class="fa fa-home"></i> Ganti Icon</a></li>
      <li><a href="<?php echo base_url('admin/dasbor/logo') ?>"><i class="fa fa-book"></i> Ganti Logo</a></li>
    </ul>
  </li>
<?php } ?>
</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     <?php echo $title ?>
   </h1>
   
   <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dasbor') ?>"><i class="fa fa-dashboard"></i> Dasbor</a></li>
    <?php
    $uri2 	= $this->uri->segment(2);
    $uri3	= $this->uri->segment(3);
    ?>
    <li><a href="<?php echo base_url('admin/'.$uri2) ?>"><?php echo ucfirst($uri2) ?></a></li>

    <?php if($uri3 != "") { ?>
      <li class="active"><?php echo ucfirst($uri3) ?></li>
    <?php } ?>

  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        </div><!-- /.box-header -->
        <div class="box-body">