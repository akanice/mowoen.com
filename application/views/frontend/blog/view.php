	<div class="main blog-page blog-detail-page">	
		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<div class="bg-top-page"></div>
			</div>
		</section>
		
		<div class="title-box bg-page-header customized">
			<section class="page-title custom_spacing" data-init-top="37" data-init-bottom="36">
				<div class="container header_center text-center d-flex justify-content-center align-items-center flex-column">
					<div class="title">
						<h1><?=@$post_data->title?></h1>
					</div>
					<nav class="bread-crumbs">
						<a href="<?=site_url()?>" rel="v:url" property="v:title">Trang chủ</a>
						<span class="delimiter"></span>
						<span class="current"><?=@$post_data->title?></span></nav><!-- .breadcrumbs -->
				</div>
			</section>
		</div>
		
		<section class="blog-content">
			<div class="container">
				<div class="grid-row clearfix">
					<div class="news single">
						<article class="col-sm-12">
							<div class="post-media post-single-media ratio43_square">
								<a href="#" class="pic bg-size fix-size" style="background-image:url('<?=@$post_data->image?>')">
								</a>
							</div>
							<div class="post-info">
								<div class="post-content">
									<?=@$post_data->description?>
								</div>
							</div>
						</article>
						<div class="single-post-meta clearfix">
							<div class="post-meta-item post-author">
								<span class="post-author-avatar">
									<a href="#"><img alt="" src="<?=base_url($user_data->avatar)?>" class="avatar avatar-35 photo" height="35" width="35" loading="lazy"></a>
								</span>
								<span class="post-author-name"><a href="#" rel="author"><?=@$user_data->name?></a></span>
							</div>
							<div class="post-meta-item post-likes">
								<span class="sl-wrapper">
									<a href="#" class="sl-button sl-button-590" title="Like"><span class="sl-icon liked"></span><span class="sl-count">69</span></a>
									<span class="sl-loader"></span>
								</span>
							</div>
							<div class="post-meta-item post-category"><a href="<?=base_url('chuyen-muc/'.@$category[0]->alias)?>" class="category tag"><?=@$category[0]->title?></a></div>
						</div>
					</div>
				</div>

				<div class="grid-row single-post-links">
					<div class="nav-post-links d-flex justify-content-between align-items-center clearfix">
						<div class="current-post"></div>
						<div class="prev-post nav-post">
							<?php if (@$prevRow && $prevRow!= null) {?>
							<a href="<?=base_url($prevRow->alias)?>" class="nav-post-link d-flex justify-content-start align-items-center ratio_square position-relative">
								<span class="nav-post-text"><?=@$prevRow->title?></span>
								<span class="nav-post-thumb bg-size pic" style="background-image:url('<?=base_url($prevRow->thumb)?>')"></span>
								<span class="nav-post-info"><span class="nav-post-title">Media Optimization</span><span class="nav-post-date"><?php echo date_format(date_create($prevRow->create_time),"d/m/y"); ?></span></span>
							</a>
							<?php } ?>
						</div>
						<div class="next-post nav-post">
							<?php if (@$nextRow && $nextRow!= null) {?>
							<a href="<?=base_url($nextRow->alias)?>" class="nav-post-link d-flex justify-content-end align-items-center ratio_square position-relative">
								<span class="nav-post-text">Next Post</span>
								<span class="nav-post-info">
									<span class="nav-post-title"><?=@$nextRow->title?></span>
									<span class="nav-post-date"><?php echo date_format(date_create($nextRow->create_time),"d/m/y"); ?></span>
								</span>
								<span class="nav-post-thumb bg-size pic" style="background-image:url('<?=base_url($nextRow->thumb)?>')"></span>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>

				<div class="grid-row single-related mb-5">
					<h3 class="related-item ce-title">Bài viết liên quan</h3>
					<section class="clearfix news posts-grid">
						<div class="wrapper">
							<div class="row row-cols-2 row-cols-sm-3 row-cols-md-3">
							<?php if ($related) { foreach ($related as $item) {?>
								<article class="col item post-item related-item">
									<div class="post-media post-grid-media ratio43_square"><a href="#" class="pic bg-size fix-size" style="background-image:url('<?=@$item->thumb?>')"></a></div>
									<div class="post-info">
										<div class="post-info-header d-flex justify-content-between align-items-center">
											<h3 class="post-title"><a href="#"><?=@$item->title?></a></h3>
											<div class="post-meta-item post-category"><a href="<?=base_url('chuyen-muc/'.@$item->cat_data->alias)?>" class="category tag"><?=@$item->cat_data->title?></a></div>
										</div>
										<div class="post-content">
											<?php if ($item->excerpt!='') {echo strip_tags($item->excerpt);} else {$excerpt = substr(strip_tags($item->description), 0, 100); echo $excerpt;} ?>
											...
										</div>
										<div class="post-info-footer">
											<div class="post-meta-wrapper d-flex align-items-center">
												<div class="post-meta-item post-author d-flex align-items-center mr-2">
													<span class="post-author-avatar mr-2">
														<a href="#"><img alt="" src="<?=base_url($user_data->avatar)?>" class="avatar avatar-35 photo" height="35" width="35" loading="lazy"></a>
													</span>
													<span class="post-author-name"><a href="#" title="Posts by <?=$user_data->name?>" rel="author"><?=$user_data->name?></a></span></div>
												<div class="post-meta-item post-date mr-2"><?php echo date_format(date_create($item->create_time),"d/m/y"); ?></div>
												<div class="post-meta-item post-likes mr-2"><span class="sl-wrapper"><span class="sl-icon liked"></span><span class="sl-count">47</span></span></div>
											</div>
										</div>
									</div>
								</article>
							<?php }} ?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</section>
		