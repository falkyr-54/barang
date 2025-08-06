<?php
$this->simple_login->cek_login();

// Head
$head_site = $this->konfigurasi_model->listing();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Icon website -->
  <link href="<?php echo base_url('assets/upload/image/'.$head_site['icon']) ?>" rel="shortcut icon">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/select2/select2.min.css">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/font/css/font-awesome.min.css">
    <!-- Ionicons 
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/ionic/css/ionic.min.css">-->
      <!-- DataTables -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.css">
      <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css"> -->
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/skins/_all-skins.min.css">
     <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>"> -->

     <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/morris/morris.css">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


      <!-- jQuery 2.1.4 -->
      <script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jquery.maskMoney.min.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/jQueryUI/jquery-ui.min.js"></script>
      <!-- Select2 -->
      <script src="<?php echo base_url() ?>assets/admin/plugins/select2/select2.full.min.js"></script>
      <!-- <link href="<?php echo base_url() ?>assets/admin/plugins/jQueryUI/jquery-ui.css" rel="stylesheet"> -->
      <link href="<?php echo base_url() ?>assets/admin/plugins/jQueryUI/jquery-uiku.css" rel="stylesheet">
      <script src="<?php echo base_url('assets/js/jquery.chained.js') ?>" type="text/javascript" charset="utf-8" async defer></script>
    </head>

    <!-- Untuk Merubah Perkecil Nav -->
    <!-- <body class="skin-yellow sidebar-mini sidebar-collapse"> -->

      <!-- Untuk Perlebar Nav -->
      <body class="sidebar-mini skin-red-light">
        <div class="wrapper">



