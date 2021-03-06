<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý trang
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/pages')?>">Quản lý trang</a>
							</li>
							<li class="active">
								Thêm mới trang
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
			<div class="col-md-8 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Tạo mới</h4>
					</div>
					<div class="content">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tiêu đề</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" required="" />
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Loại bài viết</label>
                                <div class="col-sm-10">
                                    <select name="type" class="form-control" readonly>
										<option value="post" >Mặc định</option>
										<option value="page" selected>Trang</option>
										<option value="landing">Landing Page</option>
									</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="content" rows="20"></textarea>
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
                                    <input type="text" class="form-control" name="meta_keywords">
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
			<div class="col-md-4 col-lg-4">
				<div class="card">
					<div class="header">
					</div>
					<div class="content">
						<div class="form-group">
							<label class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-10">
								<input type="file" accept="image" class="form-control" name="image" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" class="btn btn-primary btn-fill btn-wd btn-sm" name="submit" value="Lưu lại">
								<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill btn-sm">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
        </div>
        <!-- END PAGE -->
    </div>