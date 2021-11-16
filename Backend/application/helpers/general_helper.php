<?php 
function to_date($data){
	$year = substr($data, 0, 4);
	$moon = substr($data, 5,2);
	$day = substr($data, 8,2);
	$date = $day.'-'.$moon.'-'.$year;
	return $date;
}

function to_date_time($data){
	$year = substr($data, 0, 4);
	$moon = substr($data, 5,2);
	$day = substr($data, 8,2);
	$time = substr($data, 11);
	$date = $day.'-'.$moon.'-'.$year.' '.$time;
	return $date;
}

function get_mont($data){
	switch ($data) {
		case 1:
			echo 'Januari';
			break;
		case 2:
			echo 'Februari';
			break;
		case 3:
			echo 'Maret';
			break;
		case 4:
			echo 'April';
			break;
		case 5:
			echo 'Mei';
			break;
		case 6:
			echo 'Juni';
			break;
		case 7:
			echo 'Juli';
			break;
		case 8:
			echo 'Agustus';
			break;
		case 9:
			echo 'September';
			break;
		case 10:
			echo 'Oktober';
			break;
		case 11:
			echo 'November';
			break;
		case 12:
			echo 'Desember';
			break;
	}
}

function jk($data){
	if($data == 1){
		echo 'Laki-laki';
	}else{
		echo 'Perempuan';
	}
}

function role($data){
	if($data == 0){
		echo 'Superuser';
	}else if($data == 1){
		echo 'Admin';
	}else if($data == 2){
		echo 'Technician';
	}else if($data == 3){
		echo 'Management';
	}
}
function status_servisan($data){
	if($data == 0){ ?>
		<button type="button" class="btn bg-red"><?= lang('belum') ?></button>
	<?php }if($data == 1){ ?>
		<button type="button" class="btn btn-info"><?= lang('selesai') ?></button>
	<?php }if($data == 2){ ?>
		<button type="button" class="btn bg-amber"><?= lang('batal') ?></button>
	<?php }if($data == 3){ ?>
		<button type="button" class="btn btn-success"><?= lang('proses') ?></button>
	<?php }
}
function status_validasi($data){
	if($data == 0){ ?>
		<button type="button" class="btn bg-red"><?= lang('belum_divalidasi') ?></button>
	<?php }if($data == 1){ ?>
		<button type="button" class="btn btn-info"><?= lang('valid') ?></button>
	<?php }if($data == 2){ ?>
		<button type="button" class="btn bg-amber"><?= lang('tidak_valid') ?></button>
	<?php }
}
function status_kembali($data){
	if($data == 0){ ?>
		<button type="button" class="btn bg-red"><?= lang('belum_kembali') ?></button>
	<?php }if($data == 1){ ?>
		<button type="button" class="btn btn-info"><?= lang('sudah_kembali') ?></button>
	<?php }
}
?>