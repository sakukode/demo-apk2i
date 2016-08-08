<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Currently Event
  <small>Daftar Event Sudah Berjalan</small>
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
          <h3 class="box-title">Event View</h3>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <div class="box-header with-border"><h3><?php echo $event->name;?></h3></div>

          <div class="box-body">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Status</td>
                  <td><?php echo $event->status == 'ongoing' ? 'Berjalan' : 'Selesai';?></td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td><?php echo dateindo($event->created_at);?></td>
                </tr>
                <tr>
                  <td>File</td>
                  <td>
                    <?php 
                    $filename_arr = explode(".", $event->filename);
                    $folder_ext = $filename_arr[1];
                    ?>
                    <a href="<?php echo base_url('upload/'.$folder_ext.'/'.$event->filename);?>" target="_blank"><?php echo $event->filename;?></a>
                  </td>
                </tr>
                <tr>
                  <td>Dibuat Oleh</td>
                  <td><?php echo user($event->created_by, 'first_name')." ".user($event->created_by, 'last_name');?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <a href="<?php echo site_url('admin/event');?>" class="btn btn-primary"><i class="fa fa-chevron-circle-left fa-2" aria-hidden="true"></i> Kembali</a>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->