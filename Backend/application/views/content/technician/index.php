<?php section('css'); ?>
  <link href="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
  <h1>
    <?= lang("job_teknisi") ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("job_teknisi") ?></li>
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
                    <a title="<?= lang("lihat_detail") ?>" class="btn btn-info" href="#" data-toggle="modal" data-target="#show_servisan" data-row="<?= $i ?>">
                      <span class="fa fa-search-plus"></span>
                    </a>
                		<a title="<?= lang("kerjakan") ?>" class="btn btn-primary" onclick="take_job(<?= $s['id_servisan'] ?>)" href="#">
    				        	<span class="fa fa-wrench"></span>
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
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<!-- Modal Show Servisan -->
<div class="modal fade" id="show_servisan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 style="font-weight:bold"  class="modal-title"><?= lang("data_servisan") ?></h4>
      </div>
      <form method="post" action="<?= base_url("dashboard/edit_servisan") ?>">
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("nama_cust") ?></h5>
              <div class="form-group">
                <input disabled id="nama_cust" type="text" class="form-control">
              </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("no_telp") ?></h5>
              <div class="form-group">
                <input disabled id="no_telp" type="text" class="form-control">
              </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("tgl_masuk") ?></h5>
              <div class="form-group">
                <input disabled id="tgl_masuk" type="text" class="form-control">
              </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("jns_barang") ?></h5>
              <div class="form-group">
                <input disabled id="jns_barang" type="text" class="form-control">
              </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("kelengkapan") ?></h5>
              <div class="form-group">
                  <input id="kelengkapan" disabled type="text" class="form-control">
              </div>
            </div>
            <div class="col-xs-8 col-xs-offset-2">
              <h5 style="font-weight:bold"><?= lang("keluhan") ?></h5>
              <input id="keluhan" disabled type="text" class="form-control">
            </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php endsection()?>
	
<?php section('js'); ?>
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
    function take_job(id){
        swal({
        title: "Apakah anda yakin?",
        text: "Data yang telah diproses tidak dapat dikembalikan lagi!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Ya, saya yakin !",
        closeOnConfirm: false
    },
        function(){
            window.location.href = "<?= base_url('technician/job/take_job') ?>/"+id;
        });
    }
    $('#show_servisan').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var row = button.data('row') // Extract info from data-* attributes
      
      var modal = $(this)

      var table = $('#tabel_servisan').DataTable();
 
      var data = table
          .rows(row)
          .data();

      modal.find('.modal-body #nama_cust').val(data[0][1])
      modal.find('.modal-body #no_telp').val(data[0][2])
      modal.find('.modal-body #tgl_masuk').val(data[0][3])
      modal.find('.modal-body #jns_barang').val(data[0][4])
      modal.find('.modal-body #kelengkapan').val(data[0][5])
      modal.find('.modal-body #keluhan').val(data[0][6])
    })
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>