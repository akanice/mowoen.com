	<section class="breadcrumb-section section-b-space section-t-space">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb" class="theme-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
							<li class="breadcrumb-item active" aria-current="page">Videos</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
		
	<div id="contents" class="video-page">
		<section class="block-section video-related">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-12">
						<h4 class="title text-left"></h4>
						<div class="videos-list row row-cols-2 row-cols-xs-2 row-cols-md-3 row-cols-lg-4 clearfix">
							<?php if ($all_videos == '' or $all_videos == null) { ?>
							<div class="col-md-12"><h5>Hiện chưa có Video liên quan</h5></div>
							<?php } else {	foreach ($all_videos as $item) { ?>
							<div class="col">
								<div class="item center">
									<a href="<?=base_url('videos/'.$item->alias)?>" class="video-thumb"><img src="<?=$item->thumb?>" class="img-holder"></a>
									<div class="video-des">
										<a href="<?=base_url('videos/'.$item->alias)?>" class="text-left">
											<h5><?=$item->title?></h5>
										</a>
									</div>
								</div>
							</div>
							<?php } }?>
						</div>
						
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<?php echo $page_links;?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
	</div>