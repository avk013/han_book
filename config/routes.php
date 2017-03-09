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

$route['default_controller'] = 'main';
$route['404_override'] = '';

$route['signup'] = "in_progress";
$route['login'] = "in_progress";
$route['feedback'] = "in_progress";

$route['user/profile'] = "in_progress";
$route['user/listings'] = "in_progress";

$route['booking'] = "booking";


/************ AUTH ************/
$route['user/sign-up'] = "user/auth/sign_up";
$route['user/login'] = "user/auth/login";
$route['user/logout'] = "user/auth/logout";
$route['user/confirm'] = "user/auth/confirm";
$route['user/forgot-password'] = "user/auth/forgot_password";
$route['user/reset-password'] = "user/auth/reset_password";

$route['admin'] = "admin/login";
$route['admin/access-denied'] = "admin/access_denied";

$route['admin/date-status-request'] = "admin/date_status_request";

if (file_exists(BASEPATH . '/../application/config/seo_routes/seo_routes.php')) {
    include ('seo_routes/seo_routes.php');
}
/* End of file routes.php */
/* Location: ./application/config/routes.php */
