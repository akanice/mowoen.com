		<section id="slider" class="home_slider">
			<div class="clearfix">
				<div id="home_slider" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php $n = $number_slider; for ($i = 0; $i < $n; $i++) { ?>
							<li data-target="#home_slider" data-slide-to="<?php echo $i;?>" class="<?php if ($i == '0') {echo 'active';}?>"></li>
						<?php } ?>
					</ol>
					<div class="carousel-inner">
						<?php 
							if (!empty($slider)) {
							foreach ($slider as $item) { 
								$item_id[] = $item->id;
							}
							$min_value = min($item_id);
						?>
						<?php foreach ($slider as $item) { ?>
						<div class="carousel-item <?php if ($item->id == $min_value) {echo 'active';}?>">
							<a href="<?=$item->link?>"><img src="<?=base_url($item->image)?>" alt="<?=$item->name?>" class="img-holder d-block w-100"></a>
						</div>
						<?php } } ?>
					</div>
					<!--<a class="carousel-control-prev" href="#home_slider" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#home_slider" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>-->
				</div>
			</div>
		</section>
