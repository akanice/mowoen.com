<div class="main blog-page blog-main-page">	
		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<div class="bg-top-page"></div>
			</div>
		</section>
		
		<div class="title-box bg-page-header customized">
			<section class="page-title custom_spacing" data-init-top="37" data-init-bottom="36">
				<div class="container header_center text-center d-flex justify-content-center align-items-center flex-column">
					<div class="title">
						<h1><?=@$posts_category->title?></h1>
					</div>
					<nav class="bread-crumbs">
						<a href="<?=site_url()?>" rel="v:url" property="v:title">Trang chủ</a>
						<span class="delimiter"></span>
						<span class="current">Danh mục: <?=@$posts_category->title?></span></nav><!-- .breadcrumbs -->
				</div>
			</section>
		</div>

		<section class="blog-content">

		</section>
		
		<div class="main-page category_content blog_grid_list">
			<div class="container">
				<div class="grid-row clearfix">
					<?php if($posts) {foreach ($posts as $item) {?>
					<article class="item post-item post type-post mb-3">
						<div class="post-wrapper d-flex justify-content-between align-items-end ratio43_square">
							<div class="post-media post-grid-media"><a href="<?=@base_url($item->alias)?>" class="pic bg-size" style="background-image:url('<?=@base_url($item->thumb)?>')"></a></div>
							<div class="post-info">
								<div class="post-info-header d-flex justify-content-between align-items-center m-0">
									<div class="post-meta-item post-category"><a href="<?=base_url('chuyen-muc/'.@$item->cat_data->alias)?>" rel="category tag"><?=@$item->cat_data->title?></a></div>
									<div class="post-info-header-divider"></div>
									<div class="post-meta-item post-likes"><span class="sl-wrapper"><a href="#" class="sl-button" title="Like"><span class="sl-icon liked"></span><span class="sl-count"><?=@$item->meta_data['likes']?></span></a><span class="sl-loader"></span></span></div>
								</div>
								<h3 class="post-title"><a href="<?=@base_url($item->alias)?>"><?=@$item->title?></a></h3>
								<div class="post-content">
									<?php if ($item->excerpt!='') {echo strip_tags($item->excerpt);} else {$excerpt = substr(strip_tags($item->description), 0, 200); echo $excerpt;} ?>
									...
								</div>
								<div class="post-info-footer d-flex justify-content-between align-items-center">
									<div class="post-meta-wrapper d-flex justify-content-between align-items-center">
										<div class="post-meta d-flex justify-content-start align-items-center flex-shrink-0">
											<div class="post-meta-item post-author d-flex align-items-center mr-2"><span class="post-author-avatar mr-2"><a href="#"><img alt="" src="<?=base_url($user_data->avatar)?>" class="avatar" height="35" width="35" loading="lazy"></a></span><span class="post-author-name"><?=@$user_data->name?></span></div>
											<div class="post-meta-item post-date"><?php echo date_format(date_create($item->create_time),"d/m/y"); ?></div>
										</div>
										<div class="post-info-footer-divider"></div>
									</div>
									<div class="read-more-wrapper"><a href="<?=@base_url($item->alias)?>" class="read-more"><i class="icon fa fa-angle-right"></i> <b>Đọc thêm</b></a></div>
								</div>
							</div>
						</div>
					</article>
					<?php }} else {echo 'Chưa có bài viết nào trong mục này';}?>
				</div>
				<ul class="pagination js-pagination-list">
					<?php echo $page_links;?>
				</ul>
			</div>
		</div>