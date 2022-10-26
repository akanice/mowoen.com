<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý qrcode
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/qrcodes')?>">Quản lý qrcode</a>
							</li>
							<li class="active">
								Thêm mới qrcode
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
						<h4 class="title">Tạo mới qrcode</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<?php if($this->session->flashdata('message')) {?>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-10">
										<div class="alert alert-danger" style="width:600px;margin-bottom:0">
											<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
												<i class="pe-7s-close"></i>
											</button>
											<span>
												<b><?php echo $this->session->flashdata('message'); ?></b></span>
										</div>
									</div>
								</div>
							<?php } ?>
                            <div class="form-group">
								<label class="col-sm-2 control-label">Chọn sản phẩm*:</label>
								<div class="col-sm-10">
									<select data-placeholder="Chọn 1 sản phẩm..." class="chosen-select form-control" style="width:100%;" tabindex="4" name="product_id">
                                        <?php foreach($products as $a){?>
                                            <option value="<?=$a->id?>" <?php if (@$current_product && $current_product===$a->id) {echo 'selected';}?>><?=$a->title?> - <?=$a->sku?></option>
                                        <?php }?>
                                    </select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Số lượng QRcode*:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" name="number" value="10" required=""/>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Tạo mã bảo hành">
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