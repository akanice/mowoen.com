<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Banner Slider - Danh mục sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/configs')?>">Cài đặt hiển thị website</a>
							</li>
							<li class="active">
								Banner Slider - Danh mục sản phẩm
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12 col-lg-8">
				<div class="card">
					<div class="header">
						<?php if (isset($notice)) {?>
						<div class="alert alert-success">
							<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
								<i class="pe-7s-close"></i>
							</button>
							<span>
								<b><?=@$notice?></span>
						</div>
						<?php } ?>
						<h4 class="title"><a href="<?=base_url('admin/configs/')?>" class="btn btn-fill btn-sm btn-primary">Quay lại</a> Upload Slider</h4>
						<p><small><i></i></small></p>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="ProductCatSlider_form">
							<?php 
								$c = 0;//print_r($pricingPackage);
								$i = 1;//print_r($pricingPackage);
								if (@$product_cat_slider) {
									if ( count( $product_cat_slider ) > 0 && is_array($product_cat_slider)) {
										foreach (@$product_cat_slider as $item) {
											printf( '
												<div class="form-group package-item">
													<label class="col-sm-2 control-label">Upload Slider %5$s</label>
													<div class="col-sm-5">
														<input type="text" class="form-control" accept="image" id="image_%1$s" name="packages[%1$s][image]" value="%2$s" readonly>
														<p><a href="/assets/filemanager/dialog.php?type=1&field_id=image_%1$s&relative_url=0&multiple=0" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Open Filemanager</a></p>
														<input type="text" class="form-control" name="packages[%1$s][link]" placeholder="Link" value="%3$s">
													</div>
													<div class="col-sm-4">
														<p><b>Preview</b> </p><img src="%2$s" style="width:100&#37;">
													</div>
													<div class="col-sm-1">
														<a href="javascript:void(0);" class="btn btn-primary btn-fill btn-link btn-sm remove-package"><i class="fa fa-trash"></i></a>
													</div>
												</div><hr>
												',
												$c, $item['image'],$item['link'], 'Xóa',$i
												);
											$c = $c +1;$i = $i +1;
										}
									}
								}
							?>
							<div id="output-package" class="clearfix"></div>
							<div class="form-group"><div class="col-sm-2"></div><div class="col-sm-10"><a href="#" class="add_package btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
								</div>
							</div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>
</div>
<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/jquery-migrate-1.2.1.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	var $ =jQuery.noConflict();
	//var $c = 0;
	jQuery(document).ready(function($){
		var count = <?php echo $c-1; ?>;
		$(".add_package").click(function() {
			count = count + 1;
			$('#output-package').append('\
				<div class="form-group package-item">\
					<label class="col-sm-2 control-label">Upload Slider '+(count+1)+'</label>\
					<div class="col-sm-5">\
						<input type="text" class="form-control" id="image_'+count+'" name="packages['+count+'][image]" readonly />\
						<p><a href="/assets/filemanager/dialog.php?type=1&field_id=image_'+count+'&relative_url=0&multiple=0" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Open Filemanager</a></p>\
						<input type="text" class="form-control" name="packages['+count+'][link]" placeholder="Link">\
					</div>\
					<div class="col-sm-4">\
						<p><b>Preview</b> </p>\
					</div>\
					<div class="col-sm-1">\
						<a href="javascript:void(0);" class="btn btn-primary btn-fill btn-link btn-sm remove-package"><i class="fa fa-trash"></i></a>\
					</div>\
				</div><hr>\ ');
			return false;
		});
		// $('#output-package').bind('DOMSubtreeModified',function() {
			// $('.iframe-btn').fancybox({	
				// 'width'		: 900,
				// 'height'	: 600,
				// 'type'		: 'iframe',
				// 'autoScale'    	: false
			// });
		// });
		$(document.body).on('click','.remove-package',function() {
			$(this).closest('.package-item').remove();
		});
		//$(".chosen-select").chosen();
	});
</script>