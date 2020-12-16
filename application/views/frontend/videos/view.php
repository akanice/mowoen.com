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
		<section id="videos" class="block-section"><!-- section feature categories -->
			<div class="container">
				<div class="row clearfix">		
				
					<div class="col-sm-12">
						<div class="block-title">
							<h1 class="title"><i class="fab fa-youtube"></i> <?=@$video->title?></h1>
						</div>
						<div class="row no-gutters clearfix">
							<div class="col-sm-8 yt-main-video">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe width="" height="" src="https://www.youtube.com/embed/<?=@$video->id_youtube?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
								</div>
							</div>
							<div class="col-sm-4 yt-thumb-list">
								<h4 class="title">Videos liên quan</h4>
								<div class="inner">
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
								</div>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</section><!-- end section feature categories -->
		
		<section class="block-section video-related">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-12">
						<h4 class="title text-left">Video khác</h4>
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
					</div>
				</div>
			</div>
		</section>
	</div>