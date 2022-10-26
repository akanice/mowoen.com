<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Trả lời bình luận
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/commentss')?>">Quản lý bình luận</a>
							</li>
							<li class="active">
								Trả lời bình luận
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>
	
    <!-- Main content -->
		<div class="row">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="header">
							<h4 class="title">Chi tiết bình luận</h4>
						</div>
						<div class="content">
							<div class="form-group">
								<label class="col-sm-2 control-label">Trạng thái</label>
								<div class="col-sm-6">
									<select name="approved" class="form-control">
										<option value="0" <?php if($comments->approved==0) {echo 'selected';}?>>Chưa được duyệt</option>
										<option value="1" <?php if($comments->approved==1) {echo 'selected';}?>>Duyệt (công khai)</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Họ Tên</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" value="<?=@$comments->name?>" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Email </label>
								<div class="col-md-10"><input type="email" class="form-control" name="email" value="<?=@$comments->email?>" disabled /></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Phone </label>
								<div class="col-md-10"><input type="text" class="form-control" name="phone" value="<?=@$comments->phone?>" disabled /></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Thời gian</label>
								<div class="col-md-10"><input type="text" class="form-control" name="create_time" value="<?php echo date_format(date_create(@$comments->create_time),"d/m/Y H:s"); ?>" disabled /></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Bình luận</label>
								<div class="col-md-10"><textarea class="form-control" name="comment" disabled /><?=@$comments->comment?></textarea></div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Ảnh đính kèm</label>
								<div class="col-md-10">
									<?php if (@$comments->attachment != '') {
										foreach (json_decode($comments->attachment) as $i) {?>
										<a href="<?=base_url($i)?>" class="fancy-img"><img src="<?=base_url($i)?>" height="48px"></a>
										<?php }} ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Trả lời</label>
								<div class="col-md-10"><textarea class="form-control ckeditor" name="reply"/></textarea></div>
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
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="header">
							<h4 class="title">Trả lời trước đó</h4>
						</div>
						<div class="content prev_comment_box">
							<?php if ($reply) { foreach($reply as $item) {?>
								<p id="comment_<?=@$item->id?>"><b><?=@$item->name;?></b> <small class="color_green"><i>(<?php echo date_format(date_create(@$item->create_time),"d/m/Y H:s"); ?>)</i></small>: <?=@$item->comment;?> 
								<span class="loading"></span>
								<button class="btn btn-danger btn-sm btn-fill delete_comment" data-comment_id="<?=@$item->id?>"><i class="fa fa-trash"></i> Xóa</button></p>
							<?php }} ?>
						</div>	
					</div>
				</div>
			</form>
		</div>
		<!-- END PAGE CONTAINER-->
	</div>
	<!-- END PAGE -->
</div>
<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
<script>
	$(function() {
		$(".delete_comment").click(function() {
			var comment_id = $(this).data('comment_id');
			$(".delete_comment .loading").fadeIn(100).html('<div id="loading_spinner"><imgsrc="<?php echo base_url('');?>assets/img/loading.gif" />Đang tải Comment...</div>');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('admin/ajax/delete_comment');?>",
				data: {comment_id: comment_id},
				cache: false,
				success: function(data) {
					$('#comment_'+comment_id).remove();
				}
			});
			return false;
		});
	});
	</script>