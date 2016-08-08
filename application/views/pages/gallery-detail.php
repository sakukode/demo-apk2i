<div class="content" style="min-height: 700px;margin-bottom:150px">
<div class="hosting-section">
	<div class="container">
		<h2><?php echo $gallery->name;?></h2>
		<br />
		<p><?php echo $gallery->description;?></p>

		<br />
		<!-- IMAGES -->
		<h3>IMAGES</h3>
		<hr>
		<div class="hosting-grids">	
		<?php
		$no = 1;
		if($gallery->images):
		foreach($gallery->images as $image):
		if($image->filename != "" || $image->filename != null):
		?>		
			<div class="col-md-4 hosting-grid">
				<div class="hosting-grd">
					<a class="swipebox" href="<?php echo base_url('upload/images/'.$image->filename);?>"><img src="<?php echo base_url('upload/images/'.$image->filename);?>" class="img-responsive" alt=""><span class="zoom-icon"></span></a>
				</div>
			</div>
		<?php
			if($no % 3 == 0):
		?>
			<div class="clearfix"> </div>
		</div>
		<div class="hosting-grids">
		<?php
		endif;
		endif;
		$no++;
		endforeach;
		endif;
		?>
		</div>
		<!-- EOF IMAGES -->

		<h3>VIDEOS</h3>
		<hr>
		<div class="hosting-grids">
		<?php
		$no = 1;
		if($gallery->videos):
		foreach($gallery->videos as $video):
		if($video->url != "" || $video->url != null):
		?>		
			<div class="col-md-4 hosting-grid">
				<div class="hosting-grd">					
					<iframe height="250" width="100%" src="<?php echo $video->url;?>"></iframe>
				</div>
			</div>
		<?php
			if($no % 3 == 0):
		?>
			<div class="clearfix"> </div>
		</div>
		<div class="hosting-grids">
		<?php
		endif;
		endif;
		$no++;
		endforeach; else :
		?>
		<h4>No Video</h4>
		<?php
		endif;
		?>
		</div>	
	
	</div>
</div>
<!--hosting-->
</div>

<script type="text/javascript">
jQuery(function($) {
	$(".swipebox").swipebox();
});
</script>