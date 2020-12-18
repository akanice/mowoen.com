<div class="main">	
	<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<figure>
					<img src="/assets/img/page_cover.jpg" title="mowoen" class="lazyload img-holder stage__image stage__image--reduced">
				</figure>
			</div>
		</section>
		
		<?php if ($categories)?>
		<section class="menu_cat">
			<div class="pop-navigation" data-t-name="PopNavigation" data-t-id="4">
				<div class="pop-navigation__selection">
					<div class="headline-group col-6">
						<div class="headline-lead">Show all</div>
						<h1 id="popTopLevel" class="h2 pop-navigation__headline js-toggle-filter">Showers<span class="fa fa-angle-down"></span>
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
						<?php if ($categories) { foreach ($categories as $item) { ?>
						<a href="<?=current_url().'?cat_id='.$item->id?>" class="filterblock__item <?php if ($item->id == $category_data->id) echo 'filterblock__item--selected';?>"><?=$item->title?></a>
						<?php }?>
					</div>
				</div>
			</div>
		</section>
		<?php }?>
		
		<section class="utility-bar">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="pop__result-count">
							<strong><span class="h2 pop__result-count-heading js-result-count"><?=@$total?></span>&nbsp;sản phẩm</strong>
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
						<div class="col-xl-3 col-6 col-grid-box"><!-- Product 1 -->
							<div class="product-box">
								<div class="img-block">
									<a href="<?=@base_url($item->type.'/products/'.$item->alias)?>" class="bg-size" style="background-image: url('/assets/img/sample_2.jpg')"></a>
								</div>
								<div class="product-info product-content">
									<a href="#">
										<h6><b><?=@$item->type?></b> <?=@$item->title?></h6>
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
					
					<!-- Pagination -->
					<ul class="pagination js-pagination-list">
						<li class="pagination__step pagination__step--disabled">
							<span class="pagination__step-icon icon-chevron-left"></span>
							<span class="hidden--s">back</span>
						</li>
						<li class="pagination__item active">
							<span>1</span>
						</li>
						<li class="pagination__item ">
							<a class="js-pagination" href="#" >2</a>
						</li>
						<li class="pagination__item ">
							<a class="js-pagination" href="#" >3</a>
						</li>
						<li class="pagination__item ">
							<a class="js-pagination" href="#" >4</a>
						</li>
						<li class="pagination__step">
							<a href="#" class="js-pagination" rel="next">
								<span class="pagination__step-icon icon-chevron-right"></span>
								<span class="hidden--s">next</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</section>
		
		<?php if (@$related_cat) {?>
		<section id="list_category" class="home_feature_cat">
			<div class="container">
				<div class="row row-cols-3">
					<?php foreach ($related_cat as $item) {?>
					<div class="col"><!-- Col 1 -->
						<div class="item">
							<a href="<?=current_url().'?cat_id='.$item->id?>" target="_self">
								<div class="inner has-image">
									<figure>
										<img src="<?=base_url($item->image)?>" alt="Large rain shower from hansgrohe." class="lazyload teaser_img img-holder" >
									</figure>
									<div class="teaser_body">
										<span class="btn btn--bright  centered trans"><b><?=$item->title?></b></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php } ?>
	</div>