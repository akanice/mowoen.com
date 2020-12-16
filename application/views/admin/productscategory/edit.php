<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý danh mục sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/productscategory')?>">Quản lý danh mục sản phẩm</a>
							</li>
							<li class="active">
								Sửa danh mục sản phẩm
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="col-md-8">
					<div class="card">
						<div class="header">
							<h4 class="title">Sửa danh mục sản phẩm</h4>
						</div>
						<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?=@$productcategory->title?>" required="" />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục cha</label>
                                <div class="col-sm-10">
                                    <select class="input-large m-wrap form-control" name="parent">
                                        <option value="0">--Mặc định--</option>
                                        <?php if (!empty($parents)) foreach($parents as $parent){?>
										<?php
											$indent = "";
											for ($i = 1; $i < $parent['level']; $i++) {
												$indent .= "--- ";
											}
										?>
                                            <option value='<?=@$parent['id']?>' <?php if($productcategory->parent_id == $parent['id']){echo 'selected="selected" ';}?>><?=@$indent.$parent['title']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_title" value="<?=@$productcategory->meta_title?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_description" value="<?=@$productcategory->meta_description?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thẻ meta keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="meta_keyword" value="<?=@$productcategory->meta_keyword?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/><br>
                                    <image src="<?=@site_url($productcategory->thumb)?>" height="100px">
                                </div>
                            </div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Home Banner</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="banner"><?=@$productcategory->banner?></textarea>
                                </div>
							</div>
							<script type = "text/javascript">
								function imagesload(file, banner, val) {
									var fileCollection = new Array();
									$('#' + file).on('change', function (e) {
										var files = e.target.files;
										$.each(files, function (i, file) {
											fileCollection.push(file);
											var reader = new FileReader();
											reader.readAsDataURL(file);
											reader.onload = function (e) {
												var template = e.target.result;
												$('#' + banner).attr({
													'src': template
												});
												$("#" + val).val("");
											};
										});
									});
								}
							  imagesload('banner', 'banner_cat', '');
							</script>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
								</div>
                            </div>
						</div>
					</div>
					<!-- END VALIDATION STATES-->
				</div>
			
				<div class="col-md-4">
					<div class="card">
						<div class="header">
							<h4 class="title">Sản phẩm có thể tạo combo</h4>
						</div>
						<div class="content">
							<div class="form-group">
								<label class="col-sm-12">Custom field</label>
								<?php
									$c = 0;//print_r($pricingPackage);
									$packages = json_decode($productcategory->custom_field);
									if ($packages) {
										if ( count( $packages ) > 0 && is_array($packages)) {
											foreach( $packages as $item ) {
												if ( isset( $item->packname ) || isset( $item->packvalue ) ) {
													printf( '
														<div class="package-item clearfix">
															<div class="col-sm-3"><input type="text" class="form-control" name="packages[%1$s][packname]" value="%2$s" /></div>
															<div class="col-sm-8"><input type="text" class="form-control" name="packages[%1$s][packvalue]" value="%3$s" /></div>
															<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>
														</div>
														',
															$c, $item->packname,$item->packvalue, 'Xóa'
														);
													$c = $c +1;
												}
											}
										}
									}
									?>
								<div id="output-package" class="clearfix"></div>
								<div class="col-sm-12"><a href="#" class="add_package btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<select data-placeholder="Chọn sản phẩm..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="products[]">
										<?php if ($products) foreach($products as $a){?>
											<option value="<?=$a->id?>" <?php if (($products_picked != '') and ($products_picked)) { if(in_array($a->id,$products_picked)) { echo 'selected'; }}?>><?=$a->id?>-<?=$a->title?></option>
										<?php }?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
            <!-- END PAGE CONTAINER-->
			</form>
        </div>
        <!-- END PAGE -->
    </div>
	<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	// var $ =jQuery.noConflict();
	//var $c = 0;
	$(document).ready(function(){
		var count = <?php echo $c-1; ?>;
		$(".add_package").click(function() {
			count = count + 1;
			$('#output-package').append('\
				<div class="package-item clearfix"> \
					<div class="col-sm-3"><input type="text" class="form-control" name="packages['+count+'][packname]" value="" /></div>\
					<div class="col-sm-8"><input type="text" class="form-control" name="packages['+count+'][packvalue]" value="" /></div>\
					<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>\
				</div>');
			return false;
		});
		$(document.body).on('click','.remove-package',function() {
			$(this).closest('div.package-item').remove();
		});
		$(".chosen-select").chosen();
	});
</script>