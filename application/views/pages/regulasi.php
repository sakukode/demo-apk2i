<div class="table-regulasi row">
	<div class="container">
		<div class="col-md-12 col-lg-12 hidden-xs">
			<h2 style="margin-top: 30px; margin-bottom: 30px;">Regulasi</h2>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td>Nomor</td>
						<td>Judul</td>
						<td>Menu</td>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				if($regulations):
				foreach($regulations as $row):
				?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->name;?></td>
						<td>
							<?php
							$filename_arr = explode(".", $row->filename);
							$folder = $filename_arr[1] == 'pdf' ? 'pdf' : 'word';
							?>
							<a href="<?php echo base_url('upload/'.$folder.'/'.$row->filename);?>" target="_blank" class="btn btn-danger">Baca</a>
						</td>
					</tr>
				<?php
				$no++;
				endforeach; else:
				?>
				<tr>
					<td colspan="3">No regulation found</td>
				</tr>
				<?php
				endif;
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row" style="margin-bottom:150px">
	<div class="container">
		<nav style="margin-left: 20px;">
			<?php echo $pagination; ?>
		</nav>
	</div>
</div>