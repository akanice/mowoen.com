		<header id="header" class="header header-style1" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<div class="wrap-main container">
				<a class="logo " title="Về trang chủ <?=@base_url()?>" href="/" aria-label="logo">
					<i class="icontgdd-logo"></i>
				</a>
				<form id="search-site" action="/tim-kiem" method="get" autocomplete="off">
					<input class="topinput" id="search-keyword" name="key" type="text" aria-label="Bạn tìm gì..." placeholder="Bạn tìm gì..." autocomplete="off" onkeyup="SuggestSearch(event,this, 0);" maxlength="50">
					<button class="btntop" type="submit" aria-label="tìm kiếm"><i class="icontgdd-topsearch"></i></button>
				</form>
				<nav>
					<a href="/dtdd" class="mobile" title="Điện thoại di động, smartphone">
						<i class="icontgdd-mobile"></i>Điện thoại
					</a>
					<a href="/may-tinh-bang" class="tablet" title="Máy tính bảng, tablet">
						<i class="icontgdd-tablet"></i>Tablet
					</a>
					<a href="/laptop" class="laptop" title="Máy tính xách tay, Laptop">
						<i class="icontgdd-laptop"></i>Laptop
					</a>
					<a href="/phu-kien" class="phukien" title="Phụ kiện điện thoại di động, phụ kiện tablet, phụ kiện lapto">
						<i class="icontgdd-phukien"></i>Phụ kiện
					</a>
					<a href="/dong-ho" class="smartwatch" title="Đồng hồ">
						<i class="icontgdd-watch"></i>Đồng hồ
					</a>
					<a href="/may-doi-tra" class="maydoitra" title="Máy cũ giá rẻ, máy đổi trả thegioididong">
						<i class="icontgdd-maydoitra"></i><span>Máy</span>Cũ giá rẻ
					</a>

					<a href="/tin-tuc" class="news" title="24h công nghệ">
						<i class="icontgdd-news"></i>Công Nghệ
					</a>
					<a href="/hoi-dap" class="ask" title="Hỏi đáp">
						<i class="icontgdd-ask"></i>Hỏi đáp
					</a>

					<a href="/game-app" class="gameapp" title="Game app">
						<i class="icontgdd-gameapp"></i>Game App
					</a>
				</nav>
			</div>
			<div class="clr"></div>
			<!--<div class="header-top">
				<div class="container">
					<div class="top-header">
						<div class="widget nav_menu-2 widget_nav_menu pull-right">
							<div class="widget-inner">
								<h3><i class="fa fa-user"></i><span>Tài khoản</span></h3>
								<ul id="menu-my-account" class="menu">
									<li class="menu-cart"><a class="item-link" href="#"><span class="menu-title">Giỏ hàng</span></a></li>
									<li class="menu-checkout"><a class="item-link" href="#"><span class="menu-title">Thanh toán</span></a></li>
									<li class="menu-my-account"><a class="item-link" href="#"><span class="menu-title">Quản lý tài khoản</span></a></li>
								</ul>
							</div>
						</div>
						<div class="widget sw_top-2 sw_top pull-right">
							<div class="widget-inner">
								<div class="top-login">
									<ul>
										<li>
											<a href="javascript:void(0);" data-toggle="modal" data-target="#login_form"><i class="fa fa-sign-in-alt"></i><span>Đăng nhập</span></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="widget text-3 widget_text pull-left">
							<div class="widget-inner">
								<div class="textwidget">
									<div class="header-message">
										<b>Hotline:</b> <a href="tel:0906.668.078">0906.668.078</a> - <b>Giao hàng 24/7</b>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			
			<!--<div class="header-mid">
				<div class="container">
					<div class="row">
						<!-- Logo 
						<div class="top-header col-lg-2 col-md-2 pull-left">
							<div class="revo-logo">
								<a href="<?=site_url()?>">
									<img src="<?=base_url('assets/img/logo_main.png')?>" alt="Myaca logo">
								</a>
							</div>
						</div>
						<!-- Primary navbar 
						<div id="main-menu" class="main-menu clearfix col-lg-10 col-md-10 pull-right">
							<nav id="primary-menu" class="primary-menu">
								<div class="mid-header clearfix">
									<div class="navbar-inner navbar-inverse">
										<div class="resmenu-container"><button class="navbar-toggle bt_menusb" type="button" data-target="#ResMenuSB">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button></div>
										<?php 
										$this->menusmodel->setup_navmenu();
										$this->multi_menu->set_items($navmenu);
										echo $this->multi_menu->render(); ?>
										<!--<ul id="menu-primary-menu-1" class="nav nav-pills nav-mega revo-mega">
											<li class="active  menu-home revo-mega-menu"><a href="#" class="item-link"><span class="have-title"><span class="menu-title">Trang chủ</span></span></a></li>
											<li class="dropdown menu-vendors level1"><a href="#" class="item-link dropdown-toggle" data-toogle="dropdown"><span class="have-title"><span class="menu-title">Các loại bánh</span></span></a>
												<ul class="dropdown-menu">
													<li class="column-1"><a href="#"><span class="have-title"><span class="menu-title">Bánh cưới</span></span></a></li>
													<li class="column-1"><a href="#"><span class="have-title"><span class="menu-title">Bánh sinh nhật</span></span></a></li>
													<li class="column-1"><a href="#"><span class="have-title"><span class="menu-title">Bánh tiệc</span></span></a></li>
												</ul>
											</li>
											<li class="dropdown level1"><a href="#" class="item-link"><span class="have-title"><span class="menu-title">Khuyến mãi</span></span></a></li>											
											<li class="dropdown level1"><a href="#" class="item-link"><span class="have-title"><span class="menu-title">Công thức làm bánh</span></span></a></li>											
											<li class="dropdown level1"><a href="#" class="item-link"><span class="have-title"><span class="menu-title">Về MyacaBakery</span></span></a></li>											
											<li class="dropdown level1"><a href="#" class="item-link"><span class="have-title"><span class="menu-title">Cửa hàng</span></span></a></li>
										</ul>
									</div>
								</div>
							</nav>
						</div>
						
						<div class="sticky-cart pull-right">
							<div class="top-form top-form-minicart revo-minicart pull-right">
								<div class="top-minicart-icon pull-right">
									<a class="cart-contents" href="#" title="View your shopping cart"><span class="minicart-number">0</span></a>
								</div>
								<div class="wrapp-minicart">
									<div class="minicart-padding">
										<div class="number-item">Hiện có <span class="item"><?php echo $this->cart->total_items();?> sản phẩm</span> trong giỏ hàng</div>
										<ul class="minicart-content">
											<table class="table table-striped">
												<tbody id="detail_cart" class="detail_cart">
													<?php if($global_cart) foreach($global_cart as $item) {?>
													<tr>
														<td><?=$item['name']?></td>
														<td><?=$item['qty']?></td>
														<td><button type="button" id="<?=$item['rowid']?>" class="remove_cart btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Xóa</button></td>
													</tr>
													<?php } ?>
													<tr>
														<th colspan="2">Tổng cộng</th>
														<th><?=number_format($this->cart->total())?> đ</th>
													</tr>
												</tbody>
											</table>
										</ul>
										<div class="cart-checkout">
											<div class="cart-links clearfix">
												<div class="checkout-link"><a href="<?=base_url('dat-hang');?>" title="Check Out">Thanh toán</a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="sticky-search pull-right">
							<i class="fa fa-search"></i>
							<div class="sticky-search-content">
								<div class="top-form top-search">
									<div class="topsearch-entry">
										<form method="get" id="searchform_special" action="#">
											<div>
												<div class="cat-wrapper">
													<label class="label-search">
														<select name="category" class="s1_option category-selection">
															<option value="">Tất cả danh mục</option>
															<?php foreach ($listcategories as $item) { ?>
															<option value="<?=@$item->id?>"><?=@$item->title?></option>
															<?php } ?>
														</select>
													</label>
												</div>
												<input type="text" value="" name="s" id="s" placeholder="Enter your keyword...">
												<button type="submit" title="Search" class="fa fa-search button-search-pro form-button"></button>
												<input type="hidden" name="search_posttype" value="product">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			
			<div class="header-bottom" id="header-bottom">
				<div class="container">
					<div class="clearfix">
						<div class="col-hotline">
							Hotline: 0123456789 / 0123456789
						</div>
						<div class="col-features">
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-2 col-2 vertical_megamenu vertical_megamenu-header pull-left">
									<div class="mega-left-title"><strong></strong></div>
									<div class="vc_wp_custommenu wpb_content_element">
										<div class="wrapper_vertical_menu vertical_megamenu" data-number="9" data-moretext="See More" data-lesstext="See Less">
											<div class="resmenu-container">
												<button class="navbar-toggle bt_menusb" type="button" data-target="#ResMenuSB">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="search-cate col-lg-7 col-md-6 col-sm-7 col-8">
									<div class="widget-1 widget-first widget sw_ajax_woocommerce_search-6 sw_ajax_woocommerce_search">
										<div class="widget-inner">
											<div class="revo_top swsearch-wrapper clearfix">
												<div class="top-form top-search ">
													<div class="topsearch-entry">
														<form method="GET" action="<?=base_url('/tim-kiem/')?>">
															<div id="sw_woo_search_1" class="search input-group">
																<div class="cat-wrapper">
																	<label class="label-search">
																		<select name="category" class="s1_option category-selection">
																			<option value="">Tất cả danh mục</option>
																			<?php foreach ($listcategories as $item) { ?>
																			<option value="<?=@$item->id?>" <?php if(@$category==$item->id){echo 'selected="selected" ';}?>><?=@$item->title?></option>
																			<?php } ?>
																		</select>
																	</label>
																</div>
																<div class="content-search">
																	<input class="autosearch-input" type="text" value="<?=@$name?>" size="50" autocomplete="off" placeholder="Gõ từ khóa..." name="name">
																</div>
																<span class="input-group-btn">
																	<button type="submit" class="fa fa-search button-search-pro form-button"></button>
																</span>
																
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="header-right col-lg-2 col-md-2 col-sm-3 col-2 pull-right">
									<div class="widget sw_top-6 sw_top pull-right">
										<div class="widget-inner">
											<div class="top-form top-form-minicart revo-minicart pull-right">
												<div class="top-minicart-icon pull-right">
													<a class="cart-contents" href="#" title="View your shopping cart"><i class="fa fa-shopping-cart"></i><span class="minicart-number">0</span></a>
												</div>
												<div class="wrapp-minicart">
													<div class="minicart-padding">
														<div class="number-item">Hiện có <span class="item"><?php echo $this->cart->total_items();?> sản phẩm</span> trong giỏ hàng</div>
														<ul class="minicart-content">
															<table class="table table-striped">
																<tbody id="detail_cart" class="detail_cart">
																	<?php if($global_cart) foreach($global_cart as $item) {?>
																	<tr>
																		<td><?=$item['name']?></td>
																		<td><?=$item['qty']?></td>
																		<td><button type="button" id="<?=$item['rowid']?>" class="remove_cart btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Xóa</button></td>
																	</tr>
																	<?php } ?>
																	<tr>
																		<th colspan="2">Tổng cộng</th>
																		<th><?=number_format($this->cart->total())?> đ</th>
																	</tr>
																</tbody>
															</table>
														</ul>
														<div class="cart-checkout">
															<div class="cart-links clearfix">
																<!--<div class="cart-link"><a href="#" title="Cart">Xem giỏ hàng</a></div>-->
																<div class="checkout-link"><a href="<?=base_url('dat-hang');?>" title="Check Out">Thanh toán</a></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>