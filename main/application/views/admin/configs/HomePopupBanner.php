<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Popup Banner
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/configs')?>">Cài đặt hiển thị website</a>
							</li>
							<li class="active">
								Popup Banner
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
						<h4 class="title"><a href="<?=base_url('admin/configs/')?>" class="btn btn-fill btn-sm btn-primary">Quay lại</a> Popup Info</h4>
						<p><small><i></i></small></p>
					</div>
					<div class="content">
						<form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                                <label class="col-sm-2 control-label">Hiển thị</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="display">
										<option value="1" <?php if ($home_popup['display']=='1') {echo 'selected="selected" ';}?>>Có</option>
										<option value="0" <?php if ($home_popup['display']=='0') {echo 'selected="selected" ';}?>>Không</option>
									</select>
                                </div>
							</div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Delay time</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?=@$home_popup['delay_time']?>" name="delay_time" placeholder="giây">
                                </div>
							</div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Cookies</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?=@$home_popup['cookies']?>" name="cookies" placeholder="ngày">
                                </div>
							</div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="content" rows="10"><?=@$home_popup['content']?></textarea>
                                </div>
							</div>
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