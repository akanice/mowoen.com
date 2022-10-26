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
								Xem và tải QRCode
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-10 col-lg-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Xem và tải QRCode</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal">
                            <div class="form-group">
								<label class="col-sm-2">Sản phẩm:</label>
								<div class="col-sm-10">
									<?=@$product->title?> - <?=@$product->sku?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2">Số lượng QRcode:</label>
								<div class="col-sm-10">
									<?=@count(json_decode($qrcode->qrcode))?>
								</div>
							</div>
                            <div class="form-group">
								<div class="col-sm-6">
									<!-- <button class="btn btn-primary btn-fill btn-wd" id="downloadQR">Tải xuống</button> -->
									<a href="javascript:window.history.go(-1);" class="btn btn-default btn-fill">Quay lại</a>
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
	<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#downloadQR").click(function(e) {
				e.preventDefault();
				var qrcode_list_id = '<?php echo $qrcode->id?>';
				
				$.ajax({
					url : "<?php echo site_url('admin/qrcodes/downloadQR');?>",
					type: "POST",
					data : {qrcode_list_id:qrcode_list_id},
					success: function(response){
						var result = $.parseJSON(response);
						console.log(result.status);
					},
					
				});
			});
    </script>