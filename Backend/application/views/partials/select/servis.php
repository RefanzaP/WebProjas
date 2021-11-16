<div class="form-group">
    <select id="servis" class="form-control select2" name="servis[]" multiple="multiple" data-placeholder="<?= lang("masukkan").lang("servis") ?>" style="width: 100%;">
        <?php foreach($this->db->get('servis')->result_array() as $row){ ?>
        	<option value="<?= $row['id_servis'] ?>"><?= ucwords($row['nama_servis']) ?></option>
	    <?php } ?>
    </select>
</div>