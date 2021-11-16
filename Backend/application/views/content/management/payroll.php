<?php section('css'); ?>
    <link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
    <h1>
        <?= lang("daftar_gaji_teknisi") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("daftar_gaji_teknisi") ?></li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <?php $this->load->view("partials/message") ?>
            <h3 class="box-title" style="font-weight: bold"><?= lang("daftar_gaji_teknisi") ?></h3>
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#beri_gaji">
                    <span class="fa fa-plus"></span>&nbsp;
                    <?= lang("beri_gaji") ?>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_servisan">
                    <thead>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama') ?></th>
                            <th class="text-center"><?= lang('total_gaji') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($user as $u) { ?>
                            <tr align="center">
                                <td><?= $i+1 ?></td>
                                <td><?= $u['nama'] ?></td>
                                <td><?= $u['gaji'] ?></td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama') ?></th>
                            <th class="text-center"><?= lang('total_gaji') ?></th>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Beri Gaji -->
<div class="modal fade" id="beri_gaji">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("beri_gaji") ?></h4>
                </div>
                <form method="post" action="<?= base_url("management/job/give") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("pilih_teknisi") ?></h5>
                                <?php $this->load->view("partials/select/user") ?>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("jumlah") ?></h5>
                                <input class="form-control" type="text" name="jumlah" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang("close") ?></button>
                        <button type="submit" class="btn btn-primary"><?= lang("save") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endsection()?>
	
<?php section('js'); ?>
    <script src="<?= base_url('dist') ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url('dist') ?>/js/pages/tables/jquery-datatable.js"></script>
<?php endsection(); ?>

<?php section('script'); ?>

<?php endsection(); ?>

<?php getview('layouts/template') ?>