<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý nhãn hiệu
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/products')?>">Quản lý nhãn hiệu</a>
							</li>
							<li class="active">
								Sửa nhãn hiệu
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới nhãn hiệu</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
								<label class="col-sm-2 control-label">Tên nhãn hiệu*:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" required="" value="<?=$brand->name?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Ảnh</label>
								<div class="col-sm-10">
									<input type="file" accept="image" class="form-control" name="image" id="image" />
									<img height="100" id="img_avatar" src="<?=@base_url($brand->image)?>" alt ="" />
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
    <script type="text/javascript">
        $(document).ready(function () {
            $(".chosen-select").chosen();
        });
    </script>