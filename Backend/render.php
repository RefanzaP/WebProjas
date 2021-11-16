<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LTDC <?= date('Y') ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('dist/plugins/bootstrap/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('dist/plugins/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('dist/plugins/ionicons/css/ionicons.min.css') ?>">
  <!-- Dinamis Stile -->
  <?php render('css') ?>
  <!-- Custom Style -->
  <!-- <link rel="stylesheet" href="<?= base_url('dist/css/common.css') ?>"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('dist/css/skins/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/loading.min.css') ?>">
  <!-- SWEET ALERT -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('dist/plugins/sweetalert/sweetalert.css') ?>">
  <!-- Pace Loading -->
  <link rel="stylesheet" href="<?= base_url('dist/plugins/pace-loading/loading.css') ?>">
  <!-- Icon -->
  <link rel="icon" type="image/png" href="<?= base_url('dist/img/icon.png') ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('dashboard') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b><i class="fa fa-fire"></i></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><i class="fa fa-fire"></i> Your</b>LTDC</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('dist/img/avatar04.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('email') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url('dist/img/avatar04.png')?>" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('email') ?> <br> <?= ucwords($this->session->userdata('jabatan')) ?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?= base_url('welcome/logout')?>/<?= $this->session->userdata('id_admin') ?>" class="btn btn-default">Sign Out</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#"></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?= base_url('welcome/logout')?>/<?= $this->session->userdata('id_admin') ?>"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('dist/img/avatar04.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= ucwords($this->session->userdata('jabatan')) ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <li class="active"><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> 
        
        <li class="header"><?= strtoupper(lang('data_tim')) ?></li>
        <li><a href="<?= base_url('identitas_tim/tim/analog') ?>"><i class="fa fa-group"></i> <?= lang('analog') ?></a></li>
        <li><a href="<?= base_url('identitas_tim/tim/micro') ?>"><i class="fa fa-group"></i> <?= lang('microcontroller') ?></a></li>
        
        <?php if($this->session->userdata('jabatan') == 'superuser'){ ?>
        <li class="header"><?= strtoupper(lang('pengaturan')) ?></li>
        <li><a href="<?= base_url('pengaturan/pengaturan') ?>"><i class="fa fa-group"></i> <?= lang('pengaturan') ?></a></li>
        <?php } ?>

        <li class="header"><?= strtoupper(lang('kategori1')) ?></li>        
        <?php $this->load->view('partials/file_informasi') ?>

        <li class="header"><?= strtoupper(lang('kategori2')) ?></li>
        <?php $this->load->view('partials/file_lomba') ?>
      </ul>

      
    </section>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php render('toolbar') ?>
    </section>

    <!-- Main content -->
    <section class="content">

      <?php render('content') ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Workshop Elektro</a>.</strong> IT Developer.
  </footer> 
</div>
<!-- ./wrapper -->

<script src="<?= base_url('dist/plugins/jQuery/jQuery-2.2.0.min.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('dist/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('dist/plugins/sweetalert/sweetalert.min.js') ?>"></script>
<!-- Pace Loading -->
<script src="<?= base_url('dist/plugins/pace-loading/pace.min.js') ?>"></script>
<!-- Custom Jquery link -->
<?php render('js') ?>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/app.min.js') ?>"></script>

<?php render('script')?>
</body>
</html>
