<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Dashboard
  <small>Homepage Admin Apk2i</small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Regulasi</span>
          <span class="info-box-number"><?php echo $total_regulasi;?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Event</span>
          <span class="info-box-number"><?php echo $total_event;?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-sticky-note-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Articles</span>
          <span class="info-box-number"><?php echo $total_article;?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-file-image-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Gallery</span>
          <span class="info-box-number"><?php echo $total_gallery;?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- /.row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Article Terbaru</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Judul Article</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr>
            <?php
            $no = 1;
            if($current_article):
            foreach($current_article as $article):
            ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $article->name;?></td>
              <td><?php echo dateindo($article->created_at);?></td>
              <td><span class="badge bg-green"><?php echo $article->status;?></span></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/article/update/'.$article->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $article->id;?>" data-name="<?php echo $article->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>
                <?php 
                $filename_arr = explode(".", $article->filename);
                $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                ?>
                <a href="<?php echo base_url('upload/'.$folder_ext.'/'.$article->filename);?>" target="_blank" class="btn btn-primary btn-sm">Preview</a> 
              </td>
            </tr>
            <?php
            $no++;
            endforeach;
            ?>
            <tr>
              <td colspan="6" class="text-center"><a href="<?php echo site_url('admin/article');?>">lihat selengkapnya</a></td>
            </tr>
            <?php else: ?>
            <tr>
              <td colspan="6">no data found. <a href="<?php echo site_url('admin/article/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Regulasi Terbaru</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama Regulasi</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr>
            <?php
            $no = 1;
            if($current_regulasi):
            foreach($current_regulasi as $regulasi):
            ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $regulasi->name;?></td>
              <td><?php echo dateindo($regulasi->created_at);?></td>
              <td><span class="badge bg-green"><?php echo $regulasi->status;?></span></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/regulasi/update/'.$regulasi->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $regulasi->id;?>" data-name="<?php echo $regulasi->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>
                <?php 
                $filename_arr = explode(".", $regulasi->filename);
                $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                ?>
                <a href="<?php echo base_url('upload/'.$folder_ext.'/'.$regulasi->filename);?>" target="_blank" class="btn btn-primary btn-sm">Preview</a> 
              </td>
            </tr>
            <?php
            $no++;
            endforeach;
            ?>
            <tr>
              <td colspan="6" class="text-center"><a href="<?php echo site_url('admin/regulasi');?>">lihat selengkapnya</a></td>
            </tr>
            <?php else: ?>
            <tr>
              <td colspan="6">no data found. <a href="<?php echo site_url('admin/regulasi/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>            
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Event Terbaru</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Nama Event</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr>    
            <?php
            $no = 1;
            if($current_event):
            foreach($current_event as $event):
            ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $event->name;?></td>
              <td><?php echo dateindo($event->created_at);?></td>
              <td><span class="badge bg-green"><?php echo $event->status;?></span></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/event/update/'.$event->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $event->id;?>" data-name="<?php echo $event->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>
                <?php 
                $filename_arr = explode(".", $event->filename);
                $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                ?>
                <a href="<?php echo base_url('upload/'.$folder_ext.'/'.$event->filename);?>" target="_blank" class="btn btn-primary btn-sm">Preview</a> 
              </td>
            </tr>
            <?php
            $no++;
            endforeach;
            ?>
            <tr>
              <td colspan="6" class="text-center"><a href="<?php echo site_url('admin/event');?>">lihat selengkapnya</a></td>
            </tr>
            <?php else: ?>
            <tr>
              <td colspan="6">no data found. <a href="<?php echo site_url('admin/event/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>              
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Galeri Terbaru</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No</th>
              <th>Judul Gallery</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr> 
            <?php
            $no = 1;
            if($current_gallery):
            foreach($current_gallery as $gallery):
            ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $gallery->name;?></td>
              <td><?php echo dateindo($gallery->created_at);?></td>
              <td><span class="badge bg-green"><?php echo $gallery->status;?></span></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/regulasi/update/'.$gallery->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $gallery->id;?>" data-name="<?php echo $gallery->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>                
                <a href="<?php echo site_url('admin/gallery/view/'.$gallery->id);?>" class="btn btn-primary btn-sm">Preview</a> 
              </td>
            </tr>
            <?php
            $no++;
            endforeach;
            ?>
            <tr>
              <td colspan="6" class="text-center"><a href="<?php echo site_url('admin/gallery');?>">lihat selengkapnya</a></td>
            </tr>
            <?php else: ?>
            <tr>
              <td colspan="6">no data found. <a href="<?php echo site_url('admin/regulasi/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>                 
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>