<?php 
    $belum_dikerjakan = $this->db->select("count(*) as jumlah")
                                ->where("status", 0)
                                ->get("servisan")
                                ->row_array();
    $proses = $this->db->select("count(*) as jumlah")
                        ->where("status", 3)
                        ->where("teknisi", $this->session->userdata("id_user"))
                        ->get("servisan")
                        ->row_array();
    $belum_divalidasi = $this->db->select("count(*) as jumlah")
                                ->where("status", 0)
                                ->get("data_pengeluaran")
                                ->row_array();
    $tidak_valid = $this->db->select("count(*) as jumlah")
                            ->where("status", 2)
                            ->where("id_user", $this->session->userdata("id_user"))
                            ->get("data_pengeluaran")
                            ->row_array();

    $role = $this->session->userdata('role'); 
?>
<!-- MENU Navigasi -->
<li class="header"><?= lang("menu_navigasi") ?></li>
<li>
    <a href="<?= base_url("dashboard") ?>">
        <i class="fa fa-th-large"></i> <span><?= lang("beranda") ?></span>
    </a>
</li>

<!-- MENU CHECK ADMIN -->
<?php if($role == 1){ ?>
    <li class="header"><?= lang("menu_admin") ?></li>
    <li>
    	<a href="<?= base_url("admin/price") ?>">
    		<i class="fa fa-shopping-cart"></i> <span><?= lang("price_list") ?></span>
    	</a>
    </li>
    <li>
    	<a href="<?= base_url("admin/employee") ?>">
    		<i class="fa fa-user-circle"></i> <span><?= lang("employee_list") ?></span>
    	</a>
    </li>
    <li>
        <a href="<?= base_url("admin/to_technician") ?>">
            <i class="fa fa-exclamation-circle"></i> <span><?= lang("beri_tugas_teknisi") ?></span>
            <?php if($belum_dikerjakan['jumlah']>0){ ?>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right"><?= $belum_dikerjakan['jumlah'] ?></span>
                </span>
            <?php } ?>
        </a>
    </li>
<?php } ?>

<!-- Menu Teknisi -->
<?php if($role == 3 || $role == 2 || $role == 1){ ?>
    <li class="header"><?= lang("menu_teknisi") ?></li>
    <li>
        <a href="<?= base_url("technician/job") ?>">
            <i class="fa fa-wrench"></i> <span><?= lang("job_teknisi") ?></span>
            <?php if($belum_dikerjakan['jumlah']>0){ ?>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right"><?= $belum_dikerjakan['jumlah'] ?></span>
                </span>
            <?php } ?>
        </a>
    </li>
    <li>
        <a href="<?= base_url("technician/job/lists") ?>">
            <i class="fa fa-list"></i> <span><?= lang("daftar_pekerjaan") ?></span>
            <?php if($proses['jumlah']>0){ ?>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right"><?= $proses['jumlah'] ?></span>
                </span>
            <?php } ?>
        </a>
    </li>
    <li>
        <a href="<?= base_url("technician/job/output_list") ?>">
            <i class="fa fa-shopping-cart"></i> <span><?= lang("data_pengeluaran_anda") ?></span>
            <?php if($tidak_valid['jumlah']>0){ ?>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right"><?= $tidak_valid['jumlah'] ?></span>
                </span>
            <?php } ?>
        </a>
    </li>
<?php } ?>

<!-- Menu Manajemen -->
<?php if($role == 3 || $role == 1){ ?>
    <li class="header"><?= lang("menu_manajemen") ?></li>
    <li>
        <a href="<?= base_url("management/job/payroll") ?>">
            <i class="fa fa-money"></i> <span><?= lang("daftar_gaji_teknisi") ?></span>
        </a>
    </li>
    <li>
        <a href="<?= base_url("management/job/fin_history") ?>">
            <i class="fa fa-money"></i> <span><?= lang("riwayat_keuangan") ?></span>
        </a>
    </li>
    <li>
        <a href="<?= base_url("management/job") ?>">
            <i class="fa fa-check"></i> <span><?= lang("validasi_pengeluaran") ?></span>
            <?php if($belum_divalidasi['jumlah']>0){ ?>
                <span class="pull-right-container">
                    <span class="label label-danger pull-right"><?= $belum_divalidasi['jumlah'] ?></span>
                </span>
            <?php } ?>
        </a>
    </li>
<?php } ?>

<!-- MENU Hak Akses -->
<li class="header"><?= lang("hak_akses") ?></li>
<li>
  	<a href="<?= base_url("account/edit") ?>">
    	<i class="ion ion-person"></i> <span><?= lang("akun_anda") ?></span>
  	</a>
</li>