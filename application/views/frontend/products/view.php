		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									<?php if (isset($category)) {$space='';?>
										<span>
											<?php foreach ($category as $n) {?>
												<?=$space;?><a class="crumb" href="<?=base_url('danh-muc/'.$n->alias)?>"><?=@$n->title?></a>
											<?php $space=', ';} ?>
											<?php } ?>
										</span>
								</li>
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
			
		<link href="<?=base_url('assets/css/front/product.css')?>" rel="stylesheet">
		<link href="<?=base_url('assets/plugins/lightbox/css/lightbox.min.css');?>" rel="stylesheet" />
		<script src="<?=base_url('assets/plugins/lightbox/js/lightbox.min.js');?>"></script>
		
		<section class="section-b-space section-t-space ratio_square product_detail_page">
			<div class="collection-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-sm-4 col-12">
						<?php if ((@$product_data->gallery) && @count(json_decode($product_data->gallery)) == 0) {?>
							<img src="<?=@base_url($product_data->image)?>" class="img-holder p_detail_img">
						<?php } else { ?>
							<div class="product-slick">
								<div><img src="<?=@base_url($product_data->image)?>" alt="" class="img-fluid  image_zoom_cls-0"></div>
								<?php foreach (json_decode($product_data->gallery) as $item) {?>
								<div>
									<img src="<?=@($item)?>" alt="" class="img-fluid">
								</div>
								<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-10 offset-md-1 col-12 col-slick">
									<div class="slider-nav">
										<div>
											<img src="<?=@base_url($product_data->image)?>" alt="" class="img-fluid">
										</div>
										<?php foreach (json_decode($product_data->gallery) as $item) {?>
										<div>
											<img src="<?=@($item)?>" alt="" class="img-fluid ">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
						
							<?php if (isset($actual_image) && ($actual_image != 'null')) { ?><div class="viewmore text-center"><a href="#product_reality_image" class="scroll">Xem thêm ảnh thực tế</a></div><?php } ?>
							<div class="text-center"><p>
								<a href="<?=@base_url($file_attach)?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-file-pdf"></i> Tải hướng dẫn sử dụng</a>
								<a href="" class="btn btn-warning btn-sm" target="_blank" data-toggle="modal" data-target="#videoModal"><i class="fab fa-youtube"></i> Video hướng dẫn</a>
								<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
									<div class="modal-dialog modal-lg modal-dialog-centered">
										<div class="modal-content">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="embed-responsive-item" src="<?='https://www.youtube.com/embed/'.($video_attach->id_youtube)?>" width="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>
									</div>
								</div>
							</p></div>
						</div>
						
						<div class="col-lg-5 col-sm-4"><!-- Product info text -->
							<div class="product-right product-description-box">
								<h1><?=@$product_data->title?></h1>
								<div class="rating rate-star star-5 mb-3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
								<span itemprop="price" class="price hl">
									<?php if ($product_data->sale_price && (($product_data->sale_price != null) or ($product_data->sale_price != 0))) {
									echo '<h4><del>'.number_format($product_data->price,0,',','.').' &#8363;</del><span>'.round(($product_data->price-$product_data->sale_price)*100/$product_data->price,0).' % Giảm</span></h4>';
										} else {
											if ($product_data->price != 0) {
												echo '<h3>'.number_format($product_data->price,0,',','.').' &#8363;</h3>';
											} else {
												echo 'Liên hệ';
											}
									} ?>
								</span>
								<?php if ($product_data->sale_price && (($product_data->sale_price != null) or ($product_data->sale_price != 0))) {?><h3><?=@number_format($product_data->sale_price,0,',','.')?> &#8363;</h3><?php } ?>
								
								<div class="border-product">
									<div><h6 class="product-title d-inline">Danh mục: </h6>
									<?php if (isset($category)) {$space='';?>
										<span>
											<?php foreach ($category as $n) {?>
												<?=$space;?><a class="crumb text-info" href="<?=base_url('danh-muc/'.$n->alias)?>"><b><?=@$n->title?></b></a>
											<?php $space='/ ';} ?>
											<?php } ?>
									</div>
									<div><h6 class="product-title d-inline">Nhãn hiệu: </h6>
									<span class="hl"><a class="crumb text-danger" href="<?=@base_url('brands/'.$brand->alias)?>"><b><?=@$brand->name?></b></a></span>
									</div>
									<div><a class="crumb text-dark text-underline" href="<?=@base_url('brands/'.$brand->alias)?>"><b>Xem thêm sản phẩm nhãn hiệu <?=@$brand->name?></b></a></div>
								</div>
								
								<div class="border-product">
									<h6 class="product-title">Đặc điểm nổi bật</h6>
									<?=@$product_data->short_description?>
								</div>
								<div class="product-buy mb-3">
									<div class="first">
										<button type="button" class="btn btn-solid btn-fill" id="btn_complete_order"
												data-product_id="<?=@$product_data->id?>"
												data-product_name="<?=@$product_data->title?>"
												data-product_quantity="1"
												data-product_extra_des="<?=@$product_data->extra_des?>"
												data-product_thumb="<?=@$product_data->thumb?>"
												data-product_price="<?php if ($product_data->sale_price && (($product_data->sale_price != null) or ($product_data->sale_price != 0))) { echo $product_data->sale_price;} else {echo $product_data->price;}?>">
											<small><i class="far fa-smile-beam"></i></small> Đặt hàng ngay
										<p><small>Giao hàng tận nơi bất kể ngày đêm</small></p></button>
									
									</div>
								</div>
								<div class="border-product">
									<h6 class="product-title">Chia sẻ</h6>
									<div class="product-icon">
										<ul class="product-social">
											<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="http://twitter.com/share?text=<?=@$product_data->title?>url=<?=current_url()?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#"><i class="fab fa-instagram"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-sm-4">
							<div class="product-right product-form-box">
								<h4 class="heading">Khuyến mãi khi đặt hàng online</h4>
								<div class="product-description border-product extra">
									<p><i class="fa fa-check"></i> Tặng ngay chân hãm cửa thông minh</p>
									<p><i class="fa fa-check"></i> Gói bảo hành vàng 36 tháng chỉ + 10% giá bán</p>
								</div>
								<div class="product-description border-product extra">
									<h4 class="heading text-info">Chế độ bảo hành mặc định</h4>
									<p><i class="fa fa-check"></i> Bảo hành 24 tháng với khóa căn hộ</p>
									<p><i class="fa fa-check"></i> Bảo hành 12 tháng với khóa khách sạn</p>
									<p><i class="fa fa-check"></i> Bảo hành tại nhà</p>
								</div>
								<div class="product-description border-product extra split">
									<h4 class="heading text-info">Dịch vụ tốt nhất</h4>
									<p><i class="fa fa-pencil-ruler"></i> Miễn phí lắp đặt</p>
									<p><i class="fa fa-recycle"></i> Lỗi 1 đổi 1 trong 30 ngày</p>
									<p><i class="fa fa-crown"></i> Bảo hành chính hãng</p>
									<p><i class="fa fa-shipping-fast"></i> Lắp đặt ngay trong ngày</p>
								</div>
								<div class="product-description border-product pb-0">
									<a href="tel:<?=@$home_hotline?>" class="hotline center"><i class="fa fa-phone"></i> Tư vấn mua hàng: <?=@$home_hotline?></a>
								</div>
							</div>
						</div>

					</div>										
				</div>
			</div>
		</section>
		
		<section class="tab-product m-0 pb-5">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-lg-8">
						<ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true">Thông tin sản phẩm</a>
								<div class="material-border"></div>
							</li>
						</ul>
						<div class="tab-content nav-material" id="top-tabContent">
							<div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab"><!-- tab pane 1 -->
								<?=@$product_data->description?>
							</div>
						</div>
						<hr>
						<div class="product-related ratio_square">
							<h4 class="title pt-1">Sản phẩm tương tự</h4>
							<div class="slide-6">
							<?php if($related_products) {foreach ($related_products as $item) {?>
								<div class="">
									<div class="product-box">
										<div class="img-block">
											<a href="<?=base_url('san-pham/'.$item->alias)?>" class="bg-size" style="background-image: url('<?=base_url($item->thumb)?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
											<div class="add-btn">
												<a href="<?=base_url('san-pham/'.$item->alias)?>" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
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
											<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="old-price regular-price"><?=@number_format($item->price,0,',','.')?> đ</span><?php } ?>
											</div>
										</div>
									</div>
								</div>
								<?php }} else {echo 'Chưa có sản phẩm nào trong mục này';}?>		

							</div>
						</div>
					</div>
					<div class="col-sm-4 col-lg-4">
						<div class="product-right product-spec">
							<h4 class="heading">Thông số kỹ thuật</h4>
							<?=@$product_data->specifications?>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<?php if (isset($actual_image) && ($actual_image != 'null')) { ?>
		<section class="section-b-space ratio_square product-related">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3 class="title pt-3">Ảnh thực tế lắp đặt</h3>
						<div class="actual_image" id="product_reality_image">
							<?php $i=0; foreach (json_decode($actual_image) as $item) {
							?>
							<div class="item">
								<a href="<?=@$item?>" data-lightbox="actual_image" class="wrap_lightbox"> <div class="inner" style="background-image:url('<?=@$item?>')"></div></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				
			</div>
		</section>
		<?php } ?>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#btn_complete_order').click(function(e){
				e.preventDefault();
				$(this).attr("disabled", true);
				var product_id = $(this).data("product_id");
				var product_name = $(this).data("product_name");
				var product_extra_des = $(this).data("product_extra_des");
				var product_price = $(this).data("product_price");
				var product_thumb = $(this).data("product_thumb");
				var quantity = $(this).data("product_quantity");
				//$('#product_quantity').val();
				$.ajax({
					url : "<?php echo site_url('ajax/add_to_cart');?>",
					method : "POST",
					data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity, product_thumb:product_thumb,product_extra_des:product_extra_des},
					success: function(data){
						$('.detail_cart').html(data);
						$('#notice_add_to_cart').show();
						$('#add_to_cart').removeAttr("disabled");
					}
				});
				
				setTimeout(function(){location.href="<?=base_url('dat-hang');?>"} , 300);
			});
			
			$('#btn_add_cart').click(function(e){
				e.preventDefault();
				$(this).attr("disabled", true);
				var product_id = $(this).data("product_id");
				var product_name = $(this).data("product_name");
				var product_extra_des = $(this).data("product_extra_des");
				var product_price = $(this).data("product_price");
				var product_thumb = $(this).data("product_thumb");
				var quantity = $(this).data("product_quantity");
				//$('#product_quantity').val();
				$.ajax({
					url : "<?php echo site_url('ajax/add_to_cart');?>",
					method : "POST",
					data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity, product_thumb:product_thumb,product_extra_des:product_extra_des},
					success: function(data){
						$('.detail_cart').html(data);
						$('.alert').addClass('show');
					}
				});
				
			});
			
			$("#related_products").owlCarousel({
				loop:true,
					margin:10,
					nav:false,
					autoplay: false,
					responsiveClass:true,
					responsive:{
						0:{
							items:2,
							nav:false,
							dots:false,
							stagePadding: 30,
						},
						600:{
							items:3,
							nav:false
						},
						1000:{
							items:5,
							nav:false,
							loop: true
						}
					}
			});
			

		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>