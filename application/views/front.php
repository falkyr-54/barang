
<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>masterhome/favicon.png">
    
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/js/rs-plugin/css/settings.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>masterhome/assets/css/styles.css">


    <script type="text/javascript" src="<?php echo base_url() ?>masterhome/assets/js/modernizr.custom.32033.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

    <div class="pre-loader">
        <div class="load-con">
            <img src="<?php echo base_url() ?>masterhome/assets/img/freeze/logo2.png" class="animated fadeInDown" alt="">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
          </div>
      </div>
  </div>

  <header>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="fa fa-bars fa-lg"></span>
                </button>
               <!--  <a class="navbar-brand" href="index.html">
                    <img src="<?php echo base_url() ?>masterhome/assets/img/freeze/logo2.png" alt="" class="logo">
                </a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about">Tentang</a>
                    </li>
                    <li><a href="#features">Gallery</a>
                    </li>
                    <li><a href="<?php echo base_url('login') ?>">Login</a>
                    </li>
                           <!--  <li><a href="#screens">screens</a>
                            </li>
                            <li><a href="#demo">demo</a>
                            </li>
                            <li><a class="getApp" href="#getApp">get app</a>
                            </li>
                            <li><a href="#support">support</a>
                            </li> -->
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
            </nav>


            <!--RevSlider-->
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <ul>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo base_url() ?>masterhome/assets/img/transparent.png"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                            <!-- LAYERS -->
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption lfl fadeout hidden-xs"
                            data-x="left"
                            data-y="bottom"
                            data-hoffset="30"
                            data-voffset="0"
                            data-speed="500"
                            data-start="700"
                            data-easing="Power4.easeOut">
                            <img src="<?php echo base_url() ?>masterhome/assets/img/freeze/Slides/inven.jpg" alt="">
                        </div>

                        <div class="tp-caption lfl fadeout visible-xs"
                        data-x="left"
                        data-y="center"
                        data-hoffset="700"
                        data-voffset="0"
                        data-speed="500"
                        data-start="700"
                        data-easing="Power4.easeOut">
                        <img src="<?php echo base_url() ?>masterhome/assets/img/freeze/iphone-freeze.png" alt="">
                    </div>

                    <div class="tp-caption large_white_bold sft" data-x="550" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1200" data-easing="Power4.easeOut" style="font-size: 50px;">
                        Selamat datang di
                    </div>
                        <!-- <div class="tp-caption large_white_light sfr" data-x="770" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1400" data-easing="Power4.easeOut">
                            Datang
                        </div> -->
                        <div class="tp-caption large_white_light sfb" data-x="550" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1500" data-easing="Power4.easeOut" style="font-size: 30px;">
                            Aplikasi Barang <br>Puskesmas Pasar Rebo
                        </div>

                        <div class="tp-caption sfr hidden-xs" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">
                            <a href="#" class="btn btn-default btn-lg">INFO BARANG TERSEDIA</a>
                        </div>
                        <!-- <div class="tp-caption sfr hidden-xs" data-x="730" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1500" data-start="1900" data-easing="Power4.easeOut">
                            <a href="#getApp" class="btn btn-default btn-lg">INFO NOTULENSI</a>
                        </div> -->

                    </li>
                </ul>
            </div>
        </div>

    </header>

    <div class="wrapper">
     <section id="about">
        <div class="container">

            <div class="section-heading scrollpoint sp-effect3">
                <h1>About Us</h1>
                <div class="divider"></div>
                <p>Oleose Beautiful App Landing Page</p>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="about-item scrollpoint sp-effect2">
                        <i class="fa fa-download fa-2x"></i>
                        <h3>Easy setup</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6" >
                    <div class="about-item scrollpoint sp-effect5">
                        <i class="fa fa-mobile fa-2x"></i>
                        <h3>On-the-go</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6" >
                    <div class="about-item scrollpoint sp-effect5">
                        <i class="fa fa-users fa-2x"></i>
                        <h3>Social connect</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6" >
                    <div class="about-item scrollpoint sp-effect1">
                        <i class="fa fa-sliders fa-2x"></i>
                        <h3>Dedicated support</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url() ?>masterhome/assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/slick.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/placeholdem.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/waypoints.min.js"></script>
<script src="<?php echo base_url() ?>masterhome/assets/js/scripts.js"></script>
<script>
    $(document).ready(function() {
        appMaster.preLoader();
    });
</script>
</body>

</html>
