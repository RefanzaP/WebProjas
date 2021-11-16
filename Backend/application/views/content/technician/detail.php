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
        <li><a href="<?= base_url("technician/job/lists") ?>"><?= lang("daftar_pekerjaan") ?></a></li>
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

                    <?php if($servisan['status']>2){ ?>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_servis">
                                <span class="fa fa-plus"></span>&nbsp;&nbsp;<?= lang("tambah_data") ?>
                            </a>
                        </div>
                    <?php } ?>
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
                                            <th class="text-center"><?= lang('aksi') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($servis as $s) { ?>
                                        <tr align="center">
                                            <td><?= ++$i ?></td>
                                            <td><?= $s['nama_servis'] ?></td>
                                            <td><?= $s['biaya'] ?></td>
                                            
                                            <td>
                                            <?php if($servisan['status']>2){ ?>
                                                <a title="<?= lang("edit") ?>" class="btn btn-info" data-toggle="modal" data-target="#edit_servis" onclick="edit_servis(<?= $s['id_data_servis'] ?>, <?= $s['id_servis'] ?>)">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                                <a title="<?= lang("hapus") ?>" class="btn btn-danger" onclick="del_servis(<?= $s['id_data_servis'] ?>)" href="#">
                                                    <span class="fa fa-trash"></span>
                                                </a>
                                            <?php } else{ ?>
                                                <a class="btn btn-default btn-sm">
                                                    <?= lang("not_available") ?>
                                                </a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center"><?= lang("no") ?></th>
                                            <th class="text-center"><?= lang('nama_servis') ?></th>
                                            <th class="text-center"><?= lang('biaya') ?></th>
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
        <div class="col-md-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title" style="font-weight: bold"><?= lang("detail_pengeluaran") ?></h3>
                    <?php if($servisan['status']>2){ ?>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah_pengeluaran">
                                <span class="fa fa-plus"></span>&nbsp;&nbsp;<?= lang("tambah_data") ?>
                            </a>
                        </div>
                    <?php } ?>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Tambah Servis -->
<div class="modal fade" id="tambah_servis">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_servis") ?></h4>
                </div>
                <form method="post" action="<?= base_url("technician/job/save_repair") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <input type="hidden" name="id_servisan" id="s_id_servisan" value="<?= $id_servisan ?>">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("pilih_servis") ?></h5>
                                <?php $this->load->view("partials/select/servis") ?>
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

<!-- Modal Edit Servis -->
<div class="modal fade" id="edit_servis">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("edit_servis") ?></h4>
                </div>
                <form method="post" action="<?= base_url("technician/job/edit_servis") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <input type="hidden" name="id_servisan" value="<?= $id_servisan ?>">
                            <input type="hidden" name="id_data_servis" id="id_data_servis">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("pilih_servis") ?></h5>
                                <span id="select_servis">
                                    <?php $this->load->view("partials/select/servis_single") ?>
                                </span>
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
                <form method="post" enctype="multipart/form-data" action="<?= base_url("technician/job/save_output") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <input type="hidden" name="id_servisan" id="p_id_servisan" value="<?= $id_servisan ?>">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("nota") ?></h5>
                                <input type="file" name="nota" class="form-control">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("jumlah") ?></h5>
                                <input type="text" name="jumlah" class="form-control" placeholder="<?= lang("masukkan").lang("jumlah") ?>">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("keterangan") ?></h5>
                                <input type="text" name="keterangan" class="form-control" placeholder="<?= lang("masukkan").lang("keterangan") ?>">
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
                <form method="post" enctype="multipart/form-data" action="<?= base_url("technician/job/edit_output") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <input type="hidden" name="id_servisan" value="<?= $id_servisan ?>">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("id_pengeluaran") ?></h5>
                                <input type="text" class="form-control" id="id_pengeluaran1" disabled>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("nota") ?></h5>
                                <input type="file" name="nota" class="form-control">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("jumlah") ?></h5>
                                <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="<?= lang("masukkan").lang("jumlah") ?>" value="">
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("keterangan") ?></h5>
                                <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="<?= lang("masukkan").lang("keterangan") ?>" value="">
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
    $(document).ready(function() {
      var table = $('#tabel_pengeluaran').DataTable();
      table.column(3).visible(false);
      table.column(4).visible(false);
    } );
    function del_servis(id){
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
            window.location.href = "<?= base_url('technician/job/del_data_servis/'.$id_servisan) ?>/"+id;
        });
    }
    function del_output(id){
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
            window.location.href = "<?= base_url('technician/job/del_data_output/'.$id_servisan) ?>/"+id;
        });
    }
    function edit_servis(id_data_servis,id_servis){
        $("#id_data_servis").val(id_data_servis);
        var alloptions = $("#select_servis div select option").removeAttr("selected");
        var selectoption = $("#select_servis div select option[value='"+id_servis+"']");
        var select = $("#select_servis").find("#select2-id_servis-container");

        selectoption.attr("selected","selected");
        select.text(selectoption.text());
    }
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