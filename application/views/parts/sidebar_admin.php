<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
   <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-home"></i> <span>Homepage</span></a></li>
        <li><a href="<?php echo site_url();?>" target="_blank"><i class="fa fa-globe"></i> <span>Visit Site</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-tasks"></i> <span>Next Event</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('admin/event/add');?>">Upload New Event</a></li>
            <li><a href="<?php echo site_url('admin/event');?>">Daftar Event</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href=""><i class="fa fa-newspaper-o"></i> <span>Regulasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('admin/regulasi/add');?>">Upload New Regulasi</a></li>
            <li><a href="<?php echo site_url('admin/regulasi');?>">Daftar Regulasi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-sticky-note-o"></i> <span>Articles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('admin/article/add');?>">Create New Articles</a></li>
            <li><a href="<?php echo site_url('admin/article');?>">Daftar Articles</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-file-image-o"></i> <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('admin/gallery/add');?>">Create New Gallery</a></li>
            <li><a href="<?php echo site_url('admin/gallery');?>">Daftar Gallery</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
  </li>
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>