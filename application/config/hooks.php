<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

// Hook de autenticación centralizado
$hook['post_controller_constructor'][] = array(
    'class'    => 'Auth_check',
    'function' => 'check_auth',
    'filename' => 'auth_check.php',
    'filepath' => 'hooks'
);

// Hook para verificar usuarios ya logueados
$hook['pre_controller'][] = array(
    'class'    => 'Auth_check',
    'function' => 'check_already_logged',
    'filename' => 'auth_check.php',
    'filepath' => 'hooks'
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */