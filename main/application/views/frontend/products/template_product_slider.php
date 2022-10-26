<?php if ($products) foreach ($products as $item) { ?>
	<div class="product-box">
		<div class="img-block">
			<?php 
				// $cat_array = json_decode($item->categoryid);
				// $cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
			?>
			<a href="<?=base_url('san-pham/'.$item->alias)?>" class="bg-size" style="background-image: url('<?=base_url($item->thumb)?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;"></a>

			<div class="quick-info">
				<a href="<?=base_url('san-pham/'.$item->alias)?>" ></a>
				<div class="text">
					<?=$item->short_description?>
				</div>
			</div>
		</div>
		<div class="product-info">
			<a href="<?=base_url('san-pham/'.$item->alias)?>"><h6><?=$item->title?></h6></a>
			<div class="innovatory-product-price-and-shipping">
				<span itemprop="price" class="price">
					<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {
						echo '<h5>'.number_format($item->sale_price,0,',','.').' đ</h5>';
						} else {
							if ($item->price != 0) {
								echo '<h5>'.number_format($item->price,0,',','.').' đ</h5>';
							} else {
								echo 'Liên hệ';
							}
						} ?>
				</span>
				<?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><span class="old-price regular-price"><del><?=@number_format($item->price,0,',','.')?> đ</del></span><?php } ?>
				<!--<span class="percent-label"><?php if ($item->sale_price && (($item->sale_price != null) or ($item->sale_price != 0))) {?><?php echo '-'.round(($item->price-$item->sale_price)*100/$item->price,0)?>%<?php } ?></span>-->
			</div>
		</div>
	</div>
<?php } ?>