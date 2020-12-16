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
								Thêm mới danh mục sản phẩm
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
							<h4 class="title">Tạo mới danh mục sản phẩm</h4>
						</div>
						<div class="widget-body content">                        
							<div class="form-group">
								<label class="col-sm-2 control-label">Tên</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" required="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Danh mục cha</label>
								<div class="col-sm-10">
									<select class="input-large m-wrap form-control" name="parent">
										<option value="0">-- Mặc định --</option>
										<?php if (!empty($parents)) foreach($parents as $parent){?>
										<?php
											$indent = "";
											for ($i = 1; $i < $parent['level']; $i++) {
												$indent .= "--- ";
											}
										?>
											<option value="<?=@$parent['id']?>"><?=@$indent.$parent['title']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Thẻ meta title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_title">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Thẻ meta description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_description">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Thẻ meta keywords</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="meta_keyword">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Ảnh</label>
								<div class="col-sm-4">
									<input type="file" accept="image" class="form-control" name="image" id="image" />
									<img height="100" id="img_avatar" src="" alt ="" />
								</div>
							</div>
							<script type = "text/javascript">
								function imagesload(file, image, val) {
									var fileCollection = new Array();
									$('#' + file).on('change', function (e) {
										var files = e.target.files;
										$.each(files, function (i, file) {
											fileCollection.push(file);
											var reader = new FileReader();
											reader.readAsDataURL(file);
											reader.onload = function (e) {
												var template = e.target.result;
												$('#' + image).attr({
													'src': template
												});
												$("#" + val).val("");
											};
										});
									});
								}
							  imagesload('image', 'img_avatar', '');
							</script>
							<div class="form-group">
								<label class="col-sm-2 control-label">Home Banner</label>
								<div class="col-sm-10">
									<textarea class="form-control ckeditor" name="banner"></textarea>
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
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="content">
							<div class="form-group">
								<label class="col-sm-12">Custom Field</label>
								<div class="package-item clearfix">
									<div class="col-sm-3"><input type="text" class="form-control" name="packages[0][packname]" value="" placeholder="Nhãn/Tag" /></div>
									<div class="col-sm-8"><input type="text" class="form-control" name="packages[0][packvalue]" value="" placeholder="giá trị 1, giá trị 2, ..." /></div>
									<div class="col-sm-1"><span class=""><a href="javascript:void(0);" class="btn btn-info btn-simple btn-nopadding btn-link remove-package"><i class="fa fa-trash"></i></a></span></div>
								</div>
								<div id="output-package" class="clearfix"></div>
								<div class="col-sm-12"><a href="#" class="add_package btn btn-fill btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a></div>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
		
	</div>
        <!-- END PAGE -->
</div>