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
        <?= lang("riwayat_keuangan") ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url("dashboard") ?>"><?= lang("beranda") ?></a></li>
        <li class="active"><?= lang("riwayat_keuangan") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->load->view("partials/message") ?>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title" style="font-weight: bold"><?= lang("data_servisan") ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel_pengeluaran">
                    <thead>
                        <tr>
                            <th class="text-center"><?= lang("no") ?></th>
                            <th class="text-center"><?= lang('nama_cust') ?></th>
                            <th class="text-center"><?= lang('biaya_servis') ?></th>
                            <th class="text-center"><?= lang('biaya_total') ?></th>
                            <th class="text-center"><?= lang('gaji_teknisi') ?></th>
                            <th class="text-center"><?= lang('laba_bersih') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_laba=0; $i=0; foreach ($servisan as $s) { ?>
                            <tr align="center">
                                <td><?= ++$i ?></td>
                                <td><?= $s['nama_cust'] ?></td>
                                <td><?= $s['biaya_servis'] ?></td>
                                <td><?= $s['biaya_total'] ?></td>
                                <td><?= $s['gaji_teknisi'] ?></td>
                                <td><?= $s['laba_bersih'] ?></td>
                            </tr>
                        <?php $total_laba+=$s['laba_bersih']; } ?>
                    </tbody>
                    <tfoot>
                        <tr align="center">
                            <th class="text-center" colspan="5"><?= lang("total_laba") ?></th>
                            <td><?= $total_laba ?></td>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title" style="font-weight: bold"><?= lang("data_pengeluaran_lain") ?></h3>
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
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</section>

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

<?php endsection(); ?>

<?php getview('layouts/template') ?>