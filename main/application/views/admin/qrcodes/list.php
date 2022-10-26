<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý QRCode
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý QRCode
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
					<div class="content">
						<div class="body collapse in" style="margin: 0 0 15px">
							<a href="<?=site_url('admin/qrcodes/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý QRCode</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width='5%'>ID</th>
										<th width='25%'>Tên Sản phẩm </th>
										<th width='25%'>Mã Sản phẩm </th>
										<th width='25%'>Số lượng QR</th>
										<th width='25%'>Ngày tạo</th>
										<th width='25%'>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td width='5%'></td>
											<td width='25%'><input type="text" class="form-control" placeholder="Tên" name="product_name" value="<?=@$product_name?>"></td>
											<td width='25%'><input type="text" class="form-control" placeholder="Tên" name="product_sku" value="<?=@$product_sku?>"></td>
											<td width='25%'></td>
											<td width='25%'></td>
											<td width='25%' style="text-align: center"><button type="submit" class="btn btn-default">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><?=@$item->product_name?></td>
											<td><?=@$item->product_sku?></td>
											<td><?=@$item->count?></td>
											<td><?php echo date_format(date_create($item->create_time),"d-m-Y"); ?></td>
											<td style="text-align: center"><a href="<?=@base_url('admin/qrcodes/delete/'.$item->id)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div style="padding-left: 400px" class="clearfix pagination"><?php echo $page_links?></div>
					</div>
				</div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>