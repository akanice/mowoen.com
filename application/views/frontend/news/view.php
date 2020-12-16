		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									<?php if (isset($category)) {$space='';?>
										<span>
											<?php foreach ($category as $n) {?>
												<?=$space;?><a class="crumb" href="<?=base_url('chuyen-muc/'.$n->alias)?>"><?=@$n->title?></a>
											<?php $space=', ';} ?>
											<?php } ?>
										</span>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		<div id="contents" class="main-page category_content blog_grid_list">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-7 blog-page blog-detail">
						<div class="inner">
							<h1 class="title"><?=@$new_data->title?></h1>
							<small><i class="fa fa-calendar"></i> <?php echo date_format(date_create($new_data->create_time),"d/m/Y"); ?></small>
							<hr>
							<!--<?php if ($new_data->thumb != '') {?><p><img src="<?=base_url($new_data->thumb);?>" class="post-thumb"></p><?php }?>-->
							<div class="">
								<div class="content">
									<?=@$new_data->content?>
									<div class="related_articles">
										<h4>Bài viết liên quan</h4>
										<ul>
											<?php if ($related_news) { foreach ($related_news as $item) {?>
											<li>
												<a href="<?=@base_url('bai-viet/'.$item->alias)?>" class="title">
													<h5><i class="fa fa-link"></i> <?=@$item->title?></h5>
													<div class="time"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></div>
												</a>
											</li>
											<?php }} ?>
										</ul>
									</div><hr>
									
								</div>
							</div>
						</div>
					</div>
					
					<aside id="left" class="sidebar col-lg-3 col-md-3 col-sm-12">
						<div class="widget widget_product_categories">
							<div class="widget-inner">
								<div class="block-title-widget">
									<h2><span>Chuyên mục khác</span></h2>
								</div>
								<ul class="product-categories">
									<?php if ($categories) {foreach ($categories as $cat) {?>
									<li class="cat-item"><a href="<?=@base_url('chuyen-muc/'.$cat->alias)?>"><?=@$cat->title?></a></li>
									<?php } } else {echo 'Chưa có chuyên mục bài viết';}?>
								</ul>
							</div>
						</div>
						
						<div class="widget widget_product_categories">
							<div class="widget-inner">
								<div class="block-title-widget">
									<h2><span>Bài viết liên quan</span></h2>
								</div>
								<ul class="product-categories">
									<?php if ($news_sidebar) {foreach ($news_sidebar as $cat) {?>
									<li class="cat-item"><a href="<?=@base_url('bai-viet/'.$cat->alias)?>"><i class="fa fa-link"></i> <?=@$cat->title?></a>
										<div class="datetime"><small><?php echo date_format(date_create($cat->create_time),"d/m/Y"); ?></small></div>
									</li>
									<?php } } else {echo 'Hiện chưa có bài viết mới';}?>
								</ul>
							</div>
						</div>
						
					</aside>
					
					<aside id="left" class="sidebar col-lg-2 col-md-2 col-sm-12 d-none d-sm-block">
						<img class="img-holder" src="/assets/img/sidebar-3.jpg">
					</aside>
					
				</div>
			</div>
		</div>