<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
				<div class="card">
					<div class="content">
						<h3 class="page-title">
							Quản lý danh mục blog
						</h3>
						<ul class="breadcrumb">
							<li>
								<a href="<?=base_url('admin')?>">Trang chủ</a>
							</li>
							<li>
								<a href="<?=base_url('admin/postscategory')?>">Quản lý danh mục</a>
							</li>
							<li class="active">
								Sửa danh mục blog
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
            </div>
        </div>

		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="header">
						<h4 class="title">Sửa thông tin danh mục</h4>
					</div>
					<div class="content">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title" value="<?=@$postscategory->title?>" required=""/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Danh mục cha</label>
                                <div class="col-sm-9">
									<select class="input-large m-wrap form-control" name="parent_id">
										<option value="0" <?php if($postscategory->parent_id==0){echo 'selected="selected" ';}?>>--- Trống ---</option>
										<?php foreach ($categories as $c) {?>
                                        <option value="<?=$c->id?>" <?php if($postscategory->parent_id==$c->id){echo 'selected="selected" ';}?>><?=$c->title?>
											<?php if(!empty($c->sub_cat)) { 
												echo '</option>';
												foreach ($c->sub_cat as $sub)  {?>
													<option value="<?=$sub->id?>" <?php if($postscategory->parent_id==$sub->id){echo 'selected="selected" ';}?>>--- <?=$sub->title?></option>
											<?php } }?>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">Meta title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_title" value="<?=@$postscategory->meta_title?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_description" value="<?=@$postscategory->meta_description?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meta keywords</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="meta_keywords" value="<?=@$postscategory->meta_keywords?>">
                                </div>
                            </div>
							<!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Ảnh</label>
                                <div class="col-sm-9">
                                    <input type="file" accept="image" class="form-control" name="image" style="width: 200px"/><br>
                                    <image src="<?=@site_url($productcategory->thumb)?>" height="100px">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-fill btn-wd" name="submit" value="Lưu lại">
									<a href="javascript:window.history.go(-1);" class="btn btn-default">Hủy</a>
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