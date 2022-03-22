<?php

function isNginx() {
  $server_software = ! empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
  if ( ! empty( $server_software ) ) {
    if(strpos($server_software, 'nginx') !== false
      || strpos($server_software, 'Amazon') !== false
  ){
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

$base1 = $base = '';

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

$script_name = '/';
if ( ! file_exists($_SERVER['SCRIPT_NAME']) ) {
  $script_name = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
}
if ( ! empty($_SERVER['HTTP_HOST']) ) {
  $base = $protocol . '://'.$_SERVER['HTTP_HOST'] . $script_name;
}
$base1 = $base;


if ( isNginx() ) {
  define('PREFIX1', $base1);
} else {
  define('PREFIX1', $base1.'public/');
}


define('PREFIX2', $base1);

define('CSS', $base1.'css/');
define('JS', $base1.'js/');

define('BASE_PATH', $base.'/');
define('PREFIX', $base);
define('PUBLIC_ASSETS', PREFIX1.'assets/');
define('PUBLIC_ASSETS_ADMIN', PREFIX1.'admin/assets');

define('PUBLIC_ASSETS_NEW_ADMIN', PREFIX1.'newadmin/assets/');
define('PUBLIC_PLUGINS_NEW_ADMIN', PREFIX1.'newadmin/plugins/');
define('PUBLIC_JS', PREFIX1.'js/');

define('PUBLIC_PATH_PDF', PREFIX1.'uploads/invoices/');

define('URL_HOME', PREFIX.'home');
define('UPLOADS', PREFIX1.'uploads/');
define('PUBLIC_UPLOADS', PREFIX1.'uploads/default-imgs/arrow-icon.png');


define('IMAGE_PATH_UPLOAD_SPACE_TYPES', PREFIX1. 'uploads/space-types/');
define('IMAGE_PATH_UPLOAD_TESTIMONALS', PREFIX1. 'uploads/testimonials/');
define('IMAGE_PATH_UPLOAD_OURCLIENTS', PREFIX1. 'uploads/ourclients/');
define('IMAGE_PATH_UPLOAD_LISTINGS', PREFIX1. 'uploads/listings/');
define('IMAGE_PATH_UPLOAD_SUB_SPACE_TYPES', PREFIX1.'uploads/sub-space-types/');
define('IMAGE_PATH_UPLOAD_ARTICLES', PREFIX1.'uploads/articles/');
define('IMAGE_PATH_UPLOAD_USERS', PREFIX1. 'uploads/users/');
define('IMAGE_PATH_SETTINGS', UPLOADS.'settings/');
define('LOADER', PREFIX1. 'assets/loader/loader.svg');
define('URL_TRANSLATIONS', PREFIX . 'admin/translations');
define('DEFAULT_IM_PATH', PREFIX1.'uploads/default-imgs/noimfound.png');
define('DEFAULT_USERS_IM_PATH', PREFIX1.'uploads/default-imgs/download.jpeg');
define('DEFAULT_LOGIN_IM_PATH', PREFIX1.'assets/images/coworking-logs/Asset-1.png');
define('DEFAULT_SPACETYPES_PATH', PREFIX1.'uploads/space-types/1.jpg');

define('ADMIN_ROLE_ID', 1);
define('LANDLORD_ROLE_ID', 2);
define('CUSTOMER_ROLE_ID', 3);
define('AGENT_ROLE_ID', 4);

define('ADMIN_TYPE', 1);
define('CUSTOMERS_TYPE', 3);
define('LANDLORD_TYPE', 2);
define('AGENT_TYPE', 4);

define('DEFAULT_CURRENCY_ID', 1); // USD

//SPACE TYPE CONSTANTS
define('SPACE_TYPE_COWORKING', 1);
define('SPACE_TYPE_MEETING_SPACE', 2 );
define('SPACE_TYPE_VIRTUAL_OFFICE', 3);


define('PAYMENT_STATUS_CANCELLED', 'cancelled');
define('PAYMENT_STATUS_SUCCESS', 'success');
define('PAYMENT_STATUS_PENDING', 'pending');
define('PAYMENT_STATUS_ABORTED', 'aborted');
define('PAYMENT_RECORD_MAXTIME', '30'); //TIME IN MINUTES

//SUBSPACE TYPE CONSTANTS
define('SUBSPACE_TYPE_VIRTUAL', 5);
define('SUBSPACE_TYPE_HOT_DESKS', 6 );
define('SUBSPACE_TYPE_DEDICATED_DESKS', 7);
define('SUBSPACE_TYPE_TRAINING_ROOMS', 4);
define('SUBSPACE_TYPE_MEETING_ROOMS', 9);
define('SUBSPACE_TYPE_CONFERENCE_ROOMS', 10);
define('SUBSPACE_TYPE_PRIVATE_ROOMS', 8);



define('PROPERTIES_PER_PAGE', 50);
define('AGENT_PROPERTIES_PER_PAGE', 12);
define('OTP_MAX_SEND', 5);
define('OTP_LENGTH', 4);

define('COLUMNS', 6);
define('URL_SETTINGS_ADD_SUBSETTINGS', PREFIX.'admin/mastersettings/settings/add-sub-settings/');
