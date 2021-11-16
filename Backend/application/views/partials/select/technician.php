<?php 
	$usr = $this->db->where("role !=",1)
					->join("personal_data p","u.id_user=p.id_user","left")
					->get('user u')
					->result_array();
?>
<div class="form-group">
    <select id="teknisi" class="form-control select2" name="teknisi" data-placeholder="<?= lang("masukkan").lang("servis") ?>" style="width: 100%;">
        <?php foreach($usr as $row){ ?>
        	<option value="<?= $row['id_user'] ?>"><?= ucwords($row['nama']) ?></option>
	    <?php } ?>
    </select>
</div>