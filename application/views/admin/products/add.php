<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/products')?>">Quản lý sản phẩm</a>
							</li>
							<li class="active">
								Thêm mới sản phẩm
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
						<h4 class="title">Tạo mới sản phẩm</h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tên sản phấm*:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="title" required=""/>
							</div>
							<label class="col-sm-2 control-label">Mã sản phẩm:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="sku" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Giá:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="price" placeholder="Giá gốc"/>
							</div>
							<label class="col-sm-2 control-label">Giá khuyến mãi:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="sale_price" placeholder="Giá khuyến mãi"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sản phẩm nổi bật</label>
							<div class="col-sm-4">
								<select class="form-control" name="featured">
									<option value="0">Không</option>
									<option value="1">Có</option>
								</select>
							</div>
							<label class="col-sm-2 control-label">Số năm bảo hành</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="guarantee" placeholder="(Số) năm bảo hành"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Kích thước (mm)</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="dimension" placeholder="VD: 1500*1000*800"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Link video</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="videos" placeholder="https://www.youtube.com/watch?v=5bfUQc8beUw"/>
							</div>
						</div>
						<div class="form-group" id="prod_variant">
							<label class="col-sm-2 control-label">File đính kèm</label>
							<div class="col-sm-10">
								<div id="output-packing" class="clearfix"></div>
							</div>
							<div class="col-sm-offset-2 col-sm-10"><a href="#" class="add_packing btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả ngắn:</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="short_description" rows="10"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="description" rows="10"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thông số chi tiết</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="specifications" rows="10"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_title" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta description</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_description" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta keywords</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_keywords" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
							</div>
						</div>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="card">
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Loại</label>
							<div class="col-sm-4">
								<select class="form-control" name="type" id="type_cat" readonly data-value="" onfocus="this.setAttribute('data-value', this.value);" onchange="this.value = this.getAttribute('data-value');">
									<option value="bathroom" <?php if ($type && $type=='bathroom') {echo 'selected';}?>>Nhà tắm</option>
									<option value="kitchen" <?php if ($type && $type=='kitchen') {echo 'selected';}?>>Nhà Bếp</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">* </span>:</label>
							<div class="col-sm-10">
								<div class="" style="overflow-y: scroll;height: 250px;border: 1px solid #eee;padding: 0 10px;" id="slug">
									<?php foreach($list_cat_id as $cat_item) {?>
									<?php
										$indent = "";
										for ($i = 1; $i < $cat_item['level']; $i++) {
											$indent .= "--- ";
										}
									?>
									<label class="checkbox">
										<input type="checkbox" name="categoryid[]" data-toggle="checkbox" value="<?=@$cat_item['id']?>"> <?=@$indent.$cat_item['title'] ?>
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh đại diện</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="image" id="image" readonly required />
								<p><a href="/assets/filemanager/dialog.php?type=1&field_id=image&relative_url=1&multiple=0" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Thêm ảnh đại diện</a></p>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thư viện ảnh</label>
							<div class="col-sm-10">
								<br><p><a href="/assets/filemanager/dialog.php?type=1&field_id=gallery&relative_url=0&multiple=1" class="btn btn-sm btn-fill btn-warning iframe-btn" type="button">Thêm thư viện ảnh</a></p>
								<input type="hidden" class="form-control" id="gallery" value="" />
								<div class="append_html"></div>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thư viện ảnh</label>
							<div class="col-sm-10">
								<br><p><a href="/assets/filemanager/dialog.php?type=1&field_id=circleview&relative_url=0&multiple=1" class="btn btn-sm btn-fill btn-warning iframe-btn" type="button">Thêm thư viện ảnh</a></p>
								<input type="hidden" class="form-control" id="circleview" value="" />
								<div class="append_html"></div>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh thực tế</label>
							<div class="col-sm-10" id="realtime_display_actual">
								<br><p><a href="/assets/filemanager/dialog.php?type=1&field_id=actual_image&relative_url=0&multiple=1" class="btn btn-sm btn-fill btn-info iframe-btn" type="button">Thêm ảnh thực tế</a></p>
								<input type="hidden" class="form-control" id="actual_image" value="" />
								<div class="append_html"></div>
							</div>
						</div><hr>
						<div class="form-group">
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</div>
            </form>
        </div>
    </div>
</div>
	<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
    <script type="text/javascript">
		var $ =jQuery.noConflict();
		// var $c = 0;
		jQuery(document).ready(function($){
			var count = <?php echo $c-1; ?>;
			$(".add_packing").click(function() {
				count = count + 1;
				$('#output-packing').append('\
					<div class="row package-item clearfix"> \
						<div class="col-sm-5 col"><input type="text" class="form-control" name="pricingPackage['+count+'][prodname]" value="" placeholder="Tên file"/></div>\
						<div class="col-sm-5 col"><input type="text" class="form-control" name="pricingPackage['+count+'][prodpath]" id="prodpath_'+count+'" value=""placeholder="File" readonly/></div>\
						<div class="col-sm-1 col"><a href="/assets/filemanager/dialog.php?type=2&field_id=prodpath_'+count+'&relative_url=1&multiple=0" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Chọn file</a></div>\
						<div class="col-sm-1 col"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>\
					</div>');
				return false;
			});
			$(document.body).on('click','.remove-package',function() {
				$(this).closest('div.package-item').remove();
			});
		});
		
		
		// filemanager callback
		function responsive_filemanager_callback(field_id){
			var img_data = $('#'+field_id).val();
			if(IsJsonString(img_data) == true) {
				var img_data = jQuery.parseJSON(img_data);
				img_data.forEach(function(item, index) {
					$('#'+field_id).next('.append_html').append('<div class="rel"><img src="'+item+'" height="60px"><span class="remove"><i class="fa fa-times"></i></span><input type="hidden" name="'+field_id+'[]" value="'+item+'"></div>');
				},field_id);
			} else {
				print_single_img(img_data,field_id);
			}
		}
		
		// check json
		function IsJsonString(str) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
		}
	
		function print_single_img(img_data,field_id) {
			$('#'+field_id).next('.append_html').append('<div class="rel"><img src="'+img_data+'" height="60px"><span class="remove"><i class="fa fa-times"></i></span><input type="hidden" name="'+field_id+'[]" value="'+img_data+'"></div>');
		}
		
		$('.append_html').on('click','.remove',function() {
			$(this).parent('.rel').remove();
		});
		
		// Ajax load category after choose type
		// var site_url = '<?=site_url();?>';
		// $('#type_cat').on('change', function (e) {
			// $('#loading_spinner').show();
			// var optionSelected = $("option:selected", this);
			// var dataString = this.value;
			// //alert(dataString);
			// $.ajax({
				// type: "POST",
				// url: site_url + "admin/ajax/load_categories",
				// data: { dataString : dataString },
				// //dataType: 'JSON',
				// cache: false,
				// success: function(html){
					// $("#slug").html(html);
					// $('#loading_spinner').hide();
				// }
			// })	
		// })

    </script>