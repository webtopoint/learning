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
|	http://codeigniter.com/user_guide/general/routing.html
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


$route['404_override'] = 'errors/page_missing';
//get_instance()->uri->segment(1,0) == 'admin';

if(host == MAIN_DOMAIN OR defined('active_group_force')){
    $controller = 'web';
    // exit($controller);
    $route['default_controller'] = $controller;
    $route['translate_uri_dashes'] = defined('RID') ? true : false;
    $route['domain-checker'] = "$controller/domain_checker";
    $route['login'] = "$controller/login";
    $route['register'] = "$controller/register";
    $route['checkout'] = "$controller/checkout";
    $route['page/(:any)'] = "page/show/$1";
    $route['customer-login'] = $controller.'/customer_login';
    $route['Web-admin-login'] = $controller.'/customer_login';
    $route['login'] = 'web/login';
    // exit(1);
}
else{
    
    $route['default_controller'] = 'home/'.controllerDefault;
    $route['customer-login'] = 'home/customer_login';
    $route['404_override'] = 'front/error';
    $route['translate_uri_dashes'] = TRUE;
    $route['web/(:any)/(:any)']		                        =	'home/index/$1';
    $route['admin-login']                                   =   'Home/admin_login';
    $route['admin/Menu-section']                            =   'admin/menu_section';
    $route['admin/Add-Page']	                            =	'admin/add_page';
    $route['admin/list-pages']	                            =	'admin/list_pages';
    $route['admin/add-page-content/(:any)']	                =	'admin/add_page_content/$1';
    $route['admin/image-gallery']	                        =	'admin/image_gallery';
    $route['admin/product-gallery']	                        =	'admin/product_gallery';
    $route['Admin/image-gallery/(:any)/view-images'] = $route['admin/image-gallery/(:any)/view-images']	    =	'admin/view_images/$1';
    $route['Admin/product-gallery/(:any)/view-products'] =$route['admin/product-gallery/(:any)/view-products']	=	'admin/view_products/$1/$1';
    $route['Admin/video-gallery/(:any)/view-videos'] =  $route['admin/video-gallery/(:any)/view-videos']	    =	'admin/view_videos/$1';
    $route['Admin/product-gallery/(:any)/edit-product']	 =$route['admin/product-gallery/(:any)/edit-product']	    =	'admin/edit_product/$1';
    $route['admin/theme-setting']                           =   'admin/theme_setting';
    $route['admin/add-widget']                              =   'admin/add_widget';
    $route['admin/use-widget']                              =   'admin/use_widget';
    $route['admin/modify-widget/(:any)']                    =   'admin/modify_widget/$1';
    $route['admin/form-data/(:any)']                        =   'admin/form_data_by_id/$1';
    $route['admin/Change-password']                         =   'admin/change_password';
    $route['admin/Utilities/social']                        =   'admin/utility_social';
    $route['admin/Utilities/marquee']                       =   'admin/utility_marquee';
    $route['Admin/service/(:any)']  =   $route['admin/service/(:any)']                          =   'admin/manage-file-service/$1';
    $route['Home/payu-transaction-response']                =   'Home/payu_transaction_response';
    $route['landingpage']           =   'Home/landpage';
    $route['admin/website_setting'] = 'admin/website-setting';
    
    $route['category/(:any)']                               =   'Home/category/$1';
    $route['category/(:any)/(:num)']                               =   'Home/category/$1/$2';
    
    $route['post/(:any)/(:any)/(:any)'] 							=	'Home/newPost/$1/$2/$3';

}
