<?php if($cat_info) foreach ($cat_info as $n) {?>
<section class="slider-section slider-layout-4">
    <div class="container">
        <div class="row">
			<div class="col-xl-3 side-banner side-banner2 pr-0 d-none d-xl-block">
                <?=@$n->banner;?>
            </div>
            <div class="col-xl-9 pl-0 ratio_square media-product-section">
                <div class="tab-head">
                    <h2 class="title"><?=@$n->title;?></h2>
					<ul class="brand-list">
						<?php if($n->brand) {$i=1;$brands=$n->brand;foreach ($brands as $b) {?>
						<li><a href="#" data-brand="<?=$b->id?>" data-categoryid="<?=$n->id?>" class="<?php if ($i==1) {echo 'menu_active';}?>"><?=$b->name?></a></li>
						<?php $i++;}} ?>
					</ul>
                </div>
                <div class="slide-2" id="cat_<?=$n->id?>">
                </div>
            </div>
		</div>
	</div>
</section>
<?php } ?>


<script>
	function getSliderSettings(){
		return {
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 2,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		}
	}
	
	$(document).ready(function () {
		// Display First Data
		$('.menu_active').each(function(){
			var cat_id = $(this).data('categoryid');
			var brand_id = $(this).data('brand');
			var random = Math.random();
			$.post('products/homeDisplayProducts/', {cat_id: cat_id,brand_id:brand_id,random:random}).done(function(data) {
				$("#cat_"+cat_id).html(data);
				$("#cat_"+cat_id).not('.slick-initialized').slick(getSliderSettings());
			});
		});

		
		$(".brand-list").on('click', 'a',function(e) {
			e.preventDefault();
			$(".brand-list a").removeClass('menu_active');
			$('#loading_spinner').show();
			$(this).addClass('menu_active');
			var cat_id = $(this).data('categoryid');
			var brand_id = $(this).data('brand');
			var random = Math.random();
			
			$.ajax({
				type: "POST",
				url: site_url + "products/homeDisplayProducts",
				data: { cat_id:cat_id, brand_id:brand_id,random:random },
				//dataType: 'JSON',
				cache: false,
				success: function(result){
					// console.log(result);
					$('#loading_spinner').hide();
					// $("#cat_"+cat_id).destroySlick($(this));
					$("#cat_"+cat_id).slick('unslick');
					$("#cat_"+cat_id).html(result);
					$("#cat_"+cat_id).not('.slick-initialized').slick(getSliderSettings());
				}
			})	
			// alert(brand_id);
		});
	});
</script>