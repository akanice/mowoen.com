	<div class="main product_detail">	
		<section id="sub-home-page-stage" class="yCmsContentSlot">
			<div class="stage stage--reduced">
				<!-- <div class="bg-top-page"></div> -->
			</div>
		</section>
		
		<section class="row-wrapper d-none d-sm-block">
	        <div class="container">
				<h1 class="h2 page-title"><?=@$product_data->type?> <span class="font-weight-normal"><?=@$product_data->title?></span></h1>
			</div>
		</section>
		
		<script src="<?=base_url('assets/js/slick.js')?>" type="text/javascript"></script>
		<script src="<?=base_url('assets/plugins/lightbox/js/lightbox.min.js')?>" type="text/javascript"></script>
		<link href="<?=base_url('assets/plugins/lightbox/css/lightbox.min.css')?>" rel="stylesheet" />

		<section class="product-info mt-3">
			<div class="container">
				<div class="row align-items-start">
					<div class="col-12 col-md-5">
						<?php if ((@$product_data->gallery) && @count(json_decode($product_data->gallery)) == 0) {?>
							<div class="product-slick">
								<div>
									<a href="<?=@base_url($product_data->image)?>" data-lightbox="roadtrip"><img src="<?=@base_url($product_data->image)?>" alt="" class="img-fluid"></a>
								</div>
								<?php if (@$video_attach && @$video_attach!='') {?>
								<div class="d-flex justify-content-center align-items-center">
									<div class="embed-responsive embed-responsive-1by1">
										<video width="640" height="480" controls preload="metadata">
											<source src="<?=@base_url('assets/uploads/'.$video_attach)?>#t=0.5" />
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-12 col-12 col-slick"><!-- Slider Thumb -->
									<div class="slider-nav ratio_square">
										<div>
											<div class="nav-item thumb bg-size" style="background-image:url('<?=@base_url($product_data->thumb)?>')"></div>
										</div>
										<?php if (@$video_attach && @$video_attach!='') {?>
											<div>
												<div class="nav-item thumb bg-size position-relative video_play" data-toggle="modal" data-target="#modalVideo" style="background-image:url('<?=@base_url($video_attach_thumb)?>')"><span class="btn-play-video"><i class="fa fa-youtube"></i></span></div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php if ((@$circleview) && @count($circleview) != 0) { ?>
								<div class="circleview"><a class="btncircle" data-toggle="modal" data-target="#featureModal2"><img src="<?=base_url('assets/img/360-degrees.png')?>"></a></div>
							<?php } ?>
						<?php } else { ?>
							<div class="product-slick"><!-- Slider Main -->
								<div>
									<a href="<?=@base_url($product_data->image)?>" data-lightbox="roadtrip"><img src="<?=@base_url($product_data->image)?>" alt="" class="img-fluid"></a>
								</div>
								<?php foreach (json_decode($product_data->gallery) as $item) {?>
								<div>
									<a href="<?=@($item)?>" data-lightbox="roadtrip"><img src="<?=@($item)?>" alt="" class="img-fluid"></a>
								</div>
								<?php } ?>
								<?php if (@$video_attach && @$video_attach!='') {?>
								<div class="d-flex justify-content-center align-items-center">
									<div class="embed-responsive embed-responsive-1by1">
										<video width="640" height="480" controls>
											<source src="<?=@base_url('assets/uploads/'.$video_attach)?>" />
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-12 col-12 col-slick"><!-- Slider Thumb -->
									<div class="slider-nav ratio_square">
										<div>
											<div class="nav-item thumb bg-size" style="background-image:url('<?=@base_url($product_data->thumb)?>')"></div>
										</div>
										<?php foreach (json_decode($product_data->gallery) as $item) {?>
										<div>
											<div class="nav-item thumb bg-size" style="background-image:url('<?=@$item?>')"></div>
										</div>
										<?php } ?>
										<?php if (@$video_attach && @$video_attach!='') {?>
										<div>
											<div class="nav-item thumb bg-size position-relative video_play" data-toggle="modal" data-target="#modalVideo" style="background-image:url('<?=@base_url($video_attach_thumb)?>')"><span class="btn-play-video"><i class="fab fa-youtube"></i></span></div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							
							<?php if ((@$circleview) && @count($circleview) != 0) { ?>
								<div class="circleview"><div class="btncircle" data-toggle="modal" data-target="#featureModal2"><img src="<?=base_url('assets/img/360-degrees.png')?>"></div></div>
							<?php } ?>
						<?php } ?>
						<div class="modal fade" id="featureModal2" tabindex="-1" aria-labelledby="featureLabel2" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-centered">
								<div class="modal-content box-shadow ft-2">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
									<div class="pure_circle">
										<div id="circlr">
											<?php foreach (@$circleview as $item) {?>
											<img data-src="<?=@($item)?>" class="img-circle">
											<?php } ?>
											<div id="loader"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="col-12 col-md-7">
						<h1 class="h2 page-title"><span class="font-weight-bold"><?=@$product_data->title?></span></h1>
						<div class="product-data">
							<p class="product-articlenumbers">
								<span><b>Mã sản phẩm:</b> <?=@$product_data->sku?></span><br>
								<span><b>Kích thước:</b> <?=@$product_data->dimension?></span><br>
								<!-- <span><span class="text-danger"><b><?=@number_format($product_data->price,0,',','.')?> đ</b></span></span> -->
							</p>
							<!-- <div class="product-cta">
								<a href="tel:<?=@$home_hotline?>" class="btn btn--primary">Liên hệ</a>
								<a href="#productInfo" class="btn btn--tertiary js-scrollto scroll"><b>Chi tiết</b></a>
							</div> -->

							<div class="product-description">
								<?=@$product_data->short_description?>&nbsp;
							</div>

							<div class="">
								<?php if (@$file_attach) {foreach ($file_attach as $item) {	?>
									<a href="<?=base_url('assets/uploads/'.$item->prodpath)?>" class="d-flex align-self-center mb-2 wrap-item align-items-center" target="_blank">
										<span class="mr-1 file-icon">
											<?php $path_info = pathinfo($item->prodpath);$ext=$path_info['extension']; 
											if ($ext=='pdf') {?>
												<img src="<?=base_url('assets/img/icon-pdf.png')?>" width="24">
											<?php } else if ($ext=='dwg'){?>
												<img src="<?=base_url('assets/img/icon-dwg.png')?>" width="24">
											<?php } else {?>
												<img src="<?=base_url('assets/img/icon-pdf.png')?>" width="24">
											<?php } ?>
										</span>
										<span class="file-name"><?=@$item->prodname?></span>
									</a>	
								<?php }} ?>
							</div>
						</div>
					</div>

					<div class="col-12 mb-3 mt-3">
						
						<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="featureLabel3" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-centered">
								<div class="modal-content box-shadow ft-2">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
									<div class="inner block p-3">
										<h3 class="text-center mb-3">Thông tin khách hàng</h3>
										<form method="post" action="" id="form_register">
											<div class="form-group">
												<label for="fname">Họ và tên*</label>
												<input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp" required>
											</div>
											<div class="form-group">
												<label for="fphone">Số điện thoại*</label>
												<input type="text" class="form-control" id="fphone" name="fphone" required>
											</div>
											<div class="form-group">
												<label for="fphone">Địa chỉ</label>
												<input type="text" class="form-control" id="faddress" name="faddress">
											</div>
											<div class="form-group">
												<label for="fdate">Ngày mua hàng*</label>
												<input type="date" class="form-control" id="fdate" name="fdate" min="2022-01-01" max="" required>
											</div>
											<div class="form-group">
												<label for="fbranch">Mua hàng tại đại lý</label>
												<input type="text" class="form-control" id="fbranch" name="fbranch">
											</div>
											<div class="form-group">
												<label for="faddr">Địa chỉ đại lý</label>
												<input type="text" class="form-control" id="faddr" name="faddr">
											</div>
											<input type="hidden" class="form-control" id="fuid" name="fuid" value="<?=@$this->input->get('uid')?>">
											<input type="hidden" class="form-control" id="fpid" name="fpid" value="<?=@$product_data->id?>">
											<div class="form-group form-check mb-5"> 
												<input type="checkbox" class="form-check-input" id="fcheck" required>
												<label class="form-check-label" for="fcheck">Tôi đồng ý chia sẻ thông tin cá nhân với Mowoen</label>
											</div>
											<button type="submit" name="submit" class="btn btn--primary btn-block btn-round btn-darker">Kích hoạt</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</div>
	
	<div style="height: 45px"></div>											

	<div class="position-fixed hotline_fixed">
		<a href="tel:<?=@$home_hotline?>" class="btn btn--primary btn-block btn-round" data-toggle="modal" data-target="#modal3">Kích hoạt bảo hành</a>
	</div>

	<script>
	$(document).ready(function () {	
		var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0');
		var yyyy = today.getFullYear();

		today = yyyy + '-' + mm + '-' + dd;
		document.getElementById("fdate").value = today;
		document.getElementById("fdate").max = today;
		$("#form_register").submit(function(e) {
			$('.loading_spinner').show();
			e.preventDefault();
			var form = $(this);
			
			$.ajax({
				url : "/ajax/createRow",
				type: "POST",
				data : form.serialize(),
				success: function(response){
					$('.loading_spinner').hide();
					var result = $.parseJSON(response);
					console.log(result.status);
					console.log(result.message);
					window.location.href = "/dang-ky-thanh-cong";
				},
				
			});
		});
	});
	</script>

	<style>
	.page-wrapper {
		position: relative;
	}
	.hotline_fixed {
		bottom: 0;
		right: 0;
		left: 0;
	}
	.hotline_fixed .btn-round {
		border-radius: 0;
	}
	</style>