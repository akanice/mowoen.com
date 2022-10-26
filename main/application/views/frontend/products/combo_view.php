		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Combo</li>
								<li class="breadcrumb-item active" aria-current="page"><?=$combo->title?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>	
			
		<link href="<?=base_url('assets/css/front/product.css')?>" rel="stylesheet">
		
		<section id="combo_display" class="section-b-space ratio_square combo_page">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-sm-8">
						<div class="product-right product-description-box">
							<h1 class="heading"><?=$combo->title?></h1>
							<div class="rating rate-star star-4 mb-3"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
							<div class="border-product">
								<div class="row">
									<div class="col-md-5">
										<span itemprop="price" class="price hl">
											<?php if ($combo->sale_price && (($combo->sale_price != null) or ($combo->sale_price != 0))) {
											echo '<h4><del>'.number_format($combo->total_price,0,',','.').' đ</del><span>'.round(($combo->total_price-$combo->sale_price)*100/$combo->total_price,0).' %off</span></h4>';
												} else {
													if ($combo->total_price != 0) {
														echo '<h3>'.number_format($combo->total_price,0,',','.').' Đ</h3>';
													} else {
														echo 'Liên hệ';
													}
											} ?>
										</span>
										<?php if ($combo->sale_price && (($combo->sale_price != null) or ($combo->sale_price != 0))) {?><h3><?=@number_format($combo->sale_price,0,',','.')?> Đ</h3><?php } ?>
										
										<h6 class="product-title">Ưu điểm bộ sản phẩm:</h6>
										<?=@$combo->description?>
									</div>
									<div class="col-md-7">
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-custom">
												<thead class="thead-dark">
													<tr>
														<th></th>
														<th>Sản phẩm - Mã SP</th>
														<th>Giá gốc (VND)</th>
														<th>Giá KM (VND)</th>
														<th>Tiết kiệm (%)</th>
													</tr>
												</thead>
												<tbody>
													<?php $i=1;$total_s_price=0; $total_o_price=0;
														if($combo->product_data) foreach ($combo->product_data as $item) {
														$total_s_price = $total_s_price + $item->sale_price;
														$total_o_price = $total_o_price + $item->price;
													?>
													<tr>
														<td><?=$i?></td>
														<td><?=$item->title?></td>
														<td><del><?=number_format($total_o_price,0,',','.')?> đ</del></td>
														<td class="text-info"><?=number_format($total_s_price,0,',','.')?> đ</td>
														<td class="text-primary font-weight-bold">-20%</td>
													</tr>
													<?php $i++;} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="border-product">
									<h6 class="product-title">Danh sách bộ sản phẩm:</h6>
									<div class="product-wrapper-grid combo-list-product">
										<div class="row">
											<?php $i=1;$total_s_price=0; $total_o_price=0;
												if($combo->product_data) foreach ($combo->product_data as $item) {
												$total_s_price = $total_s_price + $item->sale_price;
												$total_o_price = $total_o_price + $item->price;
												$brandname = $this->brandsmodel->read(array('id'=>$item->brand),array(),true)->name;
											?>
											<div class="col-xl-6 col-md-6 col-12 col-grid-box">
												<div class="product-box">
													<div class="row">
														<div class="col-sm-5">
															<div class="img-block">
																<a href="#" class="bg-size" style="background-image: url('<?=@base_url($item->thumb)?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="product-info text-left">
																<h4><b><?=$item->title?></b></h4>
																<h5><?=number_format($item->sale_price,0,',','.')?></h5>
																<p><i class="fa fa-caret-right"></i><span class="text-info">Nhãn hiệu:</span> <?=$brandname?></p>
																<p><i class="fa fa-caret-right"></i><span class="text-info">Xuất xứ:</span> <?=$item->made_in?></p>
																<p><i class="fa fa-caret-right"></i><span class="text-info">Bảo hành:</span> <?=$item->guarantee?> năm</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php } ?>
											
										</div>
									</div>
								</div>
								
								<div class="border-product center">
									<h4 class="heading"><u>Bạn muốn tạo combo riêng?</u></h4>
									<a href="#" class="btn btn-solid"><i class="fa fa-plus-circle"></i> Thay đổi sản phẩm từ combo hiện tại</a>
									<a href="<?=base_url('combo/tao-combo')?>" class="btn btn-solid hotline"><i class="fa fa-plus-circle"></i> Tạo combo mới</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4">
							<div class="product-right product-form-box">
								<h4 class="heading">Khuyến mãi khi mua hàng online</h4>
								<div class="product-description border-product extra">
									<p><i class="fa fa-check"></i> Tặng ngay phiếu mua hàng 10 triệu</p>
									<p><i class="fa fa-check"></i> Gói bảo hành vàng chỉ (+100.000 đ)</p>
								</div>
								<div class="product-description border-product extra">
									<h4 class="heading text-info">Chế độ bảo hành mặc định</h4>
									<p><i class="fa fa-check"></i> Bảo hành 12 tháng 1 đổi 1</p>
									<p><i class="fa fa-check"></i> Gói bảo hành vàng chỉ (+100.000 đ)</p>
								</div>
								<div class="product-description border-product extra split">
									<h4 class="heading text-info">Chăm sóc tận răng</h4>
									<p><i class="fa fa-pencil-ruler"></i> Miễn phí lắp đặt</p>
									<p><i class="fa fa-recycle"></i> Lỗi 1 đổi 1 trong 1 tháng tận nhà</p>
									<p><i class="fa fa-crown"></i> Bảo hành hãng</p>
									<p><i class="fa fa-shipping-fast"></i> Giao hàng cực nhanh</p>
								</div>
								<div class="product-description border-product pb-0">
									<a href="tel:0123456789" class="hotline center"><i class="fa fa-phone"></i> Tư vấn mua hàng: <?=@$home_hotline?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
									
			<section class="section-b-space ratio_square product-related">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2 class="title pt-0">Bạn chưa hài lòng? Hãy tham khảo các combo khác của chúng tôi</h2>
						</div>
					</div>
					<div class="slide-4">
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 1</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 2</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 3</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 4</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 5</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
						<div class="">
							<div class="product-box">
								<div class="img-block">
									<a href="product_detail.html" class="bg-size" style="background-image: url('/assets/img/combo_sample_1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									<div class="add-btn">
										<a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">Đặt hàng</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#"><h6>Combo phòng tắm 6</h6></a>
									<h5>2.450.000 đ</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>						