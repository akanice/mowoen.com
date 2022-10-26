			<section id="blog_share" class="block-section keywords">
				<div class="container">
					<div class="row clearfix">
						<div class="col-sm-12">
							<div class="">
								<div class="block-title">
									<h2 class="page-heading"><span><i class="vu_fb-restaurant"></i> Kiến thức nhà bếp</span>
										<div class="readmore-button"><a href="<?=base_url('blog/');?>">Xem thêm các bài viết khác <i class="fa fa-arrow-right"></i></a></div>
									</h2>
								</div>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="tes-item" style="background: url('/assets/img/home_slide4.jpg') no-repeat center center; background-size: cover">
								<div class="b2 text-white tes-content w-lg-33">
									<?=@$article->description;?>
									<h3 class="tes-name"><a href="<?=base_url('bai-viet/'.@$article->alias)?>"><?=@$article->title;?></a></h3>
									<div class="tes-time"><i class="fa fa-calendar"></i> <?php echo date_format(date_create(@$article->create_time),"d/m/Y"); ?></div>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="inner side-news">
								<ul>
									<?php if ($home_news) foreach ($home_news as $item) { ?>
									<li>
										<a href="<?=base_url('bai-viet/'.$item->alias)?>" class="thumb" style="background: url('<?=base_url($item->thumb)?>') no-repeat center center; background-size: cover"></a>
										<a href="<?=base_url('bai-viet/'.$item->alias)?>" class="title">
											<h5><?=$item->title?></h5>
											<div class="time"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></div>
										</a>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>