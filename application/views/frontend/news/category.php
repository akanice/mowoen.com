		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
								<li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
									<span itemprop="name"><?=@$news_category->title?></span>
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
					<div class="col-md-9 blogpage blog-category">
						<div class="inner">
							<h1 class="title"><?=@$news_category->title?></h1>
							<hr>
							<div class="blog-list pos-new-blog">
								<div class="row clearfix">
									<?php if($list_articles) {foreach ($list_articles as $item) {?>
									<div class="col-12 col-sm-6 col-md-4">
										<div class="item">
											<div class="item-ii">
												<div class="news_module">
													<a href="<?=@base_url('bai-viet/'.$item->alias)?>"  class="thumb" style="background: url('<?=@base_url($item->thumb)?>');background-size: cover;background-position: center;"></a>
												</div>
												<div class="description">
													<h2 class="post_title"><a href="<?=@base_url('bai-viet/'.$item->alias)?>"><?=@$item->title?></a></h2>
													<div class="date_added"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></div>
													<div style="max-height: 68px;overflow: hidden;">
														<p><?=@strip_tags($item->description)?></p>
													</div>
												</div>
												<div class="readmore align-right"><a href="<?=@base_url('bai-viet/'.$item->alias)?>" class="btn btn-readmore btn-sm"><i class="fa fa-arrow-right"></i> Đọc thêm</a></div>
											</div>
										</div>
									</div>
									<?php }} else {echo 'Chưa có bài viết nào trong mục này';}?>									
								</div>
								<div class="clear"></div>
								<div class="products-nav clearfix">
									<nav class="kabu-navigation">
										<ul class="pagination">
											<?php echo $page_links;?>
										</ul>
									</nav>
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
									<?php } } else {echo 'Chưa có chuyên mục bài viết nào';}?>
								</ul>
							</div>
						</div>
						<div class="widget widget_product_categories">
							<div class="widget-inner">
								<div class="block-title-widget">
									<h2><span>Bài viết mới nhất</span></h2>
								</div>
								<ul class="product-categories">
									<?php if ($news_sidebar) {foreach ($news_sidebar as $cat) {?>
									<li class="cat-item"><a href="<?=@base_url('bai-viet/'.$cat->alias)?>"><?=@$cat->title?></a>
										<div class="datetime"><small><?php echo date_format(date_create($cat->create_time),"d/m/Y"); ?></small></div>
									</li>
									<?php } } else {echo 'Hiện chưa có bài viết mới';}?>
								</ul>
							</div>
						</div>
					</aside>
					
				</div>
			</div>
		</div>