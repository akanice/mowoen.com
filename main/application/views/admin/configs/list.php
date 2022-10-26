<div class="content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Cài đặt hiển thị website
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li class="active">
								Cài đặt hiển thị website
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Module Trang chủ</h4>
								<?php //print_r($result);?>
							</div>
							<div class="widget-body">
								<div class="item">
									<table class="table">
										<tbody>
											<tr>
												<td>Bài viết nổi bật tại trang chủ</td>
												<td><?php if ($home_featured_article){?>
														<b><?=@$home_featured_article->title?></b>
													<?php } ?></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editFeaturedArticles')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Danh mục sản phẩm tại trang chủ</td>
												<td><?php if ($home_cat_available) {?>
													<?php foreach ($home_cat_available as $item) {?>
														<a href="<?=@base_url('admin/productscategory/edit/'.$item->id)?>" class="btn btn-xs btn-fill"><?=@$item->title?> <i class="fa fa-pencil"></i></a>
													<?php } } ?></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/editCat/home')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Popup Quảng cáo</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/HomePopupBanner/')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Group Banners</td>
												<td></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/HomeGroupBanners')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-6">
				<div class="card">
					<div class="content">
						<div class="widget red">
							<div class="widget-title">
								<h4>Module Trang sản phẩm</h4>
								<?php //print_r($result);?>
							</div>
							<div class="widget-body">
								<div class="item">
									<table class="table">
										<tbody>
											<tr>
												<td>Slider trang Danh mục sản phẩm</td>
												<td><?php if (@$product_cat_slider) {?>
													<?php foreach ($product_cat_slider as $item) {?>
														<img src="<?=@base_url($item->image)?>" class="btn btn-xs btn-fill"><?=@$item->link?>
													<?php } }?></td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/ProductCatSlider')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
											<tr>
												<td>Box quà tặng trang sản phẩm</td>
												<td>&nbsp;</td>
												<td class="td-actions text-right">
													<a href="<?=@base_url('admin/configs/ProductGiftContent')?>" rel="tooltip" title="" class="btn btn-info btn-simple btn-link">
														<i class="fa fa-edit"></i>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
					
            </div>
			
			
        </div>
        <!-- END PAGE -->
    </div>