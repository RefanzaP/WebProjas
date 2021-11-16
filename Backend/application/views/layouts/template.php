<?php 
    $user = $this->db->join("personal_data p","p.id_user = u.id_user","left")
                    ->where("u.id_user",$this->session->userdata("id_user"))
                    ->get("user u")
                    ->row_array();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title><?= lang("service_center_um") ?> | <?= date('Y') ?></title>

        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!-- Bootstrap Core Css -->
        <link rel="stylesheet" href="<?= base_url('dist/plugins/bootstrap/dist/css/bootstrap.min.css') ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('dist/plugins/font-awesome/css/font-awesome.min.css') ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('dist/plugins/ionicons/css/ionicons.min.css') ?>">
        <!-- Datepicker -->
        <link href="<?= base_url('dist') ?>/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet"> 
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.min.css') ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= base_url('dist/css/skins/_all-skins.min.css') ?>">

        <link rel="stylesheet" href="<?= base_url('dist/plugins/swal/sweetalert.css') ?>">

        <?php render('css') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= base_url("dashboard") ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b><?= lang("sc") ?></b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b><?= lang("aksesubig") ?></b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if($user['foto']==""){ ?>
                                        <img src="<?= base_url("dist/img/avatar5.png") ?>" class="user-image" alt="User Image">
                                    <?php } else { ?>
                                        <img src="<?= base_url("dist/pp_users/".$user['foto']) ?>" class="user-image" alt="User Image">
                                    <?php } ?>
                                    <span class="hidden-xs"><?= $this->session->userdata("nama") ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php if($user['foto']==""){ ?>
                                            <img src="<?= base_url("dist/img/avatar5.png") ?>" class="user-image" alt="User Image">
                                        <?php } else { ?>
                                            <img src="<?= base_url("dist/pp_users/".$user['foto']) ?>" class="user-image" alt="User Image">
                                        <?php } ?>
                                        <p>
                                            <?= $this->session->userdata("nama") ?> - <?= role($this->session->userdata("role")) ?>
                                            <small><?= lang("anggota_sejak") ?> <?= date("M. Y", strtotime($this->session->userdata("create_at"))) ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= base_url("account/edit") ?>" class="btn btn-default btn-flat"><?= lang("akun_anda") ?></a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url("dashboard/logout") ?>" class="btn btn-default btn-flat"><?= lang("keluar") ?></a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <br>
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if($user['foto']==""){ ?>
                                <img src="<?= base_url("dist/img/avatar5.png") ?>" class="user-image" alt="User Image">
                            <?php } else { ?>
                                <img style="border-radius: 20px; height:50px; width: 50px" src="<?= base_url("dist/pp_users/".$user['foto']) ?>" class="user-image" alt="User Image">
                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p><?= $this->session->userdata("nama") ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <br>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <?php $this->load->view("layouts/menu_privilage") ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php render('content') ?>
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="<?= base_url('dist/plugins/jquery/dist/jquery.min.js') ?>"> </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= base_url('dist/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"> </script>
        <!-- FastClick -->
        <script src="<?= base_url('dist/plugins/fastclick/lib/fastclick.js') ?>"> </script>
        <!-- Datepicker -->
        <script src="<?= base_url('dist') ?>/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- Swal -->
        <script src="<?= base_url('dist/plugins/swal/sweetalert.min.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('dist/js/adminlte.min.js') ?>"> </script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url('dist/js/demo.js') ?>"> </script>

        <?php render('js') ?>

        <script>
            $('.select2').select2()
            $('#datepicker').datepicker({
            autoclose: true
            })
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
            <?php $this->load->view("partials/alert_success") ?>
        </script>

        <?php render('script')?>
    </body>
</html>
