		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		<link href="/assets/css/front/product.css" rel="stylesheet">
		<div id="contents" class="main-page cart_info">
			<div class="container">
				<div class="row clearfix">
				<?php if($total_items > 0) { ?>
					<div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12 cart-form">
						<div class="cart-total">
						<div class="inner">
								<?php
									$total_amount = 0;
									foreach($carts as $row) {
									$total_amount = $total_amount + $row['subtotal'];
								?>
								<div class="row clearfix">
									<div class="col-sm-2 col-8 col-order1"><img src="<?=@base_url($row['thumb']); ?>" class="img-holder"></div>
									<div class="col-sm-8 col-12 col col-order2">
										<h5 class="name"><b><?=@$row['name'];?></b></h5>
										<div class="extra-des">
											<?=@$row['extra_des'];?>
										</div>
									</div>
									<div class="col-sm-2 col-4 pull-right col-order3"><span class="price"><?=number_format($row['price'], 0, '', '.');?> đ</span></div>
								</div>
								<?php } ?>
								<div class="row clearfix last-row">
									<div class="col-sm-10 col-6 col"><h5 class="name align-right">Thành tiền:</h5></div>
									<div class="col-sm-2 col-6 pull-right"><span class="total-price price"><?=number_format($total_amount, 0, '', '.');?> đ</span></div>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-md-12">
								<div class="content">
									<h3 class="page-title">Thông tin đặt hàng: </h3>
									<form class="form-order form-horizontal" method="POST" action="#">
										<div class="form-row">
											<div class="form-group col-sm-6">
												<input type="text" class="form-control" id="f_name" name="f_name" placeholder="Họ tên*">
											</div>
											<div class="form-group col-sm-6">
												<input type="text" class="form-control col" id="f_phone" name="f_phone" placeholder="Số điện thoại*">
											</div>
										</div>
										<div class="form-group">
											<textarea class="form-control" id="f_note" name="f_note" placeholder="Yêu cầu:" rows="5"></textarea>
										</div>
										<div class="form-group">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="f_payment" id="f_payment1" value="cash" checked>
												<label class="form-check-label" for="f_payment1">
													Thanh toán khi nhận hàng
												</label>
											</div>
										</div>
										<div class="form-group">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="f_payment" id="f_payment2" value="bank">
												<label class="form-check-label" for="f_payment2">
													Chuyển khoản ngân hàng
												</label>
											</div>
										</div>
										<button type="submit" name="submit" class="btn btn-buy_now btn-full">Hoàn tất đặt hàng</button>
										<small class="form-text text-muted text-center">Nhân viên của chúng tôi sẽ xác nhận lại với bạn qua điện thoại sau khi nhận được thông tin đơn hàng.</small>
									</form>
								</div>
							</div>
							<div class="col-md-6">
							</div>
						</div>
					</div>
					
					<?php } else { ?>
					<div class="col-sm-12">
						<h4 class = "text-success">Không có sản phẩm nào trong giỏ hàng</h4>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		