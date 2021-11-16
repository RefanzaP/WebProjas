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
        <?= lang("beranda") ?>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><?= lang("beranda") ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="font-weight: bold"><?= lang("not_yet_servisan") ?></span>
                    <span class="info-box-number"><?= $not_yet ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="font-weight: bold"><?= lang("finish_servisan") ?></span>
                    <span class="info-box-number"><?= $finish ?></span>
                </div>
            </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-recycle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text" style="font-weight: bold"><?= lang("proccess_servisan") ?></span>
                    <span class="info-box-number"><?= $proccess ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <?php $this->load->view("partials/message") ?>
            <h3 class="box-title" style="font-weight: bold"><?= lang("data_servisan") ?></h3>
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#tambah_servisan">
                    <span class="fa fa-plus"></span>&nbsp;
                    <?= lang("tambah_servisan") ?>
                </a>
                <a class="btn btn-primary" data-toggle="modal" data-target="#klaim_garansi">
                    <span class="fa fa-shield"></span>&nbsp;
                    <?= lang("klaim_garansi") ?>
                </a>
            </div>
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
                            <th class="text-center"><?= lang('status_kembali') ?></th>
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
                                <td><?= status_kembali($s['status_kembali']) ?></td>
                              	<td>
                                    <a title="<?= lang("lihat_detail") ?>" class="btn btn-primary" href="<?= base_url("dashboard/detail_servisan/".$s['id_servisan']) ?>">
                                        <span class="fa fa-bullseye"></span>
                                    </a>
                                    <?php if($s['status_kembali']!=1){ 
                                        if($s['status']!=1 && $s['status']!=2){ ?>
                                        	<a  title="<?= lang("edit") ?>" class="btn btn-info" onclick="edit(<?= $s['id_servisan'] ?>)" href="#" data-toggle="modal" data-target="#edit_servisan" data-row="<?= $i ?>">
                                            	  <span class="fa fa-edit"></span>
                                            </a>
                                            <?php if($s['status']==0){ ?>
                                            	<a title="<?= lang("hapus") ?>" class="btn btn-danger" onclick="del(<?= $s['id_servisan'] ?>)" href="#">
                                                	  <span class="fa fa-trash"></span>
                                                </a>
                                            <?php }
                                        } else{ ?>
                                            <a title="<?= lang("tandai_kembali") ?>" class="btn btn-success" onclick="back(<?= $s['id_servisan'] ?>)" href="#">
                                                  <span class="fa fa-check"></span>
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
                            <th class="text-center"><?= lang('tgl_masuk') ?></th>
                            <th class="text-center"><?= lang('jns_barang') ?></th>
                            <th class="text-center"><?= lang('kelengkapan') ?></th>
                            <th class="text-center"><?= lang('keluhan') ?></th>
                            <th class="text-center"><?= lang('status') ?></th>
                            <th class="text-center"><?= lang('status_kembali') ?></th>
                            <th class="text-center"><?= lang('aksi') ?></th>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-weight: bold"><?= lang("grafik_laba_bulanan") ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Servisan -->
<div class="modal fade" id="tambah_servisan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_servisan") ?></h4>
            </div>
            <form method="post" action="<?= base_url("dashboard/add_servisan") ?>">
                <div class="row">
                    <div class="modal-body col-sm-8 col-sm-offset-2">
                        <h5 style="font-weight:bold"><?= lang("nama_cust") ?></h5>
                        <div class="form-group">
                            <input required id="nama_cust" type="text" class="form-control" name="nama_cust" placeholder="<?= lang("nama_cust") ?>">
                        </div>
                        <h5 style="font-weight:bold"><?= lang("no_telp") ?></h5>
                        <div class="form-group">
                            <input required id="no_telp" type="text" class="form-control" name="no_telp" placeholder="<?= lang("no_telp") ?>">
                        </div>
                        <h5 style="font-weight:bold"><?= lang("jns_barang") ?></h5>
                        <div class="form-group">
                            <input required id="jns_barang" type="text" class="form-control" name="jns_barang" placeholder="<?= lang("jns_barang") ?>">
                        </div>
                        <h5 style="font-weight:bold"><?= lang("kelengkapan") ?></h5>
                        <div class="form-group">
                            <input type="text" name="kelengkapan" class="form-control" data-role="tagsinput" value="unit,charger,tas,dsb" required>
                            <div class="clearfix">
                                <span style="color: red; font-size: 12px;  "><i><?= lang('pisahkan_dengan_enter') ?></i></span>
                            </div>
                        </div>
                        <h5 style="font-weight:bold"><?= lang("keluhan") ?></h5>
                        <input type="text" name="keluhan" class="form-control" data-role="tagsinput" value="Masukkan,Keluhan,Disini" required>
                        <div class="clearfix">
                            <span style="color: red; font-size: 12px;  "><i><?= lang('pisahkan_dengan_enter') ?></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Servisan -->
<div class="modal fade" id="edit_servisan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 style="font-weight:bold"  class="modal-title"><?= lang("tambah_servisan") ?></h4>
            </div>
            <form method="post" action="#">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-xs-8 col-xs-offset-2">
                            <h5 style="font-weight:bold"><?= lang("nama_cust") ?></h5>
                            <div class="form-group">
                                <input required id="id_servisan" type="hidden" name="id_servisan">
                                <input required id="nama_cust" type="text" class="form-control" name="nama_cust" placeholder="<?= lang("nama_cust") ?>">
                            </div>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2">
                            <h5 style="font-weight:bold"><?= lang("no_telp") ?></h5>
                            <div class="form-group">
                                <input required id="no_telp" type="text" class="form-control" name="no_telp" placeholder="<?= lang("no_telp") ?>">
                            </div>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2">
                            <h5 style="font-weight:bold"><?= lang("jns_barang") ?></h5>
                            <div class="form-group">
                                <input required id="jns_barang" type="text" class="form-control" name="jns_barang" placeholder="<?= lang("jns_barang") ?>">
                            </div>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2">
                        <h5 style="font-weight:bold"><?= lang("kelengkapan") ?></h5>
                            <div class="form-group">
                                <input id="kelengkapan" type="text" name="kelengkapan" class="form-control" data-role="tagsinput" required>
                                <div class="clearfix">
                                    <span style="color: red; font-size: 12px;  "><i><?= lang('pisahkan_dengan_enter') ?></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2">
                            <h5 style="font-weight:bold"><?= lang("keluhan") ?></h5>
                            <input id="keluhan" type="text" name="keluhan" class="form-control" data-role="tagsinput" required>
                            <div class="clearfix">
                                <span style="color: red; font-size: 12px;  "><i><?= lang('pisahkan_dengan_enter') ?></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Klaim Garansi -->
<div class="modal fade" id="klaim_garansi">
    <div class="modal-dialog">
        <div class="box box-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 style="font-weight:bold"  class="modal-title"><?= lang("klaim_garansi") ?></h4>
                </div>
                <form method="post" action="<?= base_url("dashboard/claim") ?>">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("pilih_servisan") ?></h5>
                                <span id="select_servis">
                                    <?php $this->load->view("partials/select/servisan") ?>
                                </span>
                            </div>
                            <div class="col-xs-8 col-xs-offset-2">
                                <h5 style="font-weight:bold"><?= lang("keluhan") ?></h5>
                                <input id="keluhan" type="text" name="keluhan" class="form-control" data-role="tagsinput" value="Masukkan Keluhan Disini" required>
                                <div class="clearfix">
                                    <span style="color: red; font-size: 12px;  "><i><?= lang('pisahkan_dengan_enter') ?></i></span>
                                </div>
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
    <script src="<?= base_url('dist/plugins/Chart.js/Chart.js') ?>"></script>
    <script src="<?= base_url('dist') ?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="<?= base_url('dist') ?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url('dist') ?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url('dist') ?>/js/pages/tables/jquery-datatable.js"></script>
<?php endsection(); ?>

<?php section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tabel_servisan').DataTable();
        table.column(2).visible(false);
        table.column(5).visible(false);
        table.column(6).visible(false);

        var m = 0;
        var laba = new Array();
        var bulan = new Array();
        laba = [0,0,0,0,0,0,0,0,0,0,0,0]

        <?php $i=0; foreach($monthly_laba as $m){ ?>
            laba[<?= $m['bulan']-1 ?>] = '<?= $m['total'] ?>';
        <?php $i++; } ?>
        //-------------
        //- Grafik Keuntungan Bulanan -
        //-------------
        var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
        var barChart                         = new Chart(barChartCanvas)

        var areaChartData = {
            labels  : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            datasets: [
                {
                    label               : 'Keuntungan Bulanan',
                    fillColor           : 'rgba(60,141,188,0.9)',
                    strokeColor         : 'rgba(60,141,188,0.8)',
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : laba
                }
            ]
        }

        var baarChartData                     = areaChartData
        baarChartData.datasets[0].fillColor   = '#00a65a'
        baarChartData.datasets[0].strokeColor = '#00a65a'
        baarChartData.datasets[0].pointColor  = '#00a65a'
        var barChartOptions                  = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero        : true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - If there is a stroke on each bar
            barShowStroke           : true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth          : 0,
            //Number - Spacing between each of the X value sets
            barValueSpacing         : 10,
            //Number - Spacing between data sets within X values
            barDatasetSpacing       : 1,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive              : true,
            maintainAspectRatio     : true
        }

        barChartOptions.datasetFill = false
        barChart.Bar(baarChartData, barChartOptions)
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
            window.location.href = "<?= base_url('dashboard/del_servisan') ?>/"+id;
        });
    }
    function back(id){
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
            window.location.href = "<?= base_url('dashboard/back_servisan') ?>/"+id;
        });
    }
    $('#edit_servisan').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var row = button.data('row') // Extract info from data-* attributes

        var modal = $(this)

        var table = $('#tabel_servisan').DataTable();

        var data = table
        .rows(row)
        .data();

        modal.find('.modal-body #nama_cust').val(data[0][1])
        modal.find('.modal-body #no_telp').val(data[0][2])
        modal.find('.modal-body #jns_barang').val(data[0][4])

        var kelengkapan = data[0][5].split(",");
        kelengkapan.forEach(function(item,index,kelengkapan){
            modal.find('.modal-body #kelengkapan').tagsinput('add', item)
        })

        var keluhan = data[0][6].split(",");
        keluhan.forEach(function(item,index,keluhan){
            modal.find('.modal-body #keluhan').tagsinput('add', item)
        })
    })
    function edit(id_servisan){
        $("#id_servisan").val(id_servisan);
    }
</script>
<?php endsection(); ?>

<?php getview('layouts/template') ?>