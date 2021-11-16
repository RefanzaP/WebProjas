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
        <?= lang("daftar_pekerjaan") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("daftar_pekerjaan") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
    <div class="box">
      <div class="box-header">
        <?php $this->load->view("partials/message") ?>
        <h3 class="box-title" style="font-weight: bold"><?= lang("daftar_pekerjaan_anda") ?></h3>
      </div>
      <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_servisan">
                    <thead>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama_cust') ?></th>
                            <th class="text-center"><?= lang('no_telp') ?></th>
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
                            <td><?= $s['keluhan'] ?></td>
                            <td><?= status_servisan($s['status']) ?></td>
                        	<td>
                        		<a title="<?= lang("lihat_detail") ?>" class="btn btn-info" href="<?= base_url("technician/job/detail/".$s['id_servisan']) ?>">
            				        <span class="fa fa-bullseye"></span>
            				    </a>
                                <?php if($s['status_kembali']!=1){ ?>
                                    <?php if($s['status']>2){ ?>
                                        <a title="<?= lang("tandai_selesai") ?>" class="btn btn-success" onclick="finish('<?= $s['id_servisan'] ?>')">
                                            <span class="fa fa-check"></span>
                                        </a>
                                        <a title="<?= lang("tandai_batal") ?>" class="btn btn-danger" onclick="cancel('<?= $s['id_servisan'] ?>')">
                                            <span class="fa fa-close"></span>
                                        </a>
                                    <?php } else{ ?>
                                        <a title="<?= lang("kembalikan_status") ?>" class="btn btn-danger" onclick="back('<?= $s['id_servisan'] ?>')">
                                            <span class="fa fa-undo"></span>
                                        </a>
                                    <?php }
                                } ?>
                        	</td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama_cust') ?></th>
                            <th class="text-center"><?= lang('no_telp') ?></th>
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
    function finish(id){
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
            window.location.href = "<?= base_url('technician/job/mark_finish') ?>/"+id;
        });
    }
    function cancel(id){
        swal({
        title: "Apakah anda yakin?",
        text: "Semua data servis dan data pengeluaran dari servisan yang bersangkutan akan dihapus !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Ya, saya yakin !",
        closeOnConfirm: false
    },
        function(){
            window.location.href = "<?= base_url('technician/job/cancel') ?>/"+id;
        });
    }
    function back(id){
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
            window.location.href = "<?= base_url('technician/job/back') ?>/"+id;
        });
    }
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>