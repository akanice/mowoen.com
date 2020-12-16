		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?=@$category_data->title?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		<section id="home_banners" class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 service-block">
						<img src="/assets/uploads/images/banners/z2123725751016_5d639609146c46cfbc0f7e80abf3f0bc.jpg" class="img-holder">
					</div>
				</div>
			</div>
		</section>
		
		<section id="featured_categories" class="block-section it_category_feature product_page">
			<div class="container absolute-bg">
				<div class="row clearfix">
					<div class="col-sm-10 offset-sm-1">
					<!--<h2 class="title center">Danh mục sản phẩm</h2>-->
						<div class="itCategoryFeature owl-carousel owl-theme" id="featured_categories_slide">
							<?php if ($categories) foreach ($categories as $item) {?>
							<div class="item-inner">
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
		
		<section class="section-b-space ratio_square product_page">
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
																<div class="page-title">
																	<h2><i class="fa fa-atom"></i> <?=@$category_data->title?></h2>
																</div>
																<?php 
																if ($this->uri->segment(3) !='') {
																	$record_num = end($this->uri->segment_array());
																	$current_url = current_url();
																	$action_url = str_replace('/'.$record_num ,'',$current_url);
																} else {
																	$action_url = current_url();
																}
																?>
																<form class="form-inline" method="GET" action="<?=$action_url?>">
																	<div class="col-filter">
																		<select class="form-control filter" name="f_brand" id="f_brand">
																			<option value="all">Nhãn hiệu</option>
																			<?php foreach ($brands as $item) { if($item->id == 0) {continue;}?>
																				<option value="<?=@$item->id?>" <?php if (@$f_brand==$item->alias) {echo 'selected';}?>><?=$item->name?></option>
																			<?php }?>
																		</select>
																	</div>
																	<div class="col-filter">
																		<select class="form-control filter" name="f_country" id="f_country">
																			<option value="all" >Xuất xứ</option>
																			<?php foreach ($made_in as $item) { if($item->made_in == '' or $item->made_in == '---') {continue;}?>
																				<option value="<?=@$item->made_in?>"><?=$item->made_in?></option>
																			<?php }?>
																		</select>
																	</div>
																	<div class="col-filter">
																		<select class="form-control filter" name="f_price" id="f_price">
																			<option value="all">Khoảng giá</option>
																			<option value="tu-0-den-2">dưới 2 triệu</option>
																			<option value="tu-2-den-4">2-4 triệu</option>
																			<option value="tu-4-den-6">4-6 triệu</option>
																			<option value="tu-6-den-10">6-10 triệu</option>
																			<option value="tu-10">Trên 10 triệu</option>
																		</select>
																	</div>
																	<div class="col-filter">
																		<select class="form-control filter" name="f_year" id="f_year">
																			<option value="all">Năm bảo hành</option>
																			<option value="1">1</option>
																			<option value="2">2</option>
																			<option value="3">3</option>
																			<option value="4">4</option>
																			<option value="5">5</option>
																		</select>
																	</div>
																	<?php $i = 0;
																	if(@$custom_field && $custom_field != '') {
																	foreach ($custom_field as $c) { $p_name=make_alias($c->packname)?>
																	<div class="col-filter">
																		<select class="form-control filter" name="f_customdata[][<?=$p_name?>]" id="">
																			<option value="all"><?=@$c->packname?></option>
																			<?php $packvalue = explode(",",$c->packvalue);foreach( $packvalue as $pv ) {?>
																				<option value="<?=$pv?>" <?php if (@$v[$i]==$pv) echo 'selected';?>><?=$pv?></option>
																			<?php }?>
																		</select>
																	</div>
																	<?php $i++;} }?>
																	<div class="col-filter last pull-right">
																		<button type="submit" class="btn btn-solid btn-solid-sm mr-1"><i class="fa fa-search"></i> Tìm kiếm</button>
																		<a href="<?=base_url('danh-muc'.$category_data->alias)?>" class="btn btn-solid btn-solid-sm"><i class="far fa-trash-alt"></i> Thiết lập lại</a>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="product-wrapper-grid">
												<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5">
													<?php //print_r($products);die();
														if ($products) { foreach ($products as $item) { ?>
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
																<nav aria-label="Page navigation">
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
		<script>
		$(document).ready(function() {
			<?php if ($f_brand) {?>$("#f_brand").val('<?php echo $f_brand;?>');<?php } ?>
			<?php if ($f_country) {?>$("#f_country").val('<?php echo $f_country;?>');<?php } ?>
			<?php if ($f_price) {?>$("#f_price").val('<?php echo $f_price;?>');<?php } ?>
			<?php if ($f_year) {?>$("#f_year").val('<?php echo $f_year;?>');<?php } ?>
			<?php if ($f_p_order) {?>$("#f_p_order").val('<?php echo $f_p_order;?>');<?php } ?>
		});
		</script>