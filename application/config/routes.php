<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= "public/quote";
$route['service']				= "service/service";
$route['service/(:any)']		= "service/service/$1";
$route['quotes']				= "public/quote/quotes";
$route['quotes/(:any)']			= "public/quote/quotes/$1";

$route['about'] 				= "public/quote/about";
$route['rule'] 					= "public/quote/rule";
$route['post'] 					= "public/quote/post";
$route['simpanPost']			= "public/quote/simpanPost";
$route['userQuote']				= "public/quote/userQuote";
$route['userQuote/(:any)']		= "public/quote/userQuote/$1";
$route['removequote/(:any)']	= "public/quote/removequote/$1";
$route['removequotewm/(:any)']	= "public/quote/removequotewm/$1";
$route['blockquotewm/(:any)']	= "public/quote/blockquote/$1";
$route['activequotewm/(:any)']	= "public/quote/activequotewm/$1";
$route['search']				= "public/quote/search";

# test
$route['tester']				= "public/quote/test";

$route['action']				= "public/quote/action";
$route['action/(:any)']			= "public/quote/action/$1";

$route['profile']				= "public/profile";
$route['changePP']				= "public/profile/changePP";

$route['signup']				= "public/quote/signup";
$route['simpanAkun']			= "public/quote/simpanAkun";
$route['aktivasiAkun']			= "public/quote/aktivasiAkun";
$route['updateakun']			= "public/quote/updateakun";
$route['aktivasiAkun/(:any)']	= "public/quote/aktivasiAkun/$1";
$route['setting/(:any)']		= "public/quote/setting/$1";

$route['resetpassword']			= "public/quote/resetpassword";

$route['login'] 				= "public/login";
$route['logout'] 				= "public/login/logout";

# PENGEMBANG
$route['sharequote']			= "public/developer/framequote";

$route['pengembang']			= "public/developer";
$route['ketentuan']				= "public/developer/ketentuan";
$route['bantuan']				= "public/developer/bantuan";
$route['404_override'] 			= '';

$route['webmaster']						= "admin/webmaster";
$route['webmaster/users']				= "admin/webmaster/users";
$route['blockuser/(:any)']				= "admin/webmaster/blockuser/$1";
$route['activateuser/(:any)']			= "admin/webmaster/activateuser/$1";
$route['deleteuser/(:any)']				= "admin/webmaster/deleteuser/$1";
$route['webmaster/users/(:any)']		= "admin/webmaster/users/$1";
$route['webmaster/quotes']				= "admin/webmaster/quotes";
$route['webmaster/quotes/(:any)']		= "admin/webmaster/quotes/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */