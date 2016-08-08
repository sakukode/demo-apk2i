<?php if($this->session->flashdata('success_message')): ?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Sukses!</h4>
	<?php echo $this->session->flashdata('success_message'); ?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error_message')): ?>
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
	<?php echo $this->session->flashdata('error_message'); ?>
</div>
<?php endif; ?>