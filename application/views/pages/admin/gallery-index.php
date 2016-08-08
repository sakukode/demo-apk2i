<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Gallery
  <small>Daftar Gallery Terpublikasikan.</small>
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
          <h3 class="box-title">Gallery List</h3>
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
              <th>No</th>
              <th>Judul Gallery</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Action</th>
              <th>Preview</th>
            </tr>
            <?php
            $no = 1;
            if($galleries):
            foreach($galleries as $row): ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $row->name;?></td>
              <td><?php echo dateindo($row->created_at);?></td>
              <td><span class="badge bg-green"><?php echo $row->status;?></span></td>
              <td>
                <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/gallery/update/'.$row->id);?>"><i class="fa fa-pencil"></i> ubah</a> 
                <a href="#" class="btn-remove btn btn-danger btn-sm" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->name;?>"><i class="fa fa-trash"></i> hapus</a>
              </td>
              <td>
                <a href="<?php echo site_url('admin/gallery/view/'.$row->id);?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
              </td>
            </tr>
            <?php
            $no++;
            endforeach; else:
            ?>
            <tr>
              <td colspan="6" class="text-center">no data found. <a href="<?php echo site_url('admin/gallery/add');?>">add new</a></td>
            </tr>
            <?php
            endif;
            ?>
          </table>
        </div>
        <div class="box-body">
            <?php echo $pagination; ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->