<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= lang("aksesubig") ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('dist/plugins/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('dist/plugins/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('dist/plugins/ionicons/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dist/plugins/swal/sweetalert.css') ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>"><b><?= lang("aksesubig") ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php $this->load->view("partials/message") ?>
    <p class="login-box-msg"><?= lang('mulai_sesi') ?></p>

    <form action="<?= base_url("welcome") ?>" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="<?= lang('email') ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="<?= lang('password') ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?= lang("masuk") ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url('dist/plugins/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('dist/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('dist/plugins/swal/sweetalert.min.js') ?>"></script>
<script type="text/javascript">
  <?php $this->load->view("partials/alert_success") ?>
</script>
</body>
</html>
