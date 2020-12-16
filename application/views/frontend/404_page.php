	<section class="newsgrid">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12 center" style="padding: 50px 0">
					<h4 class="">Xin lỗi, trang bạn yêu cầu không được tìm thấy</h4>
					<a href="<?=site_url()?>" class="btn btn-more"><i class="fa fa-home"></i> Quay về Trang chủ</a>
				</div>
			</div>
			
			<div class="row clearfix It-Specials-prod innovatoryProductFilter innovatoryProductGrid notfound-products">
				<div class="col-sm-4 offset-sm-1">
					<div class="">
						<div class="block-title">
							<h5 class="page-heading"><span>Sản phẩm bán chạy nhất</span></h5>
						</div>
						<div class="prod-filter itContent row">
							<div class="col-sm-12">
								<div class="" id="">
									<?php $i=0;
									if ($mostviewed) foreach ($mostviewed as $item) {
									?>
									<div class="item-inner  ajax_block_product wow fadeInUp">
										<div class="item product-box  ajax_block_product js-product-miniature clearfix clearfix" data-id-product="<?=$item->id?>">
											<div class="product-image">
												<?php 
													$cat_array = json_decode($item->categoryid);
													$cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
												?>
												<a href="<?=base_url($cat_alias.'/'.$item->alias)?>" class="thumb" style="background:url('<?=base_url($item->thumb)?>');background-size: cover;background-position: center"></a>
											</div>
											<div class="product-info product-detail">
												<a href="<?=base_url($cat_alias.'/'.$item->alias)?>"><h3 class="title"><?=$item->title?></h3></a>
												<div class="innovatory-product-price-and-shipping">
													<span itemprop="price" class="price">
														<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
																echo number_format($item->sale_price,0,',','.').' đ';
																	} else {
																		if ($item->price != 0) {
																			echo number_format($item->price,0,',','.');
																		} else {
																			echo 'Liên hệ';
																		}
																} ?>
													</span>
													<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="old-price regular-price"><?=@number_format($item->price,0,',','.')?> đ</span><?php } ?>
													<span class="percent-label">(<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><?php echo '-'.round(($item->price-$item->sale_price)*100/$item->price,0)?>%<?php } ?>)</span>
												</div>
												<span class="innovatorySale-label"><i class="fa fa-gift"></i> Giảm sốc</span>
											</div>
										</div><!-- end item -->
									</div>
									<?php $i++;} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4 offset-sm-2">
					<div class="">
						<div class="block-title">
							<h5 class="page-heading"><span>Sản phẩm mới nhất</span></h5>
						</div>
						<div class="prod-filter itContent row">
							<div class="col-sm-12">
								<div class="" id="">
									<?php $i=0;
									if ($newest) foreach ($newest as $item) {
									?>
									<div class="item-inner  ajax_block_product wow fadeInUp">
										<div class="item product-box  ajax_block_product js-product-miniature clearfix clearfix" data-id-product="<?=$item->id?>">
											<div class="product-image">
												<?php 
													$cat_array = json_decode($item->categoryid);
													$cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
												?>
												<a href="<?=base_url($cat_alias.'/'.$item->alias)?>" class="thumb" style="background:url('<?=base_url($item->thumb)?>');background-size: cover;background-position: center"></a>
											</div>
											<div class="product-info product-detail">
												<a href="<?=base_url($cat_alias.'/'.$item->alias)?>"><h3 class="title"><?=$item->title?></h3></a>
												<div class="innovatory-product-price-and-shipping">
													<span itemprop="price" class="price">
														<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
																echo number_format($item->sale_price,0,',','.').' đ';
																	} else {
																		if ($item->price != 0) {
																			echo number_format($item->price,0,',','.');
																		} else {
																			echo 'Liên hệ';
																		}
																} ?>
													</span>
													<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="old-price regular-price"><?=@number_format($item->price,0,',','.')?> đ</span><?php } ?>
													<span class="percent-label">(<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><?php echo '-'.round(($item->price-$item->sale_price)*100/$item->price,0)?>%<?php } ?>)</span>
												</div>
												<span class="innovatorySale-label"><i class="fa fa-gift"></i> Giảm sốc</span>
											</div>
										</div><!-- end item -->
									</div><?php $i++;} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>