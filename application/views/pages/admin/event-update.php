<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Update Event
  <small>Update Event for visitor.</small>
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
          <h3 class="box-title">Form Update Event</h3>
        </div>
        <!-- /.box-header -->
        <!-- Notif Error -->
        <div class="box-body">
          <div class="alert alert-danger" style="display:none">
            
          </div>
        </div>
        <!-- Eof Notif Error -->
        
        <!-- form start -->
        <?php echo form_open('admin/event/do_update', array('id' => 'form-event-update')); ?>
          <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $event->id;?>" />
            <div class="form-group">
              <label for="">Nama Event</label>
              <input type="text" class="form-control" id="" placeholder="Nama Event" name="name" value="<?php echo $event->name;?>" />
            </div>
            <div class="form-group">
              <label>Pilih Status Event</label>
              <select class="form-control" name="status">
                <option value="">-- Status Event --</option>
                <option value="ongoing" <?php echo $event->status == 'ongoing' ? 'selected' : ''?>>Berjalan</option>
                <option value="done" <?php echo $event->status == 'done' ? 'selected' : ''?>>Selesai</option>
              </select>
            </div>
            <div class="form-group">
              <label>PDF/Word Event</label>
             <!--  <input type="file" id="userfile"> -->
             <input type="file" class="filestyle" data-buttonText="File PDF/Word" data-buttonName="btn-success" data-buttonBefore="true" name="file">
              <p class="help-block">Tambahkan file untuk detail Event.</p>
            </div>
          </div>
          <!-- /.box-body -->          
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."><i class="fa fa-save"></i> Submit</button>
            <a href="<?php echo site_url('admin/event');?>" class="btn btn-default"><i class="fa fa-chevron-circle-left fa-2"></i> Kembali</a>
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