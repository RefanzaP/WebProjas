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
        <?= lang("validasi_pengeluaran") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("validasi_pengeluaran") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
    <div class="box">
      <div class="box-header">
        <?php $this->load->view("partials/message") ?>
        <h3 class="box-title" style="font-weight: bold"><?= lang("data_pengeluaran") ?></h3>
      </div>
      <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_pengeluaran">
                    <thead>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama_teknisi') ?></th>
                            <th class="text-center"><?= lang('keterangan') ?></th>
                            <th class="text-center"><?= lang('biaya') ?></th>
                            <th class="text-center"><?= lang('tanggal') ?></th>
                            <th class="text-center"><?= lang('status') ?></th>
                            <th class="text-center"><?= lang('aksi') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($output as $p) { ?>
                            <tr align="center">
                                <td><?= ++$i ?></td>
                                <td><?= $p['nama'] ?></td>
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

                                    <?php if($p['status']==0){ ?>
                                        <a title="<?= lang("tandai_valid") ?>" class="btn btn-success" onclick="valid(<?= $p['id_pengeluaran'] ?>)">
                                            <span class="fa fa-check"></span>
                                        </a>
                                        <a title="<?= lang("tandai_tidak_valid") ?>" class="btn btn-danger" onclick="invalid(<?= $p['id_pengeluaran'] ?>)">
                                            <span class="fa fa-close"></span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama_teknisi') ?></th>
                            <th class="text-center"><?= lang('keterangan') ?></th>
                            <th class="text-center"><?= lang('biaya') ?></th>
                            <th class="text-center"><?= lang('tanggal') ?></th>
                            <th class="text-center"><?= lang('status') ?></th>
                            <th class="text-center"><?= lang('aksi') ?></th>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

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
    function valid(id){
        swal({
        title: "Apakah anda yakin?",
        text: "Data yang telah diproses tidak dapat dikembalikan lagi!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Ya, saya yakin !",
        closeOnConfirm: false
    },
        function(){
            window.location.href = "<?= base_url('management/job/check_valid') ?>/"+id;
        });
    }
    function invalid(id){
        swal({
        title: "Apakah anda yakin?",
        text: "Data yang telah diproses tidak dapat dikembalikan lagi!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Ya, saya yakin !",
        closeOnConfirm: false
    },
        function(){
            window.location.href = "<?= base_url('management/job/check_invalid') ?>/"+id;
        });
    }
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