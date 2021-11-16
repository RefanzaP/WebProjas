<?php section('css'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('dist/plugins/select2/dist/css/select2.min.css') ?>">
<!-- TagsInput -->
<link href="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<!-- Datatables -->
<link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
    <h1>
        <?= lang("detail_pekerjaan") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("detail_pekerjaan") ?></li>
    </ol>
</section>

<section class="content">
    <?php $this->load->view("partials/message") ?>
    <div class="box box-info">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("detail_servisan") ?></h3>
                </div>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-10 col-md-offset-1 col-xs-12">
                            <table class="table table-hover">
                                <tr>
                                    <th width="25%"><?= lang("id_servisan") ?></th>
                                    <th width="2%">:</th>
                                    <td width="70%"><?= $servisan['id_servisan'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("penerima") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['nama_penerima'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("nama_cust") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['nama_cust'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("no_telp") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['no_telp'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("tgl_masuk") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['tgl_masuk'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("jns_barang") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['jns_barang'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("kelengkapan") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['kelengkapan'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("keluhan") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['keluhan'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("teknisi") ?></th>
                                    <th>:</th>
                                    <td><?= $servisan['nama_teknisi'] ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("status") ?></th>
                                    <th>:</th>
                                    <td><?= status_servisan($servisan['status']) ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("status_kembali") ?></th>
                                    <th>:</th>
                                    <td><?= status_kembali($servisan['status_kembali']) ?></td>
                                </tr>
                                <tr>
                                    <th><?= lang("biaya_total") ?></th>
                                    <th>:</th>
                                    <td><?= $total ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("detail_servis") ?></h3>
                </div>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?= lang("no") ?></th>
                                            <th class="text-center"><?= lang('nama_servis') ?></th>
                                            <th class="text-center"><?= lang('biaya') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($servis as $s) { ?>
                                        <tr align="center">
                                            <td><?= ++$i ?></td>
                                            <td><?= $s['nama_servis'] ?></td>
                                            <td><?= $s['biaya'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center"><?= lang("no") ?></th>
                                            <th class="text-center"><?= lang('nama_servis') ?></th>
                                            <th class="text-center"><?= lang('biaya') ?></th>
                                        </tr>
                                    </tfoot> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("detail_pengeluaran") ?></h3>
                </div>
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tabel_pengeluaran" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?= lang("no") ?></th>
                                            <th class="text-center"><?= lang('keterangan') ?></th>
                                            <th class="text-center"><?= lang('jumlah') ?></th>
                                            <th class="text-center"><?= lang('tanggal') ?></th>
                                            <th class="text-center"><?= lang('status') ?></th>
                                            <th class="text-center"><?= lang('aksi') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($output as $p) { ?>
                                        <tr align="center">
                                            <td><?= ++$i ?></td>
                                            <td><?= $p['keterangan'] ?></td>
                                            <td><?= $p['jumlah'] ?></td>
                                            <td>
                                                <?= date("d M Y H:i:s", strtotime($p['create_at'])) ?>
                                            </td>
                                            <td><?= status_validasi($p['status']) ?></td>
                                            <td>
                                                <a title="<?= lang("lihat_nota") ?>" class="btn btn-primary" data-toggle="modal" data-target="#lihat_nota" data-row="<?= $i-1 ?>" data-img="<?= base_url('dist/nota/'.$p['nota']) ?>">
                                                    <span class="fa fa-bullseye"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php ; } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center"><?= lang("no") ?></th>
                                            <th class="text-center"><?= lang('keterangan') ?></th>
                                            <th class="text-center"><?= lang('jumlah') ?></th>
                                            <th class="text-center"><?= lang('tanggal') ?></th>
                                            <th class="text-center"><?= lang('status') ?></th>
                                            <th class="text-center"><?= lang('aksi') ?></th>
                                        </tr>
                                    </tfoot> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Lihat Nota -->
<div class="modal fade" id="lihat_nota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="font-weight:bold" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-xs-8 col-xs-offset-2">
                        <a class="thumbnail">
                            <img id="img_nota">
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang("close") ?></button>
            </div>
        </div>
    </div>
</div>

<?php endsection()?>
    
<?php section('js'); ?>
<!-- Select2 -->
<script src="<?= base_url('dist/plugins/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- TagsInput -->
<script src="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- Datatables JQuery -->
<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<!-- Datatables Bootstrap -->
<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Datatables JQuery -->
<script src="<?= base_url('dist') ?>/js/pages/tables/jquery-datatable.js"></script>
<?php endsection(); ?>

<?php section('script'); ?>
<script type="text/javascript">
    $('#lihat_nota').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var row = button.data('row')
        var img = button.data('img')

        var modal = $(this)

        var table = $('#tabel_pengeluaran').DataTable();

        var data = table
            .rows(row)
            .data();

        modal.find('.modal-title').html(data[0][1]+" - "+data[0][3]+" &nbsp;&nbsp; "+data[0][4])
        modal.find('#img_nota').attr('src',img)
    })
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>