<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý sản phẩm
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Quản lý sản phẩm
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
							<a href="<?=base_url('admin/products/add?type=').$type?>" class="btn btn-info btn-fill btn-wd">Thêm mới</a>
						</div>
						<div class="widget red">
							<div class="widget-title">
								<h4>Quản lý sản phẩm</h4>
							</div>
							<div class="widget-body">
								<table class="table table-striped table-bordered" id="sample_1">
									<thead>
									<tr>
										<th width=''>ID</th>
										<th width=''>Ảnh</th>
										<th width=''>Tên sản phẩm</th>
										<th width=''>Loại sản phẩm</th>
										<th width=''>Danh mục</th>
										<th width=''>Nổi bật</th>
										<th width=''>Giá</th>
										<th width=''>Hành động</th>
									</tr>
									</thead>
									<form method="GET" action="<?=@base_url('admin/products?type='.$type)?>">
										<input type="hidden" name="type" value="<?=@$type?>">
										<tr>
											<td width=''></td>
											<td width=""></td>
											<td width=''><input type="text" class="form-control" placeholder="Tên" name="name" value="<?=@$name?>"></td>
											<td width=""></td>
											<td width="">
												<select name="cat" class="form-control">
													<option value="">Tất cả</option>
													<?php if(@$productcategory) {foreach ($productcategory as $i) {?>
														<option value="<?=$i->id?>" <?php if($i->id==@$cat){echo 'selected="selected" ';}?>><?=$i->title?></option>	
													<?php }} ?>
												</select>
											</td>
											<td width=""></td>
											<td width=""></td>
											<td width='' style="text-align: center"><button type="submit" class="btn btn-default btn-fill">Tìm kiếm</button></td>
										</tr>
									</form>
									<tbody>
									<?php if($list) foreach ($list as $item){ ?>
										<tr class="odd gradeX">
											<td><?=@$item->id?></td>
											<td><img src="<?=@site_url($item->thumb)?>" style="height:20px"></td>
											<td><?=@$item->title?> - <small class="text-danger"><?=@$item->sku?></small> <a href="<?=@base_url($item->type.'/products/'.$item->alias)?>" class="btn btn-sm btn-fill btn-primary" target="_blank">Xem</a></td>
											<td><?php if (@$item->type == 'bathroom') {echo '<span class="text-info">Nhà tắm</span>';} else {echo '<span class="text-warning">Nhà bếp</span>';}?></td>
											<td>
												<?php foreach (json_decode($item->categoryid) as $c) {
													$c_data = $this->productscategorymodel->read(array('id'=>$c),array(),true);?>
													<a href="<?=base_url('admin/products?type='.$type.'&cat='.$c_data->id)?>">
														<?php
															echo $c_data->title;
														?>
													</a>
												<?php }?>	
											</td>
											<td><?php if ($item->featured == 1) {echo '<i class="fa fa-check"></i>';}?></td>
											<td>
												<!-- <?=@$item->sale_price?> - <span style="text-decoration: line-through"> -->
												<small><?=number_format(@$item->price,0,',','.');?></small></span>
											</td>
											<td style="text-align: center">
												<a href="<?=@base_url('admin/products/edit/'.$item->id)?>" class="btn btn-fill btn-sm btn-info"><i class="fa fa-pencil"></i> Sửa</a>
												<a href="<?=@base_url('admin/products/duplicate/'.$item->id)?>" class="btn btn-fill btn-sm btn-success"><i class="fa fa-pencil"></i> Duplicate</a>
												<a href="<?=@base_url('admin/products/delete/'.$item->id.'?type='.$type)?>" class="btn btn-fill btn-sm btn-warning" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" ><i class="fa fa-trash"></i> Xóa</a></td>
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
	</div>
</div>
