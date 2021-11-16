<?php 
	$usr = $this->db->get('personal_data')
					->result_array();
?>
<div class="form-group">
    <select id="id_user" class="form-control select2" name="id_user" style="width: 100%;">
        <?php foreach($usr as $row){ ?>
        	<option value="<?= $row['id_user'] ?>"><?= ucwords($row['nama']." - Rp. ".$row['gaji']) ?></option>
	    <?php } ?>
    </select>
</div>