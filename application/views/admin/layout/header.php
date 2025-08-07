<?php
$id_user       = $this->session->userdata('id');
$id_satker     = $this->session->userdata('id_satker');
$konfigurasi  = $this->konfigurasi_model->listing();
$user_detail  = $this->user_model->detail($id_user);

print_r($isi);
// echo "<pre>";
// print_r($expired3bulan);
// echo "</pre>";
?>
<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo base_url('admin/dasbor') ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo $konfigurasi['namaweb'] ?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><?php echo $konfigurasi['namaweb'] ?></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

      

      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url() ?>assets/admin/dist/img/ukm.png" class="img-circle" alt="<?php echo $user_detail['nama_user'] ?>" style="height:30px; width: 30px;">
          <span class="hidden-xs"><?php echo $user_detail['nama_user'] ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="<?php echo base_url() ?>assets/admin/dist/img/ukm.png" class="img-circle" alt="<?php echo $user_detail['nama_user'] ?>">
            <p>
              <?php echo $user_detail['nama_user'] ?>
              <small>Nama Account: <?php echo $user_detail['username'] ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">

            <div class="pull-right">
              <a href="<?php echo base_url('login/logout') ?>" class="btn btn-primary btn-flat"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
          </li>
        </ul>
      </li>
      </ul>
    </div>
  </nav>
</header>