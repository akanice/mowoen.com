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
								Sửa sản phẩm
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
						<?php 
							@$cat_array = $products->categoryid;
							@$cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
						?>
						<h4 class="title">Sửa thông tin sản phẩm <a href="<?=@base_url('san-pham/'.$products->alias)?>" class="btn btn-sm btn-fill btn-warning" target="_blank">Xem</a> <a href="<?=@base_url('admin/products/add/')?>" class="btn btn-sm btn-fill btn-success" target="_blank"><i class="fa fa-plus"></i> Thêm mới</a></h4>
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Tên sản phấm*:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" required="" value="<?=$products->title?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">URL</label>
							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
									<?=base_url()?>
									</div>
									<input type="text" class="form-control" name="alias" value="<?=@$products->alias?>"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mã sản phẩm:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="sku" value="<?=$products->sku?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Giá gốc:</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="price" placeholder="Giá gốc" value="<?=$products->price?>"/>
							</div>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="sale_price" placeholder="Giá khuyến mãi" value="<?=$products->sale_price?>"/>
							</div>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="listed_price" placeholder="Giá niêm yết" value="<?=$products->listed_price?>"/>
							</div>
							<div class="col-sm-1">
								(VND)
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Loại</label>
							<div class="col-sm-10">
								<select class="form-control" name="type">
									<option value="product" <?php if($products->type=='product'){echo 'selected="selected" ';}?>>Sản phẩm thường</option>
									<option value="accessory" <?php if($products->type=='accessory'){echo 'selected="selected" ';}?>>Phụ kiện</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Sản phẩm nổi bật</label>
							<div class="col-sm-10">
								<select class="form-control" name="featured">
									<option value="0" <?php if($products->featured==0){echo 'selected="selected" ';}?>>Không</option>
									<option value="1" <?php if($products->featured==1){echo 'selected="selected" ';}?>>Có</option>
								</select>
							</div>
						</div>
						<div class="form-group">
								<label class="col-sm-2 control-label">Xuất xứ</label>
								<div class="col-sm-4">
									<?php
									$countries = array("Chính hãng","Afghanistan", "Albania", "Algeria", "Samoa thuộc Mỹ", "Andorra", "Angola", "Anguilla", "Nam Cực", "Antigua và Barbuda", "Argentina", "Armenia", "Argentina", "Úc", "Áo", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Bỉ", "Belize", "Bénin", "Bermuda", "Bhutan", "Bôlivia", "Bosnia và Herzegowina", "Botswana", "Đảo Bouvet", "Brazil", "Lãnh thổ Ấn Độ Dương thuộc Anh", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Campuchia", "Cameroon", "Canada", "Cape Verde", "Quần đảo Cayman", "Cộng hòa Trung Phi", "Chad", "Chile", "Trung Quốc", "Đảo Giáng sinh", "Cocos (Keeling ) Quần đảo", "Colombia", "Comoros", "Congo", "Congo, Cộng hòa Dân chủ", "Quần đảo Cook", "Costa Rica", "Bờ Biển Ngà", "Croatia (Hrvatska)", "Cuba", "Síp", "Cộng hòa Séc", "Đan Mạch", "Djibouti", "Dominica", "Cộng hòa Dominican", "Đông Timor", "Ecuador", "Ai Cập", "El Salvador", "Xích đạo Guinea", "Eritrea", "Estonia", "Ethiopia", "Quần đảo Falkland (Malvinas)", "Quần đảo Faroe", "Fiji", "Phần Lan", "P.R.C","Pháp", "Georgia", "Đức", "Ghana", "Gibraltar", "Hy Lạp", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Quần đảo Heard và Mc Donald", "Tòa thánh  Vatican", "Honduras", "Hồng Kông", "Hungary", "Iceland", "Ấn Độ", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Ý", "Jamaica", "Nhật Bản", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Hàn Quốc", "Kuwait", "Kyrgyzstan", "Lào", "Latvia", "Lebanon", "Lesentine", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Litva", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Quần đảo Marshall", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Liên bang", "Moldova, Cộng hòa", "Monaco", "Mông Cổ", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Hà Lan", "Antilles của Hà Lan", "New Caledonia", "New Zealand", "Nicaragua", "Nigeria", "Nigeria", "Niue", "Norfolk Đảo", "Quần đảo Bắc Mariana", "Na Uy", "Ô-man", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Ba Lan", "Bồ Đào Nha", "Puerto Rico", "Qatar", "Romania", "Liên bang Nga", "Rwanda", "Saint Kitts và Nevis", "Saint Lucia", "Saint Vincent và Grenadines", "Samoa", "San Marino", "Sao Tome và Principe", "Ả Rập Saudi", "Sénégal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Cộng hòa Slovak)", "Slovenia", "Quần đảo Solomon", "Somalia", "Nam Phi", "Nam Georgia và quần đảo Nam Sandwich", "Tây Ban Nha", "Sri Lanka", "St. Helena", "St. Pierre và Miquelon", "Sudan", "Suriname", "Svalbard và Jan Mayen Islands", "Swaziland", "Thụy Điển", "Thụy Sĩ", "Cộng hòa Ả Rập Syria", "Đài Loan", "Tajikistan", "Tanzania", "Thái Lan", "Togo", "Tokelau", "Tonga", "Trinidad và Tobago", "Tunisia", "Thổ Nhĩ Kỳ", "Turkmenistan", "Quần đảo Turks và Caicos", "Tuvalu", "Uganda", "Ukraine", "Các tiểu vương quốc Ả Rập thống nhất", "Vương quốc Anh", "Hoa Kỳ", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Việt Nam", "Quần đảo Virgin (Anh)", "Quần đảo Virgin (Mỹ)", "Quần đảo Wallis và Futuna", "Tây Sahara", "Yemen", "Nam Tư", "Zambia", "Zimbabwe");
									sort($countries);
									//echo $a;
									?>
									<select class="form-control" name="made_in" />
										<option>---</option>
										<?php foreach ($countries as $item) {?>
										<option value="<?=$item?>" <?php if($products->made_in==$item){echo 'selected="selected" ';}?>><?=$item?></option>
										<?php } ?>
									</select>
								</div>
								<label class="col-sm-2 control-label">Số năm bảo hành</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="guarantee" placeholder="(Số) năm bảo hành" value="<?=$products->guarantee?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nhãn hiệu</label>
								<div class="col-sm-4">
									<select class="form-control" name="brand" />
										<?php if ($brands) {foreach ($brands as $i) {?>
										<option value="<?=$i->id?>" <?php if($products->brand==$i->id){echo 'selected="selected" ';}?>><?=$i->name?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả ngắn:</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="short_description" rows="10"><?=$products->short_description?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mô tả</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="description" rows="10"><?=$products->description?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thông số chi tiết</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="specifications" rows="10"><?=$products->specifications?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Quà tặng</label>
							<div class="col-sm-10">
								<textarea class="form-control ckeditor" name="extra_des" rows="10"><?=$products->extra_des?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tags</label>
							<div class="col-sm-10">
								<select data-placeholder="Chọn tags..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="tags[]">
									<?php if ($alltags) foreach($alltags as $a){?>
										<option value="<?=$a->id?>" <?php if (($product_tags != '') and ($product_tags)) { if(in_array($a->id,$product_tags)) { echo 'selected'; }}?>><?=$a->name?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Video đính kèm</label>
							<div class="col-sm-10">
								<select data-placeholder="Thêm video..." class="chosen-select form-control" style="width:100%;" tabindex="4" name="videos">
									<?php foreach($allvideos as $v){?>
										<option value="<?=$v->id?>" <?php if (($p_video_attach != '') and ($p_video_attach)) { if($v->id == $p_video_attach) { echo 'selected'; }}?>><?=$v->title?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Phụ kiện</label>
							<div class="col-sm-10">
								<select data-placeholder="Chọn phụ kiện phù hợp sản phẩm..." class="chosen-select form-control" multiple style="width:100%;" tabindex="4" name="combo[]">
									<?php foreach($allaccessories as $a){?>
										<option value="<?=$a->id?>" <?php if (($product_combo != '') and ($product_combo)) { if(in_array($a->id,$product_combo)) { echo 'selected'; }}?>><?=$a->title?></option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_title" value="<?=@$products->meta_title?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta description</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_description"value=" <?=@$products->meta_description?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Meta keywords</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="meta_keywords" value="<?=@$products->meta_keywords?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Hủy</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
			<div class="col-md-4">
				<div class="card">
					<div class="content">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">* </span>:</label>
							<div class="col-sm-8">
								<div class="" style="overflow-y: scroll;height: 250px;border: 1px solid #eee;padding: 0 10px;">
									<?php foreach($list_cat_id as $cat_item) {?>
									<?php
										$indent = "";
										for ($i = 1; $i < $cat_item['level']; $i++) {
											$indent .= "--- ";
										}
									?>
									<label class="checkbox">
										<input type="checkbox" name="categoryid[]" data-toggle="checkbox" value="<?=@$cat_item['id']?>" <?php if (in_array($cat_item['id'],$products->categoryid)) {echo 'checked';}?>> <?=@$indent.$cat_item['title'] ?>
									</label>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh đại diện</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="image" id="image" value="<?=@$products->image?>" readonly required />
								<p><a href="/assets/filemanager/dialog.php?type=1&field_id=image&relative_url=1&multiple=0" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Thêm ảnh đại diện</a></p>
								<img src="<?=@base_url($products->thumb)?>" style="width: 100px;"/>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Thư viện ảnh</label>
							<div class="col-sm-10">
								<br><p><a href="/assets/filemanager/dialog.php?type=1&field_id=gallery&relative_url=0&multiple=1" class="btn btn-sm btn-fill btn-warning iframe-btn" type="button">Thêm thư viện ảnh</a></p>
								<input type="hidden" class="form-control" id="gallery" value="" />
								<div class="append_html">
									<?php 
										$gallery = json_decode($products->gallery);
										if($gallery) {foreach ($gallery as $i=>$img) {
									?>
									<div class="rel"><img src="<?=@$img?>" height="60px"><span class="remove"><i class="fa fa-times"></i></span><input type="hidden" name="gallery[]" value="<?=@$img?>"></div>
									<?php }} ?>
								</div>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh thực tế</label>
							<div class="col-sm-10" id="realtime_display_actual">
								<br><p><a href="/assets/filemanager/dialog.php?type=1&field_id=actual_image&relative_url=0&multiple=1" class="btn btn-sm btn-fill btn-info iframe-btn" type="button">Thêm ảnh thực tế</a></p>
								<input type="hidden" class="form-control" id="actual_image" value="" />
								<div class="append_html">
									<?php 
										$actual_image = json_decode($actual_image);
										if($actual_image) {foreach ($actual_image as $i=>$img) {
									?>
									<div class="rel"><img src="<?=@$img?>" height="60px"><span class="remove"><i class="fa fa-times"></i></span><input type="hidden" name="actual_image[]" value="<?=@$img?>"></div>
									<?php }} ?>
								</div>
							</div>
						</div><hr>
						<div class="form-group">
							<label class="col-sm-2 control-label">File đính kèm</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="files" id="files" value="<?=@$p_file_attach?>" readonly/>
								<p><a href="/assets/filemanager/dialog.php?type=2&field_id=files&relative_url=1" class="btn btn-sm btn-fill btn-success iframe-btn" type="button">Open Filemanager</a></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12">Custom field</label>
							<?php
								$c = 0;//print_r($pricingPackage);
								if ($p_custom_data) {foreach( $p_custom_data as $cd ) {
									$p[] = $cd;
								}}
								
								if ($cat_custom_field) {
									if ( count( $cat_custom_field ) > 0 && is_array($cat_custom_field)) {
										foreach( $cat_custom_field as $item ) {
											if ( isset( $item->packname ) || isset( $item->packvalue ) ) {?>
											<div class="package-item clearfix">
												<div class="col-sm-3"><label><?=@$item->packname?></label></div>
												<div class="col-sm-9">
													<select name="<?=make_alias($item->packname)?>" class="form-control">
														<?php $packvalue = explode(",",$item->packvalue);
															foreach( $packvalue as $pv ) {
															?>
														<option value="<?=$pv?>" <?php if($pv==$p[$c]) echo 'selected';?>><?=$pv?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<?php } $c++;
										}
									}
								}
								?>
							<div id="output-package" class="clearfix"></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
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
    </script>
<style>
.image-uploadeds {position: relative; display: inline-block; margin-right: 15px; margin-bottom: 5px;}
.image-uploadeds .img-check {position: absolute;}

</style>