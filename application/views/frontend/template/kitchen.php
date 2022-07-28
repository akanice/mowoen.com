	<div class="main product_detail">	
		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<figure>
					<img sizes="(min-width: 1px) 100vw" src="/assets/img/page_cover3.jpg" title="Mowoen" class="lazyload img-holder stage__image stage__image--reduced">
				</figure>
			</div>
		</section>
		
		<div class="row-wrapper row-page-title">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Display of the ContentSlot component starts here -->
						<div class="headline-group ">
							<div class="headline-lead">Khu bếp với Mowoen</div>
							<h1>Vòi, bồn rửa và phụ kiện bếp đẹp vượt thời gian từ Mowoen</h1>
							<p class="intro-text">Nhà bếp là nơi sum họp của gia đình và bạn bè, để nấu nướng, ăn uống, thư giãn và tổ chức party với đồng nghiệp... Vòi, bồn rửa và bộ phụ kiện từ Mowoen là những thành phần hoàn hảo để tạo ra vẻ đẹp vượt thời gian, đầy phong cách và tiện ích cho khu bếp của bạn. Những vật dụng này sẽ biến nhà bếp thành căn phòng yêu thích trong nhà của bạn. Và công việc bếp núc của bạn? Chúng sẽ trở nên thật hoàn hảo.</p>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<section class="home_feature_products" id="home_feature_products">
			<div class="container">
				<div class="content-margin-large">
					<div class="headline-group ">
						<h2>Sản phẩm mới của chúng tôi với thiết kế nhà bếp chất lượng cao</h2></div>
				</div>
				<div class="teasergallery" data-t-name="Teasergallery" data-t-id="6">
					<?php if ($newest_products & count($newest_products) >=3) { $i=1;
						foreach ($newest_products as $item) {
							if ($i==1) {?>
							<div class="teasergallery__item-wrapper js-equalize-items">
							<?php }?>
							<!-- Item 1 -->
							<a class="teasergallery__item no-link js-teaser-gallery-item" href="<?=@base_url('bathroom/products/'.$item->alias)?>" target="_self">
								<figure class="teasergallery__image <?php if ($i==3) {echo 'item-3';}?>">
									<img src="<?=@base_url($item->thumb)?>" alt="<?=@$item->title?>"  title="<?=@$item->title?>" class="lazyload">
								</figure>
								<div class="teasergallery__body">
									<h3 class="teasergallery__headline"><?=@$item->title?></h3>
									<?php 
									$string = strip_tags($item->short_description);
									$string = (strlen($string) > 201) ? substr($string,0,200).'...' : $string;
									echo $string;
									?>
								</div>
							</a>
							<?php if ($i==2) {?>
							</div>
							<?php } ?>
					<?php $i++;} } ?>	
				</div>
			</div>
		</section>
		
		<?php if($list_cat) {$i=1;?>
		<section id="list_category" class="home_feature_cat style2">
			<div class="container">
				<div class="row">
					<?php foreach ($list_cat as $item) { ?>
						<div class="col-6 <?php if ($i==1 or $i==2) {echo 'col-md-6';} else {echo 'col-md-3';} ?>"><!-- Col 1 -->
							<div class="item <?php if ($i==1 or $i==2) {echo 'first';}?>">
								<a href="<?=base_url('kitchen/products?cat_id='.$item->id)?>" target="_self">
									<div class="inner has-image" style="background-image:url('<?php if ($i==1 or $i==2) {echo base_url($item->image);} else {echo base_url($item->thumb);}?>')"></div>
									<div class="info">
										<?=@$item->title?>
									</div>
								</a>
							</div>
						</div>
					<?php $i++;} ?>
				</div>
			</div>
		</section>
		<?php } ?>
		
	</div>