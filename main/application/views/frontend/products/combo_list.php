		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Combo</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>	
			
		<link href="<?=base_url('assets/css/front/product.css')?>" rel="stylesheet">
		
		<section id="combo_list" class="section-b-space ratio_square combo_page">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1>Combo</h1>
						<div class="product-filter-content">
							<form class="form-inline" method="GET" action="">
								<div class="col-filter">Sắp xếp theo: </div>
								<div class="col-filter">
									<select class="form-control filter" name="f_brand" id="f_brand">
										<option value="1">Giá thấp đến cao</option>
										<option value="2">Giá cao đến thấp</option>
									</select>
								</div>
								<div class="col-filter">
									<select class="form-control filter" name="f_brand" id="f_brand">
										<option value="1">Mới nhất</option>
										<option value="2">Cũ nhất</option>
									</select>
								</div>
								<div class="col-filter last pull-right">
									<a href="" type="submit" class="btn btn-solid btn-solid-sm mr-1"><i class="fa fa-search"></i> Tìm kiếm</a>
								</div>
							</form>
						</div>
					</div>
					<?php if ($combo_list) {//print_r($combo_list);
						foreach ($combo_list as $item) {?>
					<div class="col-xl-4 col-md-4 col-12 col-grid-box">
						<div class="product-box">
							<div class="row">
								<div class="col-sm-5">
									<div class="img-block">
										<a href="<?=@base_url('combo/'.$item->alias)?>" class="bg-size" style="background-image: url('<?=@base_url($item->thumb)?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="product-info text-left"><a href="<?=@base_url('combo/'.$item->alias)?>">
										<h4><b><?=$item->title?></b></h4>
										<p><?php $x=1;if ($item->product_data) {foreach ($item->product_data as $i) {?>
										<span class=""><small>-</small> <?=$i->title?></span><br>
										<?php $x++;} } else {echo 'Chưa có sản phẩm trong combo này';} ?></p></a>
									</div>
								</div>
							</div>
							<span itemprop="price" class="price hl">
								<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
								echo '<div class="total-price"><span class="text-warning">Tổng cộng: </span><del>'.number_format($item->total_price,0,',','.').' đ</del></div>';
									} else {
										if ($item->total_price != 0) {
											echo '<div class="total-price"><span class="text-warning">Tổng cộng: </span>'.number_format($item->total_price,0,',','.').' Đ</div>';
										} else {
											echo 'Liên hệ';
										}
								} ?>
							<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><div class="sale-price"><span class="">Giá KM: </span><?=@number_format($item->sale_price,0,',','.')?> đ</div><?php } ?>
							<div class="percent-price"><span class="">Bạn tiết kiệm: </span><?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><?=@round(($item->total_price-$item->sale_price)*100/$item->total_price,0)?> %off<?php } ?></div>
							</span>
						</div>
					</div>	
					<?php } } else {echo 'Chưa có sản phẩm trong mục này';} ?>
					
					<div class="col-sm-12">
						<div class="border-product center">
							<h4 class="heading"><u>Bạn muốn tạo combo riêng?</u></h4>
							<a href="#" class="btn btn-solid"><i class="fa fa-plus-circle"></i> Thay đổi sản phẩm từ combo hiện tại</a>
							<a href="https://tbvsthanhvinh.vn/combo/tao-combo" class="btn btn-solid hotline"><i class="fa fa-plus-circle"></i> Tạo combo mới</a>
						</div>
					</div>
				</div>
			</section>				