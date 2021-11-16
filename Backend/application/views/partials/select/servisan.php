<?php 
	$res = $this->db->where("status_kembali",1)
					->get('servisan')
					->result_array();
?>
<div class="form-group">
    <select id="id_servisan" class="form-control select2" name="id_servisan" data-placeholder="<?= lang("masukkan").lang("servisan") ?>" style="width: 100%;">
        <?php foreach($res as $row){ ?>
        	<option value="<?= $row['id_servisan'] ?>"><?= $row['nama_cust']." - ".$row['jns_barang']." - ".$row['keluhan'] ?></option>
	    <?php } ?>
    </select>
</div>