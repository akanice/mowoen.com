<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="perfect-scrollbar-on"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?php if (!isset($title)) {echo 'Siêu thị khóa điện tử - Admin CP';} else {echo $title;}?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="akanice" name="author" />

    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<link rel="icon" href="<?=base_url('wp-content/uploads/2018/06/favicon.png')?>" sizes="32x32" />
	<link rel="apple-touch-icon-precomposed" href="<?=base_url('wp-content/uploads/2018/06/favicon.png')?>" />
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="<?=base_url('assets/css/light-bootstrap-dashboard.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/chosen.css')?>" rel="stylesheet">
	<link rel="stylesheet" href="/assets/plugins/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <link href="<?=base_url('assets/css/admin-custom.css')?>" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="<?=base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/pe-icon-7-stroke.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/fonts/fontbakery/font-bakery.css')?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700&amp;subset=vietnamese" rel="stylesheet">
    <!-- ie8 fixes -->
    <!--[if lt IE 9]>
       <script src="<?=base_url('assets/js/excanvas.js')?>"></script>
       <script src="<?=base_url('assets/js/respond.js')?>"></script>
       <![endif]-->

</head>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?=base_url('/assets/img/sidebar-4.jpg')?>">
		<div class="logo">
			<a href="#" class="logo-text">
				Nhật Minh Locks
			</a>
		</div>
		<div class="logo logo-mini">
			<a href="#" class="logo-text">
				Nhật Minh Locks
			</a>
		</div>

		<div class="sidebar-wrapper ps-container ps-theme-default ps-active-y" id="nml-sidebar">
			<div class="user">
				<div class="photo">
					<img src="<?php if (@$all_user_data['avatar'] && (@$all_user_data['avatar'] != '')) {echo base_url(@$all_user_data['avatar']);} else {echo base_url('assets/js/default-avatar.jpg');}?>">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" class="collapsed">
						<?php echo $all_user_data['username'];?>
						<b class="caret"></b>
					</a>
					<div class="collapse" id="collapseExample" aria-expanded="false">
						<ul class="nav">
							<li><a href="<?=base_url('admin/profiles');?>">Edit Profile</a></li>
							<li><a href="<?=base_url('admin/logout')?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<?php //if(($this->session->userdata('admingroup') == "admin")){ 
			$suffix_uri = $this->uri->segment(2); $sufix_uri3 = $this->uri->segment(3)?>
			<ul class="nav">
				<li>
					<a href="<?=base_url('admin')?>">
						<i class="pe-7s-graph"></i>
						<p>Dashboard</p>
					</a>
				</li>
				
				<li class="<?php if (($suffix_uri == 'newscategory') or ($suffix_uri == 'news') or ($suffix_uri == 'pages') or ($suffix_uri == 'videos')) echo 'active';?>">
					<a data-toggle="collapse" href="#componentsExamples">
						<i class="pe-7s-plugin"></i>
						<p>Bài viết
						   <b class="caret"></b>
						</p>
					</a>
					<div class="collapse <?php if (($suffix_uri == 'newscategory') or ($suffix_uri == 'news') or ($suffix_uri == 'pages') or ($suffix_uri == 'videos')) echo 'in';?>" id="componentsExamples">
						<ul class="nav">
							<li class="<?php if ($suffix_uri == 'newscategory') echo 'active'?>"><a href="<?=base_url('admin/newscategory')?>">Chuyên mục</a></li>
							<li class="<?php if ($suffix_uri == 'news') echo 'active'?>"><a href="<?=base_url('admin/news')?>">Bài viết</a></li>
							<li class="<?php if ($suffix_uri == 'pages') echo 'active'?>"><a href="<?=base_url('admin/pages')?>">Trang</a></li>
							<li class="<?php if ($suffix_uri == 'videos') echo 'active'?>"><a href="<?=base_url('admin/videos')?>">Videos</a></li>
						</ul>
					</div>
				</li>
				
				<li class="<?php if (($suffix_uri == 'products') or ($suffix_uri == 'productscategory')) echo 'active';?>">
					<a data-toggle="collapse" href="#products">
						<i class="pe-7s-joy"></i>
						<p>Sản phẩm
						   <b class="caret"></b>
						</p>
					</a>
					<div class="collapse <?php if (($suffix_uri == 'products') or ($suffix_uri == 'productscategory') or ($suffix_uri == 'videos')) echo 'in';?>" id="products">
						<ul class="nav">
							<li class="<?php if ($suffix_uri == 'productscategory') echo 'active'?>"><a href="<?=base_url('admin/productscategory')?>">Danh mục sản phẩm</a></li>
							<li class="<?php if ($suffix_uri == 'products') echo 'active'?>"><a href="<?=base_url('admin/products')?>">Tất cả sản phẩm</a></li>
						</ul>
					</div>
				</li>
				
				<li class="<?php if (($suffix_uri == 'brands')) echo 'active';?>">
					<a href="<?=base_url('admin/brands')?>">
						<i class="pe-7s-shopbag"></i>
						<p>Nhãn hiệu</p>
					</a>
				</li>
				
				<!--<li class="<?php if (($suffix_uri == 'comments')) echo 'active';?>">
					<a href="<?=base_url('admin/comments')?>">
						<i class="pe-7s-comment"></i>
						<p>Quản lý bình luận</p>
					</a>
				</li>-->
				
				<li class="<?php if (($suffix_uri == 'tags')) echo 'active';?>">
					<a href="<?=base_url('admin/tags')?>">
						<i class="pe-7s-way"></i>
						<p>Tags</p>
					</a>
				</li>
				
				<li class="<?php if (($suffix_uri == 'orders')) echo 'active';?>">
					<a href="<?=base_url('admin/orders')?>">
						<i class="pe-7s-note2"></i>
						<p>Đơn hàng</p>
					</a>
				</li>
				
				<?php if ($all_user_data['admingroup'] == 'admin') {?>
				<li class="<?php if (($suffix_uri == 'customers')) echo 'active';?>">
					<a href="<?=base_url('admin/customers')?>">
						<i class="pe-7s-users"></i>
						<p>Khách hàng</p>
					</a>
				</li>
				<?php } ?>
				
				<li class="<?php if (($suffix_uri == 'options') or ($suffix_uri == 'sliders') or ($suffix_uri == 'menus') or ($suffix_uri == 'configs')) echo 'active';?>">
					<a data-toggle="collapse" href="#mapsExamples">
						<i class="pe-7s-map-marker"></i>
						<p>Cài đặt
						   <b class="caret"></b>
						</p>
					</a>
					<div class="collapse <?php if (($suffix_uri == 'options') or ($suffix_uri == 'sliders') or  ($suffix_uri == 'menus') or  ($suffix_uri == 'configs')) echo 'in';?>" id="mapsExamples">
						<ul class="nav">
							<li class="<?php if ($suffix_uri == 'menus') echo 'active'?>"><a href="<?=base_url('admin/menus')?>">Menu</a></li>
							<li class="<?php if ($suffix_uri == 'options') echo 'active'?>"><a href="<?=base_url('admin/options')?>">Tùy chỉnh</a></li>
							<li class="<?php if ($suffix_uri == 'configs') echo 'active'?>"><a href="<?=base_url('admin/configs')?>">Hiển thị</a></li>
							<li class="<?php if ($suffix_uri == 'sliders') echo 'active'?>"><a href="<?=base_url('admin/sliders')?>">Slider</a></li>
						</ul>
					</div>
				</li>
				<?php if ($all_user_data['admingroup'] == 'admin') {?>
				<li class="<?php if (($suffix_uri == 'admins')) echo 'active';?>">
					<a href="<?=base_url('admin/admins')?>">
						<i class="pe-7s-light"></i>
						<p>Danh sách quản trị viên</p>
					</a>
				</li>
				<?php } ?>
				<li>
					<a href="#">
						<i class="pe-7s-graph1"></i>
						<p>Khác</p>
					</a>
				</li>
				<li>
					<br><br>
				</li>
			</ul>
			<?php //} ?>
		</div>
		<div class="sidebar-background" style="background-image: url('/assets/img/full-screen-image-3.jpg') "></div>
	</div>

	<div class="main-panel ps-container ps-theme-default ps-active-y" id="content-scroll">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"></a>
				</div>
				<div class="collapse navbar-collapse">

					<form class="navbar-form navbar-left navbar-search-form" role="search">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input type="text" value="" class="form-control" placeholder="Search...">
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="<?=site_url()?>" target="_blank">
								<i class="fa fa-home"></i>
								<p>Xem trang</p>
							</a>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-gavel"></i>
								<p class="hidden-md hidden-lg">
									Actions
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?=base_url('admin/products/add')?>">Tạo sản phẩm mới</a></li>
								<li><a href="<?=base_url('admin/news/add')?>">Tạo bài viết mới</a></li>
								<li><a href="<?=base_url('admin/pages/add')?>">Tạo trang mới</a></li>
								<li class="divider"></li>
								<li><a href="#">Another Action</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<!--<span class="notification">5</span>-->
								<p class="hidden-md hidden-lg">
									Notifications
									<b class="caret"></b>
								</p>
							</a>
							<!--<ul class="dropdown-menu">
								<li><a href="#">Notification 1</a></li>
								<li><a href="#">Notification 2</a></li>
								<li><a href="#">Notification 3</a></li>
								<li><a href="#">Notification 4</a></li>
								<li><a href="#">Another notification</a></li>
							</ul>-->
						</li>

						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-list"></i>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="#">
										<i class="pe-7s-mail"></i> Messages
									</a>
								</li>
								<li>
									<a href="#">
										<i class="pe-7s-help1"></i> Help Center
									</a>
								</li>
								<li>
									<a href="#">
										<i class="pe-7s-tools"></i> Settings
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="#">
										<i class="pe-7s-lock"></i> Lock Screen
									</a>
								</li>
								<li>
									<a href="<?=base_url('admin/logout')?>" class="text-danger">
										<i class="pe-7s-close-circle"></i>
										Log out
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>
