<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']								= "home";
$route['404_override']										= 'override_404';
$route['seo/sitemap\.xml']								= "seo/sitemap";
$route['translate_uri_dashes']						= FALSE;

// Admin Control Panel
$route['admin/login']										=	'admin/main/loginAdmin';
$route['admin/logout']										=	'admin/main/logoutAdmin';
$route['admin']													=	'admin/admin/index';
$route['admin/admins/(:num)']						= 	'admin/admins/index/$1';
$route['admin/users/(:num)']							=	'admin/users/index/$1';
$route['admin/news/(:num)']             				=	'admin/news/index/$1';
// $route['admin/newscategory/setorder/(:num)'] = 'admin/newscategory/setorder/$1';
$route['admin/newscategory/(:num)']			=	'admin/newscategory/index/$1';
$route['admin/landingpage/(:num)']				=	'admin/landingpage/index/$1';
$route['admin/brands/(:num)']							=	'admin/brands/index/$1';
$route['admin/productscategory/(:num)']		=	'admin/productscategory/index/$1';
$route['admin/products/(:num)']						=	'admin/products/index/$1';
$route['admin/pages/(:num)']							=	'admin/pages/index/$1';
$route['admin/orders/(:num)']							=	'admin/orders/index/$1';
$route['admin/customers/(:num)']					=	'admin/customers/index/$1';
$route['admin/comments/(:num)']					=	'admin/comments/index/$1';
$route['admin/options/(:num)']          				=	'admin/options/index/$1';
$route['admin/sliders/(:num)']          				=	'admin/sliders/index/$1';
$route['admin/faqs/(:num)']								=	'admin/faqs/index/$1';
$route['admin/tags/(:num)']								=	'admin/tags/index/$1';
$route['admin/profiles/(:num)']						=	'admin/profiles/index/$1';
$route['admin/widget/(:num)']							=	'admin/widget/$1';
$route['admin/menus']										=	'admin/menus/index/$1';
$route['admin/configs']									=	'admin/configs/index/$1';
$route['admin/combos/(:num)']          				=	'admin/combos/index/$1';
$route['admin/videos/(:num)']          				=   'admin/videos/index/$1';
$route['admin/widget/(:num)']							=	'admin/widget/$1';
$route['admin/access_denied']               		=	'admin/main/access_denied';

$route['admin/affiliate/statistic']               		=	'admin/affiliate/statistic';
$route['admin/affiliate/users']               		    =	'admin/affiliate/users';

$route['search/page/(:num)']							=	"news/news_search/$1";

// Ajax function
$route['ajax/add_to_cart']								=	"ajax/add_to_cart";
$route['ajax/show_cart']									=	"ajax/show_cart";
$route['ajax/delete_cart']									=	"ajax/delete_cart";
$route['products/homeDisplayProducts']		=	"products/homeDisplayProducts";
$route['admin/ajax/filterProduct']					=	"admin/ajax/filterProduct";

// Front-end routes
// Bath route
$route['bath']														=	"products/index";
$route['bath/(:any)']											=	"products/get_post_type/$1";
$route['bath/(:any)/(:num)']								=	"products/get_post_type/$1/$2";
$route['bath/(:any)/(:any)']								=	"products/get_post_data/$1/$2";

// Kitchen route
$route['kitchen']												=	"products/index";
$route['kitchen/(:any)']										=	"products/get_post_type/$1";
$route['kitchen/(:any)/(:num)']							=	"products/get_post_type/$1/$2";
$route['kitchen/(:any)/(:any)']							=	"products/get_post_data/$1/$2";



$route['blog']														= 	"news/home";
$route['chuyen-muc/(:any)']							=	"news/category/$1";
$route['chuyen-muc/(:any)/(:num)']				=	"news/category/$1/$2";
$route['bai-viet/(:any)'] 									= 	"news/index/$1";
$route['videos'] 												= 	"news/videos_item";
$route['videos/(:num)'] 									= 	"news/videos_item/$1";
$route['videos/(:any)'] 										= 	"news/videos_item/$1";

$route['shop'] 													= 	"products/index";
$route['shop/(:num)'] 										= 	"products/index/$1";
$route['danh-muc/(:any)']								=	"products/viewCat/$1";
$route['danh-muc/(:any)/(:num)']					=	"products/viewCat/$1/$2";
$route['brands/(:any)']										=	"products/viewBrands/$1";
$route['brands/(:any)/(:num)']							=	"products/viewBrands/$1/$2";
$route['san-pham/(:any)']								=	"products/viewProduct/$1";
$route['tim-kiem']                 								=	"products/product_search";
$route['tim-kiem/(:num)']         	 						=	"products/product_search/$1";
$route['dat-hang']         	 								=	"cart/index";
$route['cart/del']         	 									=	"cart/del";
$route['cart/update']         	 							=	"cart/update";
$route['thanh-toan']         	 								=	"order/checkout";
$route['success']         	 									=	"cart/success";


// $route['(:any)'] 												= 	"products/viewCat/$1";
// $route['(:any)/(:num)'] 									= 	"products/viewCat/$1/$2";
// $route['(:any)/(:any)'] 										= 	"products/viewProduct/$1/$2";