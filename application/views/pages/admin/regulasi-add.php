<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  New Regulasi
  <small>Upload New Regulasi for visitor.</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form New Regulasi</h3>
        </div>
        <!-- /.box-header -->
        <!-- Notif Error -->
        <div class="box-body">
          <div class="alert alert-danger" style="display:none">
            
          </div>
        </div>
        <!-- Eof Notif Error -->
        <!-- form start -->
        <?php echo form_open('admin/regulasi/do_add', array('id'=> 'form-regulasi-add'));?>
          <div class="box-body">
            <div class="form-group">
              <label for="">Nama Regulasi</label>
              <input type="text" class="form-control" id="" placeholder="Nama Regulasi" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">PDF/Word Regulasi</label>
              <input type="file" class="filestyle" data-buttonText=" File PDF/Word" data-buttonName="btn-success" data-buttonBefore="true" name="file">
              <p class="help-block">Tambahkan file untuk detail Regulasi.</p>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
             <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."><i class="fa fa-save"></i> Submit</button>
            <a href="<?php echo site_url('admin/regulasi');?>" class="btn btn-default"><i class="fa fa-chevron-circle-left fa-2"></i> Kembali</a>
          </div>
        <?php echo form_close();?>
        <div class="overlay" style="display:none">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
      <!-- /.box -->
    </div>
    </div>
  </section>
  <!-- /.content -->