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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route[API_PREFIX . 'default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route[API_PREFIX . '404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route[API_PREFIX . 'translate_uri_dashes'] = FALSE;
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
    
const API_PREFIX = 'api/v1';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/** Default endpoint from Yana */
$route[API_PREFIX . '/conversations']['post'] = 'conversation/get_conversations';

$route[API_PREFIX . '/auth/login']['post'] = 'auth/login';
$route[API_PREFIX . '/auth/logout']['get'] = 'auth/logout';

$route[API_PREFIX . '/users']['get'] = 'user/index';
$route[API_PREFIX . '/users']['post'] = 'user/create';
$route[API_PREFIX . '/users/(:num)']['put'] = 'user/update/$1';
$route[API_PREFIX . '/users/(:num)']['delete'] = 'user/delete/$1';
$route[API_PREFIX . '/users/(:num)']['get'] = 'user/get/$1';


$route[API_PREFIX . '/activities']['get'] = 'userActivity/index';
$route[API_PREFIX . '/activities']['post'] = 'userActivity/create';
$route[API_PREFIX . '/activities/(:num)']['put'] = 'userActivity/update/$1';
$route[API_PREFIX . '/activities/(:num)']['delete'] = 'userActivity/delete/$1';
$route[API_PREFIX . '/activities/(:num)']['get'] = 'userActivity/get/$1';

$route[API_PREFIX . '/users/(:num)/activities']['get'] = 'userActivity/activities/$1';
$route[API_PREFIX . '/users/(:num)/activities/(:any)']['get'] = 'userActivity/activitiesById/$1/$2';

