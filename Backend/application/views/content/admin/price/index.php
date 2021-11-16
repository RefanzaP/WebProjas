<?php section('css'); ?>
	<link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
  <h1>
    <?= lang("price_list") ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
    <li class="active"><?= lang("price_list") ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <?php $this->load->view("partials/message") ?>
      <div class="pull-right">
        <a class="btn btn-success" data-toggle="modal" data-target="#tambah_servis">
        	<span class="fa fa-plus"></span>
        	<?= lang("tambah_data") ?>
        </a>
      </div>
      <h3 class="box-title" style="font-weight: bold"><?= lang("price_list") ?></h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_servisan">
            <thead>
                <tr>
                    <th class="text-center"><?= lang("id_servis") ?></th>
                    <th class="text-center"><?= lang('nama_servis') ?></th>
                    <th class="text-center"><?= lang('biaya') ?></th>
                    <th class="text-center"><?= lang('aksi') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($servis as $s) { ?>
                <tr align="center">
                	<td><?= $s['id_servis'] ?></td>
                	<td><?= $s['nama_servis'] ?></td>
                	<td><?= $s['biaya'] ?></td>
                	<td>
                		<a title="<?= lang("edit") ?>" class="btn btn-info" onclick="edit(<?= $s['id_servis'] ?>)" href="#" data-toggle="modal" data-target="#edit_servis" data-row="<?= $i ?>">
    				        	<span class="fa fa-edit"></span>
    				        </a>
                		<a title="<?= lang("hapus") ?>" class="btn btn-danger" onclick="del(<?= $s['id_servis'] ?>)" href="#">
    				        	<span class="fa fa-trash"></span>
    				        </a>
                	</td>
                </tr>
                <?php $i++; } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center"><?= lang("id_servis") ?></th>
                    <th class="text-center"><?= lang('nama_servis') ?></th>
                    <th class="text-center"><?= lang('biaya') ?></th>
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

<!-- /.content-wrapper -->
<!-- Modal Tambah Servisan -->
<div class="modal fade" id="tambah_servis">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_servis") ?></h4>
      </div>
      <form method="post" action="<?= base_url("admin/price/add") ?>">
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-xs-10 col-xs-offset-1">
              <h5 style="font-weight:bold"><?= lang("nama_servis") ?></h5>
              <div class="form-group">
                <input required id="nama_servis" type="text" class="form-control" name="nama_servis" placeholder="<?= lang("nama_servis") ?>">
              </div>
            </div>
            <div class="col-xs-10 col-xs-offset-1">
              <h5 style="font-weight:bold"><?= lang("biaya") ?></h5>
              <div class="form-group">
                <input required id="biaya" type="text" class="form-control" name="biaya" placeholder="<?= lang("biaya") ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Edit Servisan -->
<div class="modal fade" id="edit_servis">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_servisan") ?></h4>
      </div>
      <form method="post" action="<?= base_url("admin/price/edit") ?>">
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-xs-10 col-xs-offset-1">
              <h5 style="font-weight:bold"><?= lang("nama_servis") ?></h5>
              <div class="form-group">
                <input required type="hidden" name="id_servis" id="id_servis">
                <input required id="nama_servis" type="text" class="form-control" name="nama_servis" placeholder="<?= lang("nama_servis") ?>">
              </div>
            </div>
            <div class="col-xs-10 col-xs-offset-1">
              <h5 style="font-weight:bold"><?= lang("biaya") ?></h5>
              <div class="form-group">
                <input required id="biaya" type="text" class="form-control" name="biaya" placeholder="<?= lang("biaya") ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
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
    function del(id){
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
            window.location.href = "<?= base_url('admin/price/del') ?>/"+id;
            swal("Terhapus!", "Data anda berhasil dihapus.", "success");
        });
    }
    $('#edit_servis').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var row = button.data('row') // Extract info from data-* attributes
      
      var modal = $(this)

      var table = $('#tabel_servisan').DataTable();
 
      var data = table
          .rows(row)
          .data();

      modal.find('.modal-body #nama_servis').val(data[0][1])
      modal.find('.modal-body #biaya').val(data[0][2])
    })
    function edit(id_servis){
      $("#id_servis").val(id_servis);
    }
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>