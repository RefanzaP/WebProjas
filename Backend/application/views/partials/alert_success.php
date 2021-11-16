<?php if($this->session->flashdata("alert_success")){ ?>
swal({
    title: "Sukses",
    text: "<?= $this->session->flashdata("alert_success") ?>",
    type: "success",
    
    confirmButtonClass: 'btn-success',
    confirmButtonText: 'OK'
  });
<?php } ?>
