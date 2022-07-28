	<div class="boutique-notice-block">
		<div class="container">
			<div class="row">
				<div class="col-sm-6"> <a href="#" style="margin-right: 25px;"><span class="text"><i class="fas fa-phone-volume" style="margin-right: 7px;"></i>Gọi chúng tôi: <span><?=@$home_hotline?></span></span></a> <a href="#"><span class="text"><i class="far fa-envelope" style="margin-right: 7px;"></i>Email: info@mowoen.com</span></a></div>
				<div class="col-sm-6 text-sm-right"> <span>Liên hệ:</span> <span class="header-social-icons"> <a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a> <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a> <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a> <a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a> <a href="https://www.youtube.com"><i class="fab fa-youtube"></i></a> </span></div>
			</div>
		</div>
	</div>

	<header class="page-header type10">
		<div class="header-main">
			<div class="container">
				<div class="header-main-wrapper">
					<div class="logo-wrapper"> <strong class="logo"> 
						<a href="<?=base_url('')?>"><img class="sticky-logo" src="/assets/img/mowoen-logo.png" alt=""> <img class="default-logo" src="/assets/img/mowoen-logo.jpg" alt=""> </a></strong></div>
					<div class="header-right">
						<div class="menu-wrapper"> <span data-action="toggle-nav" class="action nav-toggle"><span></span></span>
							<div class="sections nav-sections">
								<div class="section-items nav-sections-items" role="tablist">
									<div class="section-item-title nav-sections-item-title active" data-role="collapsible" role="tab" data-collapsible="true" aria-controls="store.menu" aria-selected="false" aria-expanded="true" tabindex="0"> 
										<a class="nav-sections-item-switch" data-toggle="switch" href="#store.menu"> Menu </a>
									</div>
									<div class="section-item-content nav-sections-item-content" id="store.menu" data-role="content" role="tabpanel" aria-hidden="false">
										<nav class="navigation skynetch-megamenu" role="navigation">
											<ul>
												<!-- <li class="ui-menu-item level0 fullwidth staticwidth parent" id="nav_menu_shop">
													<div class="open-children-toggle"></div> <a href="<?=base_url('bathroom')?>" class="level-top"><span>Nhà tắm</span></a>
													<div class="level0 submenu" style="">
														<div class="container">
															<div class="row">
																<ul class="subchildmenu col-sm-12 mega-columns columns1">
																	<li class="ui-menu-item level1 parent">
																		<div class="open-children-toggle"></div> <a href="<?=base_url('bathroom/products')?>"><span>Sản phẩm</span></a>
																	</li>
																</ul>
																<ul class="subchildmenu col-sm-12 mega-columns columns3">
																	<li class="ui-menu-item level1 parent">
																		<ul class="subchildmenu">
																			<li class="ui-menu-item level2"><a href="<?=base_url('bathroom/products?cat_id=48')?>"><span>Bồn tắm</span></a></li>
																			<li class="ui-menu-item level2"><a href="<?=base_url('bathroom/products?cat_id=49')?>"><span>Tủ chậu phòng tắm</span></a></li>
																			<li class="ui-menu-item level2"><a href="<?=base_url('bathroom/products?cat_id=52')?>"><span>Sen vòi bồn tắm</span></a></li>
																		</ul>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li> -->
												<li class="ui-menu-item level0 classic parent">
													<div class="open-children-toggle"></div> <a href="<?=base_url('bathroom')?>" class="level-top"><span>Nhà tắm</span></a>
													<div class="level0 submenu">
														<div class="row">
															<ul class="subchildmenu">
																<li class="ui-menu-item level1 bold"><a href="<?=base_url('bathroom/products')?>"><span>Sản phẩm</span></a></li>
																<?php foreach ($bathroom_cat as $item) {?>
																	<li><a href="<?=base_url('bathroom/products?cat_id='.$item->id)?>"><?=$item->title?></a></li>
																<?php } ?>
																<li class="ui-menu-item level1 bold"><a href="#"><span>Cảm hứng thiết kế</span></a></li>
																<li class="ui-menu-item level1 bold"><a href="#"><span>Hướng dẫn sử dụng</span></a></li>
															</ul>
														</div>
													</div>
												</li>
												<li class="ui-menu-item level0 classic parent">
													<div class="open-children-toggle"></div> <a href="<?=base_url('kitchen')?>" class="level-top"><span>Nhà bếp</span></a>
													<div class="level0 submenu">
														<div class="row">
															<ul class="subchildmenu">
																<li class="ui-menu-item level1 bold"><a href="<?=base_url('kitchen/products')?>"><span>Sản phẩm</span></a></li>
																<?php foreach ($kitchen_cat as $item) {?>
																	<li><a href="<?=base_url('kitchen/products?cat_id='.$item->id)?>"><?=$item->title?></a></li>
																<?php } ?>
																<li class="ui-menu-item level1 bold"><a href="#"><span>Cảm hứng thiết kế</span></a></li>
																<li class="ui-menu-item level1 bold"><a href="#"><span>Hướng dẫn sử dụng</span></a></li>
															</ul>
														</div>
													</div>
												</li>
												<li class="ui-menu-item level0 classic parent">
													<div class="open-children-toggle"></div> <a href="#" class="level-top"><span>Dịch vụ</span></a>
													<div class="level0 submenu">
														<div class="row">
															<ul class="subchildmenu">
																<li class="ui-menu-item level1"><a href="#"><span>Chính sách bảo hành</span></a></li>
																<li class="ui-menu-item level1"><a href="#"><span>Lắp đặt tận nhà</span></a></li>
															</ul>
														</div>
													</div>
												</li>
												<li class="ui-menu-item level0 classic parent">
													<div class="open-children-toggle"></div> <a href="#" class="level-top"><span>Về Mowoen</span></a>
													<div class="level0 submenu">
														<div class="row">
															<ul class="subchildmenu">
																<li class="ui-menu-item level1"><a href="#"><span>Giới thiệu</span></a></li>
															</ul>
														</div>
													</div>
												</li>
												<!--<li class="ui-menu-item level0"> <a href="#" class="level-top" target="_blank"><span>Purchase</span></a></li>-->
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
						
						<div class="box-search"> <span class="icon fa fa-search"></span>
							<div class="block block-search">
								<div class="block block-title"><strong>Search</strong></div>
								<div class="block block-content">
									<form class="form minisearch" id="search_mini_form" action="<?=base_url('tim-kiem/')?>" method="get">
										<div class="field search"> <label class="label" for="search" data-role="minisearch-label"> <span>Search</span> </label>
											<div class="control"> 
												<input id="search" type="text" name="name" value="" placeholder="Search here..." class="input-text" maxlength="128" role="combobox" aria-haspopup="false" aria-autocomplete="both" autocomplete="off">
											</div>
										</div>
										<div class="actions"> <button type="submit" title="Search" class="action search"> <i class="icon fa fa-search"></i> <span>Tìm kiếm</span> </button></div>
									</form>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</header>