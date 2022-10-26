<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller']				= "home";
$route['404_override']						= 'override_404';
$route['seo/sitemap\.xml']					= "seo/sitemap";
$route['translate_uri_dashes']				= FALSE;

// Admin Control Panel
$route['admin/login']						=	'admin/main/loginAdmin';
$route['admin/logout']						=	'admin/main/logoutAdmin';
$route['admin']								=	'admin/admin/index';
$route['admin/admins/(:num)']				= 	'admin/admins/index/$1';
$route['admin/users/(:num)']				=	'admin/users/index/$1';
$route['admin/news/(:num)']             	=	'admin/news/index/$1';
$route['admin/newscategory/(:num)']			=	'admin/newscategory/index/$1';
$route['admin/landingpage/(:num)']			=	'admin/landingpage/index/$1';
$route['admin/brands/(:num)']				=	'admin/brands/index/$1';
$route['admin/productscategory/(:num)']		=	'admin/productscategory/index/$1';
$route['admin/products/(:num)']				=	'admin/products/index/$1';
$route['admin/qrcodes/(:num)']				=	'admin/qrcodes/index/$1';
$route['admin/warranty/(:num)']				=	'admin/warranty/index/$1';
$route['admin/pages/(:num)']				=	'admin/pages/index/$1';
$route['admin/posts/(:num)']				=	'admin/posts/index/$1';
$route['admin/postscategory/(:num)']		=	'admin/postscategory/index/$1';
$route['admin/orders/(:num)']				=	'admin/orders/index/$1';
$route['admin/customers/(:num)']		    =	'admin/customers/index/$1';
$route['admin/options/(:num)']          	=	'admin/options/index/$1';
$route['admin/sliders/(:num)']          	=	'admin/sliders/index/$1';
$route['admin/tags/(:num)']					=	'admin/tags/index/$1';
$route['admin/profiles/(:num)']				=	'admin/profiles/index/$1';
$route['admin/widget/(:num)']				=	'admin/widget/$1';
$route['admin/menus']						=	'admin/menus/index/$1';
$route['admin/configs']						=	'admin/configs/index/$1';
$route['admin/access_denied']               =	'admin/main/access_denied';

$route['admin/affiliate/statistic']         =	'admin/affiliate/statistic';
$route['admin/affiliate/users']             =	'admin/affiliate/users';

$route['search/page/(:num)']				=	"news/news_search/$1";

// Ajax function
$route['ajax/add_to_cart']					=	"ajax/add_to_cart";
$route['ajax/show_cart']					=	"ajax/show_cart";
$route['ajax/delete_cart']					=	"ajax/delete_cart";
$route['products/homeDisplayProducts']		=	"products/homeDisplayProducts";
$route['admin/ajax/filterProduct']			=	"admin/ajax/filterProduct";

// Front-end routes
// Bathroom route
$route['bathroom']							=	"products/index";
$route['bathroom/(:any)']					=	"products/get_post_type/$1";
$route['bathroom/(:any)/(:num)']			=	"products/get_post_type/$1/$2";
$route['bathroom/(:any)/(:any)']			=	"products/get_post_data/$1/$2";

// Kitchen route
$route['kitchen']							=	"products/index";
$route['kitchen/(:any)']					=	"products/get_post_type/$1";
$route['kitchen/(:any)/(:num)']				=	"products/get_post_type/$1/$2";
$route['kitchen/(:any)/(:any)']				=	"products/get_post_data/$1/$2";

$route['news']								= 	"news/index";
$route['cat/(:any)']						=	"news/cat/$1";
$route['cat/(:any)/(:num)']					=	"news/cat/$1/$2";
$route['post/(:any)'] 						= 	"news/view/$1";

$route['san-pham/(:any)']					=	"products/viewProduct/$1";
$route['tim-kiem']                 			=	"products/product_search";
$route['tim-kiem/(:num)']         	 		=	"products/product_search/$1";
$route['dat-hang']         	 				=	"cart/index";
$route['cart/del']         	 				=	"cart/del";
$route['cart/update']         	 			=	"cart/update";
$route['thanh-toan']         	 			=	"order/checkout";
$route['success']         	 				=	"cart/success";

$route['dai-ly']         	 				=	"posts/static/agent";
$route['dang-ky-thanh-cong']         	 	=	"admin/customers/form_success";

$route['blog']								= 	"posts/index";
$route['blog/(:num)']						= 	"posts/index/$1";
$route['chuyen-muc/(:any)']				    =	"posts/cat/$1";
$route['chuyen-muc/(:any)/(:num)']			=	"posts/cat/$1/$2";
$route['(:any)'] 							= 	"posts/view/$1";