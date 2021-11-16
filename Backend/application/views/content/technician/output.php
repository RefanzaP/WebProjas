<?php section('css'); ?>
<!-- Datatables -->
<link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
    <h1>
        <?= lang("data_pengeluaran_anda") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("data_pengeluaran_anda") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <?php $this->load->view("partials/message") ?>
            <h3 class="box-title" style="font-weight: bold"><?= lang("data_pengeluaran_anda") ?></h3>
            <div class="pull-right">
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_pengeluaran">
                    <span class="fa fa-plus"></span>&nbsp;&nbsp;<?= lang("tambah_data") ?>
                </a>
            </div>
        </div>
        <div class="box-body">
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

                                <?php if($p['status']!=1){ ?>
                                    <a title="<?= lang("edit") ?>" class="btn btn-info" data-toggle="modal" data-target="#edit_pengeluaran" data-row="<?= $i-1 ?>" onclick="edit_pengeluaran(<?= $p['id_pengeluaran'] ?>)">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <a title="<?= lang("hapus") ?>" class="btn btn-danger" onclick="del_output(<?= $p['id_pengeluaran'] ?>)" href="#">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                <?php } ?>
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
</section>

<!-- Modal Tambah Pengeluaran -->
<div class="modal fade" id="tambah_pengeluaran">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_pengeluaran") ?></h4>
                </div>
                <form method="post" enctype="multipart/form-data" action="<?= base_url("technician/job/add_output") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("nota") ?></h5>
                                <input type="file" name="nota" class="form-control">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("keterangan") ?></h5>
                                <input type="text" name="keterangan" class="form-control" placeholder="<?= lang("masukkan").lang("keterangan") ?>">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("jumlah") ?></h5>
                                <input type="text" name="jumlah" class="form-control" placeholder="<?= lang("masukkan").lang("jumlah") ?>">
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

<!-- Modal Edit Pengeluaran -->
<div class="modal fade" id="edit_pengeluaran">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("edit_pengeluaran") ?></h4>
                </div>
                <form method="post" enctype="multipart/form-data" action="<?= base_url("technician/job/edit_output_2") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("id_pengeluaran") ?></h5>
                                <input type="text" class="form-control" id="id_pengeluaran1" disabled>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("nota") ?></h5>
                                <input type="file" name="nota" class="form-control">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("keterangan") ?></h5>
                                <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="<?= lang("masukkan").lang("keterangan") ?>" value="">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("jumlah") ?></h5>
                                <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="<?= lang("masukkan").lang("jumlah") ?>" value="">
                            </div>
                            <input type="hidden" name="id_pengeluaran" id="id_pengeluaran2">
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
<!-- Datatables JQuery -->
<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<!-- Datatables Bootstrap -->
<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Datatables JQuery -->
<script src="<?= base_url('dist') ?>/js/pages/tables/jquery-datatable.js"></script>
<?php endsection(); ?>

<?php section('script'); ?>
<script type="text/javascript">
    function edit_pengeluaran(id_pengeluaran){
        $("#id_pengeluaran1").val(id_pengeluaran);
        $("#id_pengeluaran2").val(id_pengeluaran);
    }
    $('#edit_pengeluaran').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var row = button.data('row')

        var modal = $(this)

        var table = $('#tabel_pengeluaran').DataTable();

        var data = table
            .rows(row)
            .data();

        modal.find('#jumlah').val(data[0][2])
        modal.find('#keterangan').val(data[0][1])
    })
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