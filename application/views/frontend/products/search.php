		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Tìm kiếm: "<?=@$name?>"</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		<section id="featured_categories" class="block-section it_category_feature product_page">
			<div class="container absolute-bg">
				<div class="row clearfix">
					<div class="col-sm-10 offset-sm-1">
						<div class="itCategoryFeature owl-carousel owl-theme" id="featured_categories_slide">
							<?php if ($categories) foreach ($categories as $item) {?>
							<div class="item-inner first_item">
								<a href="<?=@base_url('danh-muc/'.$item->alias)?>">
									<div class="item">
										<img src="<?=@base_url($item->thumb)?>" class="img-holder">
										<h5 class="center"><?=@$item->title?></h5>
									</div>
								</a>
							</div>
							<?php } ?>
						</div>
						<div class="btn-owl-group">
							<div class="btn-navleft navbtn"><i class="fa fa-angle-left"></i></div>
							<div class="btn-navright navbtn"><i class="fa fa-angle-right"></i></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="section-b-space ratio_square">
			<div class="collection-wrapper">
				<div class="container">
					<div class="row">
						<div class="collection-content col">
							<div class="page-main-content">
								<div class="row">
									<div class="col-sm-12">
										<div class="collection-product-wrapper">
											<div class="product-top-filter">
												<div class="container-fluid p-0">
													<div class="row">
														<div class="col-12">
															<div class="product-filter-content">
																<div class="search-count">
																	<h5>Kết quả tìm kiếm cho: "<?=@$name?>"</h5>
																</div>
																<div class="product-page-per-view">
																	
																</div>
																<div class="product-page-filter">
																	
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="product-wrapper-grid">
												<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5">
													<?php if ($products) { foreach ($products as $item) { ?>
													<div class="col col-grid-box">
														<div class="product-box">
															<div class="img-block">
																<a href="<?=base_url('san-pham/'.$item->alias)?>" class="bg-size" style="background-image: url('<?=base_url($item->thumb)?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
																<div class="quick-info">
																	<a href="<?=base_url('san-pham/'.$item->alias)?>" ></a>
																	<div class="text">
																		<?=$item->short_description?>
																	</div>
																</div>
															</div>
															<div class="product-info">
																<a href="<?=base_url('san-pham/'.$item->alias)?>"><h6><?=@$item->title?></h6></a>
																<div class="item-price">
																	<span itemprop="price" class="price amount">
																	<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
																			echo '<h5>'.number_format($item->sale_price,0,',','.').' đ</h5>';
																				} else {
																					if ($item->price != 0) {
																						echo '<h5>'.number_format($item->price,0,',','.').'</h5>';
																					} else {
																						echo 'Liên hệ';
																					}
																			} ?>
																</span>
																<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="old-price regular-price"><del><?=@number_format($item->price,0,',','.')?> đ</span><?php } ?></del>
																</div>
															</div>
														</div>
													</div>
													<?php }} else {echo 'Chưa có sản phẩm nào trong mục này';}?>
												</div>
											</div>
											
											<div class="product-pagination mb-0">
												<div class="theme-paggination-block">
													<div class="container-fluid p-0">
														<div class="row">
															<div class="col-sm-12 d-flex justify-content-end">
																<nav class="kabu-navigation Page navigation">
																	<ul class="pagination">
																		<?php echo $page_links;?>
																	</ul>
																</nav>
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>										
			</div>
		</section>