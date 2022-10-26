
	<link href="https://fonts.googleapis.com/css2?family=Saira:wght@400;700&display=swap" rel="stylesheet">
	
	<div class="main page-success page-warranty">	
		<section class="">
			<div class="h-100 w-100 d-flex justify-content-center align-items-center">
				<div class="px-3">
					<h1 class="page-heading text-center">Thông tin bảo hành</h1>
					<div class="text-center"><img src="/assets/img/warranty2.jpg" alt="Bảo hành" /></div>
					<p class="text-center mb-3 <?php if ($this->session->flashdata('status')!=='ok') {echo 'text-danger mt-3 mb-3';} else {echo 'text-success mt-3 mb-3';}?>">
						<?php echo $this->session->flashdata('message')?>
					</p>
					
					<?php if (@$product_data) {?>
					<h3 class="text-center mb-2">THÔNG TIN SẢN PHẨM</h3>
					<div class="product-data mb-3">
						<span><b>Tên sản phẩm:</b> <?=@$product_data->title?></span><br>
						<span><b>Mã sản phẩm:</b> <?=@$product_data->sku?></span><br>
						<span><b>Kích thước:</b> <?=@$product_data->dimension?></span><br>
						<span><b>Hotline:</b> <a href="tel:1800 8163"><b>1800 8163</b></a></span>
					</div>
					<?php } ?>

					<?php if (@$warranty_data) {?>
					<h3 class="text-center mb-2">THÔNG TIN BẢO HÀNH</h3>
					<span><b>Mã bảo hành:</b> <span class="text-danger"><b><?=@$warranty_data->unique_id?></b></span></span><br>
					<span><b>Trạng thái bảo hành:</b> <span class="text-success"><b>Đã kích hoạt</b></span></span><br>
					<span><b>Ngày kích hoạt:</b> <?php echo date_format(date_create($warranty_data->purchase_date),"d/m/Y"); ?></span><br>
					<span><b>Ngày hết hạn:</b> <?php echo date_format(date_create($warranty_data->expired_date),"d/m/Y"); ?></span><br>
					<span><b>Họ và tên:</b> <?=@$warranty_data->name?></span><br>
					<span><b>Số điện thoại:</b> <?=@$warranty_data->phone?></span><br>
					<span><b>Địa chỉ:</b> <?=@$warranty_data->address?></span><br>
					<?php } ?>
				</div>
			</div>
		</section>

	</div>

<link href="/assets/css/page-agent.css" rel="stylesheet">
<script>
	$(document).ready(function () {
		
	});
</script>