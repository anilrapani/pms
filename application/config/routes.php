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
$route['default_controller'] = 'login';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['pageNotFound'] = "user/pageNotFound";

$route['admin/employee/company/list'] = "admin/employee/companyList";
$route['admin/employee/company/list/(:num)'] = "admin/employee/companyList/$1";
$route['admin/employee/add/company'] = "admin/employee/addCompanyView";
$route['admin/employee/edit/company/(:any)'] = "admin/employee/editCompanyView/$1";

$route['admin/employee/govtprooftype/list'] = "admin/employee/govtProofTypeList";
$route['admin/employee/govtprooftype/list/(:num)'] = "admin/employee/govtProofTypeList/$1";
$route['admin/employee/add/govtprooftype'] = "admin/employee/addGovtProofTypeView";
$route['admin/employee/edit/govtprooftype/(:any)'] = "admin/employee/editGovtProofTypeView/$1";

$route['admin/employee/shift/list'] = "admin/employee/shiftList";
$route['admin/employee/shift/list/(:num)'] = "admin/employee/shiftList/$1";
$route['admin/employee/add/shift'] = "admin/employee/addShiftView";
$route['admin/employee/edit/shift/(:any)'] = "admin/employee/editShiftView/$1";

$route['employee/vehicle/company/list'] = "employee/vehicle/companyList";
$route['employee/vehicle/company/list/(:num)'] = "employee/vehicle/companyList/$1";
$route['employee/vehicle/add/company'] = "employee/vehicle/addCompanyView";
$route['employee/vehicle/edit/company/(:any)'] = "employee/vehicle/editCompanyView/$1";

$route['employee/vehicle/type/list'] = "employee/vehicle/typeList";
$route['employee/vehicle/type/list/(:num)'] = "employee/vehicle/typeList/$1";
$route['employee/vehicle/add/type'] = "employee/vehicle/addTypeView";
$route['employee/vehicle/edit/type/(:any)'] = "employee/vehicle/editTypeView/$1";