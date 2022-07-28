<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý bình luận
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý bình luận
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

    <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Danh sách bình luận</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>Số điện thoại</th>
                                <th>Bình luận</th>
                                <th>Ảnh đính kèm</th>
                                <th>Bài viết / Sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <form method="GET" action="<?=@$base?>">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
										<select name="type" class="form-control">
											<option value="">---</option>
											<option value="product" <?php if ($type=="product") {echo 'selected';}?>>Sản phẩm</option>
											<option value="new" <?php if ($type=="new") {echo 'selected';}?>>Bài viết</option>
										</select>
									</td>
                                    <td>
										<select name="approved" class="form-control">
											<option value="">---</option>
											<option value="0" <?php if ($approved=="0") {echo 'selected';}?>>Chưa duyệt</option>
											<option value="1" <?php if ($approved=="1") {echo 'selected';}?>>Đã duyệt</option>
										</select>
									</td>
                                    <td style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
                                </tr>
                            </form>
                            <tbody>
                            <?php if($list) foreach ($list as $item){ ?>
                                <tr class="odd gradeX">
									<td><?=@$item->id?></td>
                                    <td><?=@$item->name?></td>
                                    <td><?=@$item->phone?></td>
                                    <td><?=@$item->comment?></td>
                                    <td><?php if (@$item->attachment != '') {
										foreach (json_decode($item->attachment) as $i) {?>
										<a href="<?=base_url($i)?>" class="fancy-img"><img src="<?=base_url($i)?>" height="48px"></a>
										<?php }} ?>
									</td>
                                    <td><?php
									switch (@$item->type) {
										case 'product':
											$this->load->model('productsmodel');
											$this->load->model('productscategorymodel');
											$p_data = $this->productsmodel->read(array('alias'=>$item->alias),array(),true);
											$cat_array = json_decode($p_data->categoryid);
											$cat_alias = $this->productscategorymodel->read(array('id'=>$cat_array[0]),array(),true)->alias;
											echo "Sản phẩm - <a class='color_blue' href='".base_url($cat_alias.'/'.$item->alias)."' target='_blank'>".$item->title."</a>";
											break;
										case 'new':
											echo "Bài viết - <a class='color_blue' href='".base_url('bai-viet/').$item->alias."' target='_blank'>".$item->title."</a>";
											break;
									} ?></td>
									<td><?php switch (@$item->approved) {
										case '0':
											echo "<span class='color_green'>Chưa duyệt</span>";
											break;
										case '1':
											echo "<span class='color_red'>Đã duyệt</span>";
											break;
									} ?></td>
                                    <td style="text-align: center">
										<a href="<?=@base_url('admin/comments/edit/'.$item->id)?>" class="btn btn-primary btn-sm btn-fill"><i class="fa fa-pencil"></i> Trả lời</a>
										<a href="<?=@base_url('admin/comments/delete/'.$item->id)?>" class="btn btn-danger btn-sm btn-fill" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a>
										
                                    </td>
								</tr>
                            <?php } ?>
                            </table>
							</div>
						</div>
					</div>
					<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
</div>

<script type="text/javascript">
    function editQrcode(itemId){
        $('#customerId').val(itemId);
        $('#editQrcodePopup').modal('show');
        return false;
    }

    function assignQrCode(event){
        event.preventDefault();
        var qr_number = $('#qr_number').val();
        var customer_id = $('#customerId').val();
        $.ajax({
            type: "POST",
            url: 'ajax/assignQrCode',
            data: {qr_number:qr_number,customer_id:customer_id},
            dataType: 'JSON',
            cache: false,
            success: function(result){
                if (result.ok){
                    alert("Bạn đã gán mã qrcode cho khách hàng thành công!");
                    $('#editQrcodePopup').modal('hide');
					$('#qrcode_number_'+result.item_id).html('Số mã QR: '+result.qr_number);
                }else{
                    alert(result.msg);
                }
            }
        });
    };
</script>
<div class="modal fade" id="editQrcodePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gán mã QRCode cho khách hàng</h4>
            </div>
			<form class="form-horizontal" method="POST" onsubmit="assignQrCode(event)">
            <div class="modal-body">
                <div class="form-group">
					<label class="col-sm-3 control-label" for="qr_number">Số QRCode</label>
					<div class="col-sm-9">
						<input type="number" name="qr_number" id="qr_number" />
						<input type="hidden" name="customerId" id="customerId" />
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div><!-- ./wrapper -->
