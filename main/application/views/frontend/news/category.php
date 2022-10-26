		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<figure>
					<img src="/assets/img/page_cover3.jpg" title="mowoen" class="lazyload img-holder stage__image stage__image--reduced">
				</figure>
			</div>
		</section>
		
		<section class="row-wrapper row-page-title">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="headline-group ">
							<div class="headline-lead"><?=$news_category->meta_description?></div>
							<h1><?=$news_category->title?></h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="main-page category_content blog_grid_list home_feature_cat">
			<div class="container">
				<div class="row row-cols-1 row-cols-sm-3 row-cols-md-3">
					<?php if($list_articles) {foreach ($list_articles as $item) {?>
					<div class="col"><!-- Col 1 -->
						<div class="item">
							<a href="<?=@base_url('post/'.$item->alias)?>" target="_self">
								<div class="inner has-image">
									<figure>
										<img src="<?=base_url($item->thumb)?>" alt="Large rain shower from hansgrohe." class="lazyload teaser_img img-holder" >
									</figure>
									<div class="teaser_body">
										<span class="btn btn--bright  centered trans"><b><?=$item->title?></b></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php }} ?>
				</div>
			</div>
		</section>