<?php section('css'); ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('dist/plugins/select2/dist/css/select2.min.css') ?>">
  <link href="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
  <h1 style="font-weight: bold">
    <?= lang("beri_tugas_teknisi") ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("beri_tugas_teknisi") ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <?php $this->load->view("partials/message") ?>
      <h3 class="box-title" style="font-weight: bold"><?= lang("data_servisan_belum") ?></h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_servisan">
            <thead>
                <tr>
                    <th class="text-center"><?= lang("no") ?></th>
                    <th class="text-center"><?= lang('nama_cust') ?></th>
                    <th class="text-center"><?= lang('no_telp') ?></th>
                    <th class="text-center"><?= lang('tgl_masuk') ?></th>
                    <th class="text-center"><?= lang('jns_barang') ?></th>
                    <th class="text-center"><?= lang('kelengkapan') ?></th>
                    <th class="text-center"><?= lang('keluhan') ?></th>
                    <th class="text-center"><?= lang('status') ?></th>
                    <th class="text-center"><?= lang('aksi') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($servisan as $s) { ?>
                <tr align="center">
                  <td><?= $i+1 ?></td>
                	<td><?= $s['nama_cust'] ?></td>
                	<td><?= $s['no_telp'] ?></td>
                	<td><?= $s['tgl_masuk'] ?></td>
                	<td><?= $s['jns_barang'] ?></td>
                  <td><?= $s['kelengkapan'] ?></td>
                  <td><?= $s['keluhan'] ?></td>
                  <td><?= status_servisan($s['status']) ?></td>
                	<td>
                    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#beri_tugas" onclick="beri_tugas(<?= $s['id_servisan'] ?>)">
                      <span><i class="fa fa-exclamation-circle"></i></span>&nbsp;&nbsp;<?= lang("beri_tugas") ?>
                    </a>
                	</td>
                </tr>
                <?php $i++; } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center"><?= lang("no") ?></th>
                    <th class="text-center"><?= lang('nama_cust') ?></th>
                    <th class="text-center"><?= lang('no_telp') ?></th>
                    <th class="text-center"><?= lang('tgl_masuk') ?></th>
                    <th class="text-center"><?= lang('jns_barang') ?></th>
                    <th class="text-center"><?= lang('kelengkapan') ?></th>
                    <th class="text-center"><?= lang('keluhan') ?></th>
                    <th class="text-center"><?= lang('status') ?></th>
                    <th class="text-center"><?= lang('aksi') ?></th>
                </tr>
            </tfoot> 
        </table>
    </div>
    </div>
  </div>
</section>

<!-- Modal Beri Tugas -->
<div class="modal fade" id="beri_tugas">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("beri_tugas") ?></h4>
                </div>
                <form method="post" action="<?= base_url("admin/to_technician/save") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <input type="hidden" name="id_servisan" id="id_servisan">

                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("pilih_teknisi") ?></h5>
                                <?php $this->load->view("partials/select/technician") ?>
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
  <!-- Select2 -->
  <script src="<?= base_url('dist/plugins/select2/dist/js/select2.full.min.js') ?>"></script>
  <script src="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="<?= base_url('dist') ?>/js/pages/tables/jquery-datatable.js"></script>
	
<?php endsection(); ?>

<?php section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#tabel_servisan').DataTable();
      table.column(5).visible(false);
      table.column(6).visible(false);
    } );
    function beri_tugas(id_servisan){
      $("#id_servisan").val(id_servisan);
    }
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>