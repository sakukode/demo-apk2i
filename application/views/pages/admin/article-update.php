<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Update Article
  <small>Update Article for visitor.</small>
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
          <h3 class="box-title">Form Update Article</h3>
        </div>
        <!-- /.box-header -->

        <!-- Notif Error -->
        <div class="box-body">
          <div class="alert alert-danger" style="display:none">
            
          </div>
        </div>
        <!-- Eof Notif Error -->
        <!-- form start -->
        <?php echo form_open('admin/article/do_update', array('id' => 'form-article-update')); ?>
          <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $article->id;?>" />
            <div class="form-group">
              <label for="">Judul Article</label>
              <input type="text" class="form-control" id="" placeholder="Judul Article" name="name" value="<?php echo $article->name;?>" />
            </div>
            <div class="form-group">
              <label>Cuplikan Article</label>
              <textarea class="form-control" rows="3" placeholder="Maksimal 200 Karakter dengan Spasi ..." name="description"><?php echo $article->description;?></textarea>
            </div>          
            <div class="form-group">
              <label for="exampleInputFile">PDF/Word Article</label>
              <input type="file" class="filestyle" data-buttonText="File PDF/Word" data-buttonName="btn-success" data-buttonBefore="true" name="file">
              <p class="help-block">Tambahkan file untuk detail Article.</p>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Preview Image Article</label>
              <input type="file" class="filestyle" data-buttonText="JPG/JPEG/PNG" data-buttonName="btn-success" data-buttonBefore="true" name="image">
              <p class="help-block">Tambahkan file untuk Image Article.</p>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."><i class="fa fa-save"></i> Submit</button>
            <a href="<?php echo site_url('admin/article');?>" class="btn btn-default"><i class="fa fa-chevron-circle-left fa-2"></i> Kembali</a>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </section>
  <!-- /.content -->