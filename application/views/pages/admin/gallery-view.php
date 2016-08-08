<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Gallery 
  <small>view</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <!-- /.row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <div class="box-body">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Judul</td>
                  <td><?php echo $gallery->name;?></td>
                </tr>
                <tr>
                  <td>Cuplikan</td>
                  <td><?php echo $gallery->description;?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?php echo $gallery->status;?></td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td><?php echo dateindo($gallery->created_at);?></td>
                </tr>
                <tr>
                  <td>Preview Image</td>
                  <td>
                    <img src="<?php echo base_url('upload/images/'.$gallery->thumbnail);?>" />
                  </td>
                </tr>
                <tr>
                  <td>Dibuat Oleh</td>
                  <td><?php echo user($gallery->created_by, 'first_name')." ".user($gallery->created_by, 'last_name');?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <a href="<?php echo site_url('admin/gallery');?>" class="btn btn-default"><i class="fa fa-chevron-circle-left fa-2" aria-hidden="true"></i> Kembali</a>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- IMAGES LIST -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Images</h3>  
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <!-- notif success -->
          <div class="alert alert-success notif-success-save-videos" style="display:none">
             
          </div>
          <!-- eof notif success -->

          <!-- notif error -->
          <div class="alert alert-danger notif-error-save-videos" style="display:none">
             
          </div>
          <!-- eof notif error -->

         
          <div class="box-body">
            <div class="row">

              <?php
              if($gallery->images):
              foreach($gallery->images as $image):
              $path_img = $image->filename != '' ? base_url('upload/images/')."/".$image->filename : 'https://placeholdit.imgix.net/~text?txtsize=33&txt=image&w=400&h=233';
              ?>
              <?php echo form_open('admin/gallery/save_image/'.$gallery->id, array('class'=> 'form-save-image', 'id'=> $image->id));?>
              <div class="col-md-3 profile-picture" align="center">                
                <img id="img-<?php echo $image->id;?>" src="<?php echo $path_img;?>" width="240px" height="160px"> 
                <br />                    
                <input type="hidden" name="image_id" value="<?php echo $image->id;?>" />
                <span class="btn btn-default btn-file btn-block">
                    Upload Foto <input type="file" name="image" id="image" />
                </span>                
              </div>
              <?php echo form_close(); ?>
              <?php
              endforeach;
              endif;
              ?>
            </div>
          </div>

         
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- EOF IMAGES LIST -->

      <!-- VIDEO LIST -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Video</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <!-- notif success -->
          <div class="alert alert-success notif-success-save-videos" style="display:none">
             
          </div>
          <!-- eof notif success -->

          <!-- notif error -->
          <div class="alert alert-danger notif-error-save-videos" style="display:none">
             
          </div>
          <!-- eof notif error -->

         
          <div class="box-body">
            <?php echo form_open('admin/gallery/save_videos/'.$gallery->id, array('id'=> 'form-save-videos'));
            $no = 1;
            if($gallery->videos):
            foreach($gallery->videos as $video):
            ?>
            <div class="form-group">
              <label>Video <?php echo $no;?></label>
              <input type="hidden" name="video_id[]" value="<?php echo $video->id;?>" />
              <input type="text" name="video_url[]" value="<?php echo $video->url;?>" class="form-control" />
            </div>
            <?php
            $no++;
            endforeach;
            endif;
            form_close();
            ?>
          </div>

          <div class="box-footer">
            <button type="submit" id="btnSaveVideos" class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading..."><i class="fa fa-save"></i> Save Changes</button>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- EOF VIDEO LIST -->

    </div>
  </div>
</section>
<!-- /.content -->