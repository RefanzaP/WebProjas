<?php section('css'); ?>
    <link href="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php endsection(); ?>

<?php section('toolbar') ?>
<!--  -->
<?php endsection() ?>

<?php section('content') ?>
<section class="content-header">
    <h1>
        <?= lang("employee_list") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("employee_list") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <?php $this->load->view("partials/message") ?>
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#tambah_user">
                    <span class="fa fa-plus"></span>
                    <?= lang("tambah_data") ?>
                </a>
            </div>
            <h3 class="box-title" style="font-weight: bold"><?= lang("data_pegawai") ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_servisan">
                    <thead>
                        <tr>
                            <th class="text-center"><?= lang("id_user") ?></th>
                            <th class="text-center"><?= lang('nama') ?></th>
                            <th class="text-center"><?= lang('jk') ?></th>
                            <th class="text-center"><?= lang('no_telp') ?></th>
                            <th class="text-center"><?= lang('status') ?></th>
                            <th class="text-center"><?= lang('password') ?></th>
                            <th class="text-center"><?= lang('aksi') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($employee as $e) { ?>
                        <tr align="center">
                          	<td><?= $e['id_user'] ?></td>
                          	<td><?= $e['nama'] ?></td>
                          	<td><?= jk($e['jk']) ?></td>
                            <td><?= $e['no_telp'] ?></td>
                            <td><?= role($e['role']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-info" onclick="show_password(<?= $e['id_user'] ?>,'<?= $e['repassword'] ?>')" href="#" data-toggle="modal" data-target="#show_password" data-row="<?= $i ?>">
                                    <span class="fa fa-search-plus">&nbsp;<?= lang("show") ?></span>
                                </a>
                            </td>
                          	<td>
                        		<a title="<?= lang("edit") ?>" class="btn btn-sm btn-info" href="<?= base_url("admin/employee/edit/".$e['id_user']) ?>">
                		        	  <span class="fa fa-edit"></span>
                		        </a>
                        		<a title="<?= lang("hapus") ?>" class="btn btn-sm btn-danger" onclick="del(<?= $e['id_user'] ?>)" href="#">
                		          	<span class="fa fa-trash"></span>
                		        </a>
                          	</td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center"><?= lang("id_user") ?></th>
                            <th class="text-center"><?= lang('nama') ?></th>
                            <th class="text-center"><?= lang('jk') ?></th>
                            <th class="text-center"><?= lang('no_telp') ?></th>
                            <th class="text-center"><?= lang('status') ?></th>
                            <th class="text-center"><?= lang('password') ?></th>
                            <th class="text-center"><?= lang('aksi') ?></th>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambah_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_data") ?></h4>
            </div>
            <form method="post" action="<?= base_url("admin/employee/add") ?>">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("nama") ?></h5>
                            <div class="form-group">
                                <input required type="text" class="form-control" name="nama" placeholder="<?= lang("masukkan").lang("nama") ?>">
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("email_address") ?></h5>
                            <div class="form-group">
                                <input required type="email" class="form-control" name="email" placeholder="<?= lang("masukkan").lang("email_address") ?>">
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("password") ?></h5>
                            <div class="form-group">
                                <input required type="password" class="form-control" name="password" placeholder="<?= lang("masukkan").lang("password") ?>">
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("jk") ?></h5>
                            <div class="form-group">
                                <select name="jk" class="form-control" required>
                                    <option disabled selected><?= lang("masukkan").lang("jk") ?></option>
                                    <option value="1"><?= jk(1) ?></option>
                                    <option value="2"><?= jk(2) ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("alamat") ?></h5>
                            <div class="form-group">
                                <input required type="text" class="form-control" name="alamat" placeholder="<?= lang("masukkan").lang("alamat") ?>">
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("no_telp") ?></h5>
                            <div class="form-group">
                                <input required type="text" class="form-control" name="no_telp" placeholder="<?= lang("no_telp") ?>">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1 col-xs-12">
                            <div class="form-group">
                                <label><?= lang("pilih_hak_akses") ?></label>
                                <select name="role" class="form-control" required>
                                    <option selected disabled><?= lang("masukkan").lang("hak_akses") ?></option>
                                    <option value="1"><?= role(1) ?></option>
                                    <option value="2"><?= role(2) ?></option>
                                    <option value="3"><?= role(3) ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><?= lang("save") ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show Password -->
<div class="modal fade" id="show_password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 style="font-weight:bold"  class="modal-title"><?= lang("show_password") ?></h4>
            </div>
            <form method="post" action="<?= base_url("admin/employee") ?>">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-xs-10 col-xs-offset-1">
                            <h5 style="font-weight:bold"><?= lang("password") ?></h5>
                            <div class="form-group">
                                <input required type="hidden" name="id_user" id="id_user">
                                <input required readonly="" id="password" type="text" class="form-control" name="password" placeholder="<?= lang("masukkan").lang("password") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </form>
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
<script type="text/javascript">
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
            window.location.href = "<?= base_url('admin/employee/del') ?>/"+id;
        });
    }
    function show_password(id_user,password){
      $("#id_user").val(id_user);
      $("#password").val(password);
    }
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>