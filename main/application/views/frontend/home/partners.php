			<section id="home_brands" class="block-section"><!-- section feature categories -->
				<div class="container">
					<div class="row clearfix">		
					
						<div class="col-sm-7">
							<div class="block-title">
								<h2 class="page-heading"><span>Videos</span></h2>
							</div>
							<div class="row no-gutters clearfix">
								<div class="col-sm-6 yt-main-video">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe width="" height="" src="https://www.youtube.com/embed/<?=@$video->id_youtube?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
									</div>
									<h4 class="title"><?=@$video->title?></h4>
								</div>
								<div class="col-sm-6 yt-thumb-list">
									<div class="">
										<?php if ($list_video) {?>
										<ul>
											<?php foreach ($list_video as $v) {?>
											<li class="row no-gutters row-eq-height">
												<a href="<?=@base_url('videos/').$v->alias?>" class="yt-link col-2"><img src="<?=@$v->thumb?>"></a>
												<a href="<?=@base_url('videos/').$v->alias?>" class="yt-link col-10"><h5><?=@$v->title	?></h5></a>
											</li>
											<?php } ?>
										</ul>
										<?php } ?>
										<div class="text-right"><a href="<?=@base_url('videos/')?>" class="yt-readmore">Xem thêm Video <i class="fa fa-long-arrow-alt-right"></i></a></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-5">
							<div class="block-title">
								<h2 class="page-heading"><span>Thương hiệu đối tác</span></h2>
							</div>
							<!--<div class="brands_list owl-carousel owl-theme" id="home_brands_slider">-->
							<div class="brands_list row row-cols-4 row-cols-xs-4 row-cols-md-4 row-cols-lg-5">
								<?php $i=1;if ($brands) foreach ($brands as $item) { ?>
								<div class="col">
									<div class="item">
										<a href="<?=base_url('brands/'.$item->alias)?>" rel="nofollow"><img src="<?=base_url($item->image)?>" class="img-holder" alt="<?=@$item->name?>"></a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						
					</div>
				</div>
			</section><!-- end section feature categories -->