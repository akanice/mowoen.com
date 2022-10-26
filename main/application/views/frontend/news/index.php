		<div class="innovatoryBreadcrumb">
			<div class="container">
				<nav data-depth="3" class="breadcrumb hidden-sm-down">
					<ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="#">
								<span itemprop="name"><i class="fa fa-home"></i></span>
							</a>
							<meta itemprop="position" content="1">
						</li>
						<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
							<a itemprop="item" href="#">
								<span itemprop="name">Blog</span>
							</a>
							<meta itemprop="position" content="2">
						</li>
					</ol>
				</nav>
			</div>
		</div>
		
		<div id="contents" class="main-page category_content blog_grid_list">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-9 blogpage blog-category">
						<div class="inner">
							<h1 class="title">Blog</h1>
							<hr>
							<div class="blog-list pos-new-blog">
								<div class="row clearfix">
									<?php if($news) {foreach ($news as $item) {?>
									<div class="col-12 col-sm-6 col-md-4">
										<div class="item">
											<div class="item-ii">
												<div class="news_module">
													<a href="<?=@base_url('bai-viet/'.$item->alias)?>" class="thumb" style="background: url('<?=@base_url($item->thumb)?>');background-size: cover;background-position: center;"></a>
												</div>
												<div class="description">
													<h2 class="post_title"><a href="<?=@base_url('bai-viet/'.$item->alias)?>"><?=@$item->title?></a></h2>
													<div class="date_added"><?php echo date_format(date_create($item->create_time),"d/m/Y"); ?></div>
													<div style="max-height: 68px;overflow: hidden;">
														<p><?=@$item->description?></p>
													</div>
												</div>
												<div class="readmore align-right"><a href="<?=@base_url('bai-viet/'.$item->alias)?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> Đọc thêm</a></div>
											</div>
										</div>
									</div>
									<?php }} else {echo 'Chưa có bài viết nào trong mục này';}?>
									
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