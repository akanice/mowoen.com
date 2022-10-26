			<section id="featured_combo" class="block-section featured_combo">
				<div class="container">
					<div class="row clearfix It-Specials-prod innovatoryProductFilter innovatoryProductGrid">
						<div class="col-sm-12">
							<div class="">
								<div class="block-title">
									<h2 class="page-heading"><span>Sản phẩm bán chạy nhất</span></h2>
								</div>
								<div class="prod-filter itContent row">
									<div class="col-sm-12">
										<div class="owl-carousel owl-theme owl-loaded owl-drag" id="best_seller_products">
											<?php $i=0;
											if ($mostviewed) foreach ($mostviewed as $item) {
											if ($i%2 == 0) { echo '<div class="item-inner  ajax_block_product wow fadeInUp">';}
											?>
												<div class="item product-box  ajax_block_product js-product-miniature clearfix clearfix" data-id-product="<?=$item->id?>">
													<?php 
														$cat_array = json_decode($item->categoryid);
														$cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
													?>
													<div class="product-image">
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
															<span class="percent-label"><?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><?php echo '-'.round(($item->price-$item->sale_price)*100/$item->price,0)?>%<?php } ?></span>
														</div>
														<div class="extra_des"><?if ($item->extra_des) {?><i class="fa fa-gift"></i> <?=@$item->extra_des;}?>&nbsp;</div>
														<span class="innovatorySale-label"><i class="fa fa-gift"></i> Giảm sốc</span>
													</div>
												</div><!-- end item -->
											<?php if ($i%2 == 1) { echo '</div>';}?>
											<?php $i++;} ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section><!-- end section feature categories -->