<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
// if(active_group == 'default'):
//      $hook['display_override'][] = array(
//     	'class'  	=> 'Develbar',
//         'function' 	=> 'debug',
//         'filename' 	=> 'Develbar.php',
//         'filepath' 	=> 'third_party/DevelBar/hooks'
//     );        
// endif;
$hook['display_override'][] = array(
    'class' => 'Minifyhtml',
    'function' => 'output',
    'filename' => 'Minifyhtml.php',
    'filepath' => 'hooks',
    'params' => array()
);                                            
                                               


// $hook['pre_controller'] = array(
// 'class' => 'Tool',
// 'function' => 'init',
// 'filename' => 'Tool.php',
// 'filepath' => 'third_party/MX',
// 'params' => '');