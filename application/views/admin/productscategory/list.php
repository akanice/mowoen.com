<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
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
							<li class="active">
								Quản lý danh mục sản phẩm
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
						<!-- <div class="body collapse in" style="margin: 0 0 15px">
							<a href="<?=site_url('admin/productscategory/add')?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div> -->
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý danh mục sản phẩm</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width='5%'>ID</th>
										<th width=''>Ảnh</th>
										<th width=''>Tên</th>
										<th width=''>Loại</th>
										<th width=''>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@$base?>">
										<tr>
											<td></td>
											<td></td>
											<td><input type="text" class="form-control" placeholder="Tên danh mục" name="name" value="<?=@$name?>"></td>
											<td></td>
											<td style="text-align: center"><button type="submit" class="btn btn-default btn-fill btn-sm">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><image src="<?=@site_url($item->thumb)?>" width="32"></td>
											<td>
												<?php if ($item->parent_id == 0) {
														echo '<strong>'.$item->title.'</strong> (danh mục gốc)';
													} else {
														echo $item->title;
													}
												?>
												<a class="btn btn-sm btn-primary btn-fill" href="<?=base_url('admin/products?type='.$type.'&cat='.$item->id)?>">Xem sản phẩm</a>
											</td>
											<td><?php if (@$item->type == 'bathroom') {echo '<span class="text-info">Nhà tắm</span>';} else {echo '<span class="text-warning">Nhà bếp</span>';}?></td>
											<td style="text-align: center"><a href="<?=@base_url('admin/productscategory/edit/'.$item->id)?>" class="btn btn-fill btn-sm btn-info"><i class="fa fa-pencil"></i> Sửa</a> <a href="<?=@base_url('admin/productscategory/delete/'.$item->id.'?type='.$type)?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-fill btn-sm btn-warning"><i class="fa fa-trash"></i> Xóa</a></td>
										</tr>
										<?php } ?>
										<tr>
											<td></td>
											<td></td>
											<td><a href="<?=base_url('admin/productscategory/add?type='.$type)?>"><i class="fa fa-plus"></i> Thêm danh mục mới</a></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                <div style="padding-left: 400px"><?php echo $page_links?></div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <!-- END PAGE -->
    </div>