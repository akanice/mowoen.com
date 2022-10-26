			<section id="featured_categories" class="block-section it_category_feature"><!-- section feature categories -->
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-12">
							<div class="block-title">
								
							</div>
							<div class="itCategoryFeature owl-carousel owl-theme" id="featured_categories_slide">
								<?php $i=0;
								if ($categories) foreach ($categories as $item) {
								?>
								<div class="item-inner first_item">
									<a href="<?=base_url('danh-muc/'.$item->alias)?>">
										<div class="item">
											<img src="<?=base_url($item->thumb)?>" class="img-holder">
											<h5 class="center"><?=$item->title?></h5>
										</div>
									</a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</section><!-- end section feature categories -->