<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Update Gallery
  <small>Update Gallery for visitor.</small>
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
          <h3 class="box-title">Form Update Gallery</h3>
        </div>
        <!-- /.box-header -->
        <!-- Notif Error -->
        <div class="box-body">
          <div class="alert alert-danger" style="display:none">
            
          </div>
        </div>
        <!-- Eof Notif Error -->

        <!-- form start -->
        <?php echo form_open('admin/gallery/do_update', array('id' => 'form-gallery-update')); ?>
          <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $gallery->id;?>" />
            <div class="form-group">
              <label for="">Judul Gallery</label>
              <input type="text" class="form-control" id="" placeholder="Judul Article" name="name" value="<?php echo $gallery->name;?>">
            </div>
            <div class="form-group">
              <label>Cuplikan Gallery</label>
              <textarea class="form-control" rows="3" placeholder="Maksimal 300 Karakter dengan Spasi ..." name="description"><?php echo $gallery->description;?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Preview Image Gallery</label>
              <input type="file" class="filestyle" data-buttonText="jPG/JPEG/PNG" data-buttonName="btn-success" data-buttonBefore="true" name="image">
              <p class="help-block">Tambahkan file untuk Preview Image Gallery.</p>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
             <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."><i class="fa fa-save"></i> Submit</button>
            <a href="<?php echo site_url('admin/gallery');?>" class="btn btn-default"><i class="fa fa-chevron-circle-left fa-2"></i> Kembali</a>
          </div>
        <?php echo form_close();?>      
        <div class="overlay" style="display:none">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </section>
  <!-- /.content -->