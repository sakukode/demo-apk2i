<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Regulasi
  <small>Daftar Regulasi Terpublikasikan.</small>
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
          <h3 class="box-title">Regulasi List</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 300px;">
             <!--  <form id="form-search"> -->
              <input type="text" name="search" id="search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
        <!-- /.box-header -->
         <?php if(isset($search)): ?>
        <div class="box-body">
          Pencarian dengan kata kunci "<?php echo $search; ?>"  
        </div>
        <?php endif; ?>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>No.</th>
              <th>Nama Regulasi</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr>
            <?php
            $no = 1;
            if($regulations):
            foreach($regulations as $row): ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $row->name;?></td>
              <td><?php echo dateindo($row->created_at);?></td>
              <td>
                <span class="badge bg-green"><?php echo $row->status;?></span>
              </td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/regulasi/update/'.$row->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>
                <?php 
                $filename_arr = explode(".", $row->filename);
                $folder_ext = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
                ?>
                <a href="<?php echo base_url('upload/'.$folder_ext.'/'.$row->filename);?>" target="_blank" class="btn btn-primary btn-sm">Preview</a>  
              </td>
            </tr>
            <?php
            $no++;
            endforeach; else:
            ?>
            <tr>
              <td colspan="6" class="text-center">no data found. <a href="<?php echo site_url('admin/regulasi/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
            <?php echo $pagination; ?>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->