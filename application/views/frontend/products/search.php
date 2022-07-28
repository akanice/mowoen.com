	<div class="main">	
		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<figure>
					<img src="<?php if ($type == 'bathroom') {?>/assets/img/page_cover4.jpg<?php } else {?>/assets/img/page_cover3.jpg<?php } ?>" title="mowoen" class="lazyload img-holder stage__image stage__image--reduced">
				</figure>
			</div>
		</section>
		
		<?php if ($categories) { ?>
		<section class="menu_cat">
			<div class="pop-navigation" data-t-name="PopNavigation" data-t-id="4">
				<div class="pop-navigation__selection">
					<div class="headline-group col-6">
						<div class="headline-lead">Hiển thị tất cả</div>
						<h1 id="popTopLevel" class="h2 pop-navigation__headline js-toggle-filter"><?php if (@$category_data) {echo $category_data->title;} else {echo 'All Products';}?><span class="fa fa-angle-down"></span>
						</h1>
					</div>
					<!--<div class="headline-group col-6">
						<div class="headline-lead">&nbsp;</div>
						<h2 id="popSubLevel" class="h2 pop-navigation__headline js-toggle-filter">All<span class="icon-chevron-up"></span>
						</h2>
					</div>-->
				</div>
				<div class="pop-navigation__filter js-pop-filter" style="display: none;">
					<div class="filterblock filterblock--bright js-pop-filterblock" data-filter-level="popTopLevel">
						<?php if ($categories) { foreach ($categories as $item) {?>
						<a href="<?=base_url($type.'/products').'?cat_id='.$item->id?>" class="filterblock__item <?php if ($item->id == @$category_data->id) echo 'filterblock__item--selected';?>"><?=$item->title?></a>
						<?php }}?>
					</div>
				</div>
			</div>
		</section>
		<?php }?>
		
		<section class="utility-bar">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="pop__result-count mt-5">
							<strong>Kết quả tìm kiếm: <span class="h2 pop__result-count-heading js-result-count"><?=@$total?></span>&nbsp;sản phẩm</strong>
						</div>
					</div>
					<div class="col-6">
						
					</div>
				</div>
			</div>
		</section>
		
		<section class="grid_product ratio_square">
			<div class="container">
				<div class="product-wrapper-grid">
					<div class="row">
						<?php if ($products) { foreach ($products as $item) { ?>
						<div class="col-xl-3 col-sm-4 col-6 col-grid-box"><!-- Product 1 -->
							<div class="product-box">
								<div class="img-block">
									<a href="<?=@base_url($item->type.'/products/'.$item->alias)?>" class="bg-size" style="background-image: url('<?=base_url($item->thumb)?>')"></a>
								</div>
								<div class="product-info product-content">
									<a href="<?=@base_url($item->type.'/products/'.$item->alias)?>">
										<h6><b><?=@$item->type?></b> <?=@$item->title?> - <span class="text-success"><?=@$item->sku?></span></h6>
									</a>
									<!--<div class="item-price">
										<span itemprop="price" class="price amount"><h5>2.450.000 đ</h5></span>
										<span class="old-price regular-price">2.550.000 đ</span>
									</div>-->
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
					

					<ul class="pagination js-pagination-list">
						<?php echo $page_links;?>
					</ul>
				</div>
			</div>
		</section>
		

	</div>