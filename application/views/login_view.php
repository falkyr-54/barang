<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>

      body, .login-page{
        background-image:url(<?php echo base_url() ?>assets/notulen.jpg);
        no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;}
      </style>

    </head>

    <header class="main-header" style="background-color: #54a8ba;">
      <nav class="navbar navbar-static-top"> 
        <a href="<?php echo base_url('login') ?>" class="navbar-brand"><marquee><b>Aplikasi Barang</b></marquee></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i><div class="container" >

            <div class="navbar-header">

            </button>
          </div>

        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <!-- right column -->
    <div class="col-md-12">
      <body class="hold-transition login-page">
        <div class="login-box">
         <!-- /.login-logo -->

         <div class="box-body">
          <p class="text-muted">
          <!--  <h3 align="center" style="color: #FF0000">
          Sistem Informasi Laporan Kegiatan Penyuluhan</h3> -->
        </p>
      </div>
      <div class="login-box-body">
        <div class="login-logo">
          <a href="<?php echo base_url('login') ?>"><b><?php echo $title ?></b></a>
        </div><br><br>
        <p class="login-box-msg">
         <strong>Masukkan Username dan Password</strong></p>

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
         <form action="<?php echo base_url('Login') ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username/NIP">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <i class="fa fa-fw fa-check-circle"></i> KLIK TOMBOL LOGIN
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="LOGIN" name="submit">
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">

        </div><!-- /.social-auth-links -->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </div>

  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="<?php echo base_url() ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    });
  </script>
</body>

</html>
