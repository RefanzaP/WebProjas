<?php if ($this->session->flashdata('successMessage')) { ?>
<div class="alert bg-green alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?= $this->session->flashdata('successMessage') ?>
</div>
<?php } ?>
<?php if ($this->session->flashdata('errorMessage')) { ?>
<div class="alert bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?= $this->session->flashdata('errorMessage') ?>
</div>
<?php } ?>
<?php if ($this->session->flashdata('errorField')) { ?>
<div class="alert bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?= $this->session->flashdata('errorField') ?>
</div>
<?php } ?>