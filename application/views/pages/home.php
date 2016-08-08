<div class="content">
	<div class="brilliant-section">
		<div class="container">
			<h2>Next Event &amp; Aktifitas &amp; Kegiatan.</h2>
			<div class="brilliant-grids">
				<div class="col-md-6 brilliant-grid" style="margin-bottom: 30px;">
					<div class="brilliant-left">
						<i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>
					</div>
					<div class="brilliant-right">
						<h4><a href="#">News</a></h4><a href="#">
						</a><p><a href="#">Discover a variety of news updates to update your information</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-6 brilliant-grid">
					<div class="brilliant-left">
						<i class="glyphicon glyphicon-bell" aria-hidden="true"></i>
					</div>
					<div class="brilliant-right">
						<?php 
						$filename_arr = explode(".", $latest_event->filename);
						$folder = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
						?>
						<h4><a href="<?php echo base_url('upload/'.$folder.'/'.$latest_event->filename);?>" target="_blank ">Next Event</a></h4><a href="<?php echo base_url('upload/'.$folder.'/'.$latest_event->filename);?>" target="_blank ">
						</a><p><a href="<?php echo base_url('upload/'.$folder.'/'.$latest_event->filename);?>" target="_blank ">The latest information related to the activities and events held by APK2I</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-6 brilliant-grid">
				<div class="brilliant-left">
					<i class="glyphicon glyphicon-link" aria-hidden="true"></i>
				</div>
				<div class="brilliant-right">
					<a href="#" class="btn" data-toggle="modal" data-target=".modal-artikel-apk2i"><h4 style="margin-left: -10px;">Articles</h4></a>
					<p style="color: #202020;">Get interesting articles to add information and your knowledge</p>
				</div>
				<div class="clearfix"></div>
			</div>

			<!-- MODAL NEWEST ARTICLE-->
			<!-- Large modal -->
			<div class="modal fade modal-artikel-apk2i" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="row" style="margin: 30px;">
							<?php
							if($articles):
							foreach($articles as $article):
							?>
							<div class="col-sm-6 col-md-6">
								<div class="thumbnail">
									<img style="margin-bottom: 20px;" src="<?php echo base_url('upload/images/'.$article->thumbnail);?>" class="img-responsive" alt="<?php echo $article->name;?>">
									<div class="caption">
										<h3 style="margin-bottom: 15px;"><?php echo $article->name;?></h3>
										<p style="margin-bottom: 20px;"><?php echo $article->description;?></p>
										<p>
											<?php
											$filename_arr = explode(".", $article->filename);
											$folder_ext = $filename_arr[1] == 'pdf' ? 'pdf': 'word';
											?>
											<a href="<?php echo base_url('upload/'.$folder_ext.'/'.$article->filename);?>" target="_blank " dclass="btn btn-read-apk2i btn-primary" role="button">Read More</a>
										</p>
									</div>
								</div>
							</div>
							<?php
							endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL NEWEST ARTICLE CLOSE -->


			<div class="col-md-6 brilliant-grid">
				<div class="brilliant-left">
					<i class="glyphicon glyphicon-picture" aria-hidden="true"></i>
				</div>
				<div class="brilliant-right">
					<h4><a href="<?php echo site_url('gallery');?>">Gallery</a></h4><a href="gallery.html">
					</a><p><a href="<?php echo site_url('gallery');?>">Documentation of activities and events have been organized by APK2I</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<div class="post-section">
	<div class="container">
		<h3>Check our recent posts</h3>
		<h5>We like to keep everyone updated</h5>
		<div class="post-grids">
			<?php
			if($galleries):
			foreach($galleries as $gallery):
			?>
			<div class="col-md-4 post-grid">
				<a href="<?php echo site_url('gallery/detail/'.$gallery->slug);?>" class="mask"><img src="<?php echo base_url('upload/images/'.$gallery->thumbnail);?>" class="img-responsive zoom-img" alt="/"></a>
				<a href="<?php echo site_url('gallery/detail/'.$gallery->slug);?>"><h4><?php echo $gallery->name;?></h4></a>				
			</div>
			<?php
			endforeach;
			endif;
			?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>