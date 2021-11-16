<?php section('css'); ?>

<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
    <h1>
        <?= lang("akun_anda") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("akun_anda") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->load->view("partials/message") ?>
    <div class="box box-primary">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("ubah_foto_profil") ?></h3>
                </div>
                <div class="box-body">
                    <form method="post" enctype="multipart/form-data" action="<?= base_url("account/edit/save_photo") ?>">
                        <div class="row clearfix">
                            <div class="col-md-10 col-md-offset-1 col-xs-12">
                                <div class="row clearfix">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="thumbnail">
                                            <?php if($user['foto']!=null) { ?>
                                                <img src="<?= base_url('dist/pp_users/'.$user['foto']) ?>" width="200px" height="200px">
                                            <?php } else{ 
                                                    if ($user['jk']=="1") { ?>
                                                        <img src="<?= base_url('dist/img/user-m.png') ?>">
                                                <?php } else { ?>
                                                        <img src="<?= base_url('dist/img/user-fm.png') ?>">
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group">
                                        <label><?= lang("foto_profil") ?></label>
                                        <input required type="file" class="form-control" name="foto">
                                    </div>
                                    <div class="form-group pull-right">
                                        <input type="submit" class="btn btn-primary" value="<?= lang("save") ?>" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("ubah_data_pribadi") ?></h3>
                </div>
                <div class="box-body">
                    <form method="post" action="<?= base_url("account/edit/save_data") ?>">
                        <div class="row clearfix">
                            <div class="col-md-10 col-md-offset-1 col-xs-12">
                                <div class="form-group">
                                    <label><?= lang("nama") ?></label>
                                    <input required type="text" class="form-control" name="nama" placeholder="<?= lang("masukkan").lang("nama") ?>" value="<?= $user['nama'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= lang("alamat") ?></label>
                                    <input required type="text" class="form-control" name="alamat" placeholder="<?= lang("masukkan").lang("alamat") ?>" value="<?= $user['alamat'] ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= lang("jk") ?></label>
                                    <select name="jk" class="form-control" required>
                                        <option <?= $user['jk']==""?"selected":"" ?> disabled><?= lang("masukkan").lang("jk") ?></option>
                                        <option <?= $user['jk']=="1"?"selected":"" ?> value="1"><?= jk(1) ?></option>
                                        <option <?= $user['jk']=="2"?"selected":"" ?> value="2"><?= jk(2) ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?= lang("no_telp") ?></label>
                                    <input required type="text" class="form-control" name="no_telp" placeholder="" value="<?= $user['no_telp'] ?>">
                                </div>
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="<?= lang("save") ?>" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("ubah_password") ?></h3>
                </div>
                <div class="box-body">
                    <form method="post" action="<?= base_url("account/edit/save_password") ?>" id="change_password">
                        <div class="row clearfix">
                            <div class="col-md-10 col-md-offset-1 col-xs-12">
                                <div class="form-group">
                                    <label><?= lang("password_lama") ?></label>
                                    <input required type="password" class="form-control" name="old" placeholder="<?= lang("masukkan").lang("password_lama") ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= lang("password_baru") ?></label>
                                    <input required id="new" type="password" class="form-control" name="new" placeholder="<?= lang("masukkan").lang("password_baru") ?>">
                                </div>
                                <div class="form-group">
                                    <label><?= lang("konfirmasi_password") ?></label>
                                    <input required id="re" type="password" class="form-control" name="re" placeholder="<?= lang("masukkan").lang("konfirmasi_password") ?>">
                                </div>
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="<?= lang("save") ?>" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("ubah_email_address") ?></h3>
                </div>
                <div class="box-body">
                    <form method="post" action="<?= base_url("account/edit/save_email") ?>">
                        <div class="row clearfix">
                            <div class="col-md-10 col-md-offset-1 col-xs-12">
                                <div class="form-group">
                                    <label><?= lang("email_address") ?></label>
                                    <input required type="email" class="form-control" name="email" placeholder="<?= lang("masukkan").lang("email_address") ?>" value="<?= $user['email'] ?>">
                                </div>
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="<?= lang("save") ?>" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endsection()?>
	
<?php section('js'); ?>
    <script src="<?= base_url('dist/plugins/jquery-validation/jquery.validate.js') ?>"></script>		
<?php endsection(); ?>

<?php section('script'); ?>
<script type="text/javascript">
    $().ready(function(){
        $('#change_password').validate({
            rules: {
                new: {
                    minlength: 8
                },
                re: {
                    minlength: 8,
                    equalTo: "#new"
                }
            },
            messages: {
                new: {
                    minlength: "<?= lang('pass_char') ?>"
                },
                re: {
                    minlength: "<span style='color: red'><?= lang('pass_char') ?></span>",
                    equalTo: "<span style='color: red'><?= lang('pass_notmatch') ?></span>"
                }
            }
        });
    });
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>