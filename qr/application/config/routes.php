<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller']				= "home";

// echo $route['default_controller'];die();
$route['404_override']						= 'override_404';
$route['seo/sitemap\.xml']					= "seo/sitemap";
$route['translate_uri_dashes']				= FALSE;

// Ajax function
$route['ajax/add_to_cart']					=	"ajax/add_to_cart";
$route['ajax/show_cart']					=	"ajax/show_cart";
$route['ajax/delete_cart']					=	"ajax/delete_cart";

// Front-end routes
// Bathroom route
$route['product/(:any)']					=	"products/getQR/$1";
$route['dang-ky-thanh-cong']         	 	=	"products/form_success";

$route['blog']								= 	"posts/index";
$route['blog/(:num)']						= 	"posts/index/$1";
$route['chuyen-muc/(:any)']				    =	"posts/cat/$1";
$route['chuyen-muc/(:any)/(:num)']			=	"posts/cat/$1/$2";
$route['(:any)'] 							= 	"posts/view/$1";