<div class="content">
<div class="hosting-section">
	<div class="container">
		<h2>GALLERY</h2>
		<div class="hosting-grids">
		<?php
		$no = 1;
		if($galleries):
		foreach($galleries as $row):
		?>
			<div class="col-md-4 hosting-grid">
				<div class="hosting-grd">
					<a class="" href="<?php echo site_url('gallery/detail/'.$row->slug);?>"><img src="<?php echo base_url('upload/images/'.$row->thumbnail);?>" class="img-responsive" alt=""><span class="zoom-icon"></span></a>
				</div>
				<a href="<?php echo site_url('gallery/detail/'.$row->slug);?>"><h4><?php echo $row->name;?></h4></a>
				<p><?php echo $row->description;?></p>
			</div>

		<?php if($no % 3 == 0): ?>

			<div class="clearfix"> </div>
		</div>
		<div class="hosting-grids">
		<?php endif; ?>

		<?php
		$no++;
		endforeach;
		endif;
		?>
		</div>
	</div>

		<div class="container">
			<nav style="margin-left: 20px;">
				<?php echo $pagination; ?>
			</nav>
		</div>
	
</div>
<!--hosting-->
</div>
