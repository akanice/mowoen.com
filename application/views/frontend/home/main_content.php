		<section id="home_feature_cat" class="home_feature_cat">
			<div class="container">
				<div class="headline-group ">
					<div class="headline-lead">Thương hiệu sản phẩm cao cấp dành cho Nhà Tắm & Nhà Bếp</div>
					<h1>Không chỉ là sản phẩm nhà tắm, hãy tận hưởng cuộc sống mà Mowoen mang lại</h1>
				</div>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
					<div class="col">
						<div class="item">
							<a href="<?=base_url('/bathroom/products')?>" target="_self">
								<div class="inner has-image">
									<figure>
										<img src="/assets/img/home_bathroom_cat.jpg" class="lazyload teaser_img img-holder" >
									</figure>
									<div class="teaser_body">
										<h2 class="font-weight-normal">Sản phẩm Mowoen cho nhà tắm</h2><span class="btn btn--bright ">
											<b>Xem thêm</b></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col">
						<div class="item">
							<a href="<?=base_url('/kitchen/products')?>" target="_self">
								<div class="inner has-image">
									<figure>
										<img src="/assets/img/home_kitchen_cat2.jpg" class="lazyload teaser_img img-holder" >
									</figure>
									<div class="teaser_body">
										<h2 class="font-weight-normal">Sản phẩm Mowoen cho nhà bếp</h2><span class="btn btn--bright ">
											<b>Xem thêm</b></span>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="home_short_intro" id="home_short_intro">
			<div class="container">
				<div class="decoration-text">
					<div class="decoration-text__inner">
						<div class="headline-group ">
							<div class="headline-lead">Nâng cao chất lượng cuộc sống của bạn</div>
							<h2>Thiết kế hiện đại và tươi mới</h2></div>
					<div class="decoration-text__content">
							<p>Nếu bạn yêu thích <b>thiết kế</b> trong phòng tắm cũng như nhà bếp và nhận ra tầm quan trọng của chất lượng sản phẩm, thì đây là nơi phù hợp nhất cho bạn. Bạn sẽ tìm thấy vô số <b>sản phẩm cao cấp</b> cho vòi hoa sen, phòng tắm và nhà bếp với <b>Mowoen</b>. Hãy tham khảo các dòng sản phẩm của chúng tôi: Vòi dùng cho bồn rửa mặt, vòi hoa sen và bồn tắm. Tất cả các loại vòi hoa sen: vòi hoa sen cầm tay, vòi hoa sen trên cao, vòi sen và hệ thống vòi hoa sen. Các sản phẩm nhà bếp, bao gồm vòi bếp, chậu rửa bát và các thiết bị combi chậu rửa và vòi.</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="home_feature_products" id="home_feature_products">
			<div class="container">
				<div class="content-margin-large">
					<div class="headline-group ">
						<div class="headline-lead">Làn gió mới từ căn nhà đầy sáng tạo</div>
						<h2>Công nghệ từ Mowoen</h2></div>
				</div>
				<div class="teasergallery" data-t-name="Teasergallery" data-t-id="8">
				<?php if ($list_tech_articles) { $i=1;
					foreach ($list_tech_articles as $item) {
						if ($i==1) {?>
						<div class="teasergallery__item-wrapper js-equalize-items">
						<?php }?>
						<!-- Item 1 -->
						<a class="teasergallery__item no-link js-teaser-gallery-item" href="<?=@base_url('post/'.$item->alias)?>" target="_self">
							<figure class="teasergallery__image <?php if ($i==3) {echo 'item-3';}?>">
								<img src="<?=@base_url($item->thumb)?>" alt="<?=@$item->title?>"  title="<?=@$item->title?>" class="lazyload">
							</figure>
							<div class="teasergallery__body">
								<h3 class="teasergallery__headline"><?=@$item->title?></h3><?=@$item->description?>
							</div>
						</a>
						<?php if ($i==2) {?>
						</div>
						<?php } ?>
				<?php $i++;} } ?>	
				</div>
			</div>
		</section>
