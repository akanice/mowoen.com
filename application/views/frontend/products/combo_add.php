		<section class="breadcrumb-section section-b-space section-t-space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav aria-label="breadcrumb" class="theme-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i> Trang chủ</a></li>
								<li class="breadcrumb-item active" aria-current="page">Tạo Combo</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>	
			
		<link href="<?=base_url('assets/css/front/product.css')?>" rel="stylesheet">
		
		<section id="create_combo" class="section-b-space ratio_square create_combo_page style2">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1>Combo</h1>
						<div class="product-filter-content">
							
						</div>
					</div>
					<?php if ($cat_data) {$x=0;
						foreach ($cat_data as $item) {?>
					<div class="col-12 col-grid-box">
						<div class="product-box ">
							<div class="row">
								<div class="col-sm-3">
									<h5><?=$item->title?></h5>
								</div>
								<div class="col-sm-9">
									<select name="<?=$item->alias?>" class="form-control">
										<?php $product_array = json_decode($cat_array[$x]->product_id);
										//print_r($cat_array);
											foreach ($product_array as $i) {
												$p_data = $this->productsmodel->read(array('id'=>$i),array(),true); ?>
											<option id="product-<?=@$p_data->id?>"  class="select_product" 
												data-product_id="<?=@$p_data->id?>"
												data-product_name="<?=@$p_data->title?>"
												data-product_quantity="1"
												data-product_price="<?php if ($p_data->sale_price && (($p_data->sale_price != null) or ($p_data->sale_price != 0))) { echo $p_data->sale_price;} else {echo $p_data->price;}?>"><?php echo $p_data->id.' - '.$p_data->title.' - Giá bán: '.@number_format($p_data->sale_price,0,',','.')?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>	
					<?php $x++;} } else {echo 'Chưa có sản phẩm trong mục này';} ?>
					
					<div class="col-12 d-flex justify-content-end">
						<button id="bulk_addtocart" class="btn btn-solid btn-addcombo" type="button">
							<span class="text"><i class="fa fa-shopping-bag"></i> Thêm tất cả</span>
						</button>
					</div>
				</div>
			</section>
			
<script>
	// add multiple products to cart
	$('#bulk_addtocart').click(function() {
		var product_id = [];
		var product_name = [];
		var product_price = [];
		var product_quantity = [];
		var action = "add";
		$('.select_product').each(function() {
			if ($(this).is(':selected') == true) {
				//alert($(this).data('product_id'));
				product_id.push($(this).data('product_id'));
				product_name.push($(this).data('product_name'));
				product_price.push($(this).data('product_price'));
				product_quantity.push($(this).data('product_quantity'));
			}
		});

		if (product_id.length > 0) {
			$.ajax({
				url: site_url + "ajax/bulk_add_to_cart",
				method: "POST",
				data: {
					product_id: product_id,
					product_name: product_name,
					product_price: product_price,
					product_quantity: product_quantity,
				},
				success: function(data) {
					$('.detail_cart').html(data);
					//alert("Đã thêm các sản phẩm vào giỏ hàng");
					window.location.href = site_url+"dat-hang";
				}
			});
		} else {
			alert('Hãy chọn ít nhất 1 sản phẩm');
		}
	});
</script>