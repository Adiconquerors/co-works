<?php

/**
 * [isActive description]
 * @param  string  $active_class [description]
 * @param  string  $value        [description]
 * @return boolean               [description]
 */
function isActive($active_class = '', $value = '')
{
    $value = isset($active_class) ? ($active_class == $value) ? 'active' : '' : '';
    if($value)
        return "class = ".$value;
    return $value;
}

function installDefaultData( $owner_id, $role = '' ) {
  // Payment Gateways.
  $payment_gateways = [];
  require_once(public_path().'/install-scripts/payment_gateways.php');
  if ( ! empty( $payment_gateways ) ) {
    foreach ($payment_gateways as $item) {
      $check = \DB::table('payment_gateways')->where('slug', $item['slug'])->where('owner_id', $owner_id)->first();
      if ( ! $check ) {
        \DB::table('payment_gateways')->insert($item);
      }
    }
  }
}

function getDefaultimgagepath( $image = '', $folder_name = '', $bgimage = ''  )
{
  if( $image && file_exists(public_path("/uploads/".$folder_name."/".$image)))
  {
    return UPLOADS.$folder_name."/".$image;
  }else{
    if( empty(file_exists(public_path("/uploads/settings/".$bgimage))) && $folder_name == 'settings')
    {
      return PUBLIC_ASSETS."images/default-imgs/hp-bgimg.jpg";
    }
    if( $bgimage && file_exists(public_path("/uploads/settings/".$bgimage)) && $folder_name == 'settings')
      {
          return UPLOADS."settings/".$bgimage;
      }
    else{
      return PUBLIC_ASSETS."images/default-imgs/1.jpg";
    }
   }
 }

 function getFaviconSiteLogo( $image = '', $folder_name = '', $site_logo = ''  )
{
  if( $image && file_exists(public_path("/uploads/".$folder_name."/".$image)))
  {
    return UPLOADS.$folder_name."/".$image;
  }else{
     if( empty(file_exists(public_path("/uploads/settings/".$site_logo))) && $folder_name == 'settings')
    {
       return PUBLIC_ASSETS."images/coworking-logs/Asset-1.png";
    }
     if( $site_logo && file_exists(public_path("/uploads/settings/".$site_logo)) && $folder_name == 'settings')
      {
          return UPLOADS."settings/".$site_logo;
      }
      else{
        return PUBLIC_ASSETS."images/coworking-logs/Asset-2.png";
      }
   }

 }


function flash( $type = 'success', $message = '', $info = '' ) {
  if ( empty( $message ) ) {
     switch ( $operation ) {
        case 'create':
          $message = trans( 'custom.messages.record_saved' );
          break;
        case 'restore':
          $message = trans( 'custom.messages.record_restored' );
          break;
        case 'update':
          $message = trans( 'custom.messages.record_updated' );
          break;
        case 'delete':
          $message = trans( 'custom.messages.record_deleted' );
          break;
        case 'deletes':
          $message = trans( 'custom.messages.records_deleted' );
          break;
        case 'crud_disabled':
          $message = trans( 'custom.messages.crud_disabled' );
          break;
        case 'products_transfered':
          $message = trans( 'custom.products-transfer.transfered' );
          break;
        case 'status':
          $message = trans( 'custom.messages.status-changed' );
          break;
        case 'not_allowed':
          $message = trans( 'custom.messages.not-allowed' );
          break;
        default:
          $message = trans( 'custom.messages.record_saved' );
          break;
      }
  }
  session()->flash('status', $type );
  session()->flash('message', $message );
}


function get_google_location( $address, $field = '', $type = '' ){

  $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );

  $url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$google_api_key.'&address=' . str_replace( ' ', '+', $address );

  // sendRequest
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  $body = curl_exec( $ch);
  curl_close( $ch);
  $json = json_decode( $body);

  if ( 'OK' === $json->status ) {
    if ( 'latitude' === $type ) {
      return $json->results[0]->geometry->location->lat;
    } else if ( 'longitude' === $type ) {
      return $json->results[0]->geometry->location->lng;
    } else {
      return null;
    }
  } else {
    return null;
  }
}

function get_google_location_reverse( $address ){

  $google_api_key = getSetting( 'google_api_key', 'google-api-key-settings' );

  $url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$google_api_key.'&address=' . str_replace( ' ', '+', $address );

  // sendRequest
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  $body = curl_exec( $ch);
  curl_close( $ch);
  $json = json_decode( $body);

  if ( 'OK' === $json->status ) {
    return [
      'latitude' => $json->results[0]->geometry->location->lat,
      'longitude' => $json->results[0]->geometry->location->lng,
    ];
  } else {
    return null;
  }
}

function isAdmin() {
  return Auth::user()->role_id == ADMIN_ROLE_ID;
}

function isCustomer() {
  return Auth::user()->role_id == CUSTOMER_ROLE_ID;
}

function isLandLord() {
  return Auth::user()->role_id == LANDLORD_ROLE_ID;
}

function isAgent() {
  return Auth::user()->role_id == AGENT_ROLE_ID;
}

function GetIP()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
    {
        if (array_key_exists($key, $_SERVER) === true)
        {
            foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip)
            {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                {
                    return $ip;
                }
            }
        }
    }
}

function flashMessage( $type = 'success', $operation = 'create', $message = '' ) {
  if ( empty( $message ) ) {
     switch ( $operation ) {
        case 'create':
          $message = trans( 'custom.messages.record_saved' );
          break;
        case 'restore':
          $message = trans( 'custom.messages.record_restored' );
          break;
        case 'update':
          $message = trans( 'custom.messages.record_updated' );
          break;
        case 'delete':
          $message = trans( 'custom.messages.record_deleted' );
          break;
        case 'deletes':
          $message = trans( 'custom.messages.records_deleted' );
          break;
        case 'crud_disabled':
          $message = trans( 'custom.messages.crud_disabled' );
          break;
        case 'products_transfered':
          $message = trans( 'custom.products-transfer.transfered' );
          break;
        case 'status':
          $message = trans( 'custom.messages.status-changed' );
          break;
        case 'not_allowed':
          $message = trans( 'custom.messages.not_allowed' );
          break;
        case 'not_found':
          $message = trans( 'custom.messages.not_found' );
          break;
        case 'time_out':
          $message = trans( 'custom.messages.time_out' );
          break;
        case 'invalid_record':
          $message = trans('custom.messages.invalid_record');
          break;
        case 'exception':
          $message = trans('custom.messages.delete_exception');
          break;
        case 'reset':
          $message = trans('custom.messages.reset');
          break;
        default:
          $message = trans( 'custom.messages.record_saved' );
          break;
      }
  }
  session()->flash('status', $type );
  session()->flash('message', $message );
}

function getContactId() {
  return Auth::id();
}

if (! function_exists('title_case')) {
    /**
     * Convert a value to title case.
     *
     * @param  string  $value
     * @return string
     */
    function title_case($value)
    {
        return Str::title($value);
    }
}

function getController( $key = '' ) {
  $action = app('request')->route();
  if ( $action ) {
    $action = $action->getAction();
  }


  $controller = class_basename($action['controller']);


  $parts = explode('@', $controller);

  $controller = $parts[0];
  if ( ! empty( $parts[1] ) ) {
    $action = $parts[1];
  }


  $result = array(
    'controller' => $controller,
    'action' => $action,
  );
  if ( ! empty( $key ) ) {
    if ( ! empty( $result[ $key ] ) ) {
      $result = $result[ $key ];
    }
  }
  return $result;
}

/**
 * This is a common method to send emails based on the requirement
 * The template is the key for template which is available in db
 * The data part contains the key=>value pairs
 * That would be replaced in the extracted content from db
 * @param  [type] $template [description]
 * @param  [type] $data     [description]
 * @return [type]           [description]
 */
 function sendEmail($template, $data)
 {
    return (new \App\EmailTemplate())->sendEmail($template, $data);
 }


/**
 * This method will send the random color to use in graph
 * The random color generation is based on the number parameter
 * As the border and bgcolor need to be same,
 * We are maintainig number parameter to send the same value for bgcolor and background color
 * @param  string  $type   [description]
 * @param  integer $number [description]
 * @return [type]          [description]
 */
 function getColor($type = 'background',$number = 777) {

    $hash = md5('color'.$number); // modify 'color' to get a different palette
    $color = array(
        hexdec(substr($hash, 0, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))); //b
    if($type=='border')
    return 'rgba('.$color[0].','.$color[1].','.$color[2].',1)';
    return 'rgba('.$color[0].','.$color[1].','.$color[2].',0.2)';
}

function isEnable( $variable )
{

  return true;

  if ( config('app.' . $variable) ) {
    return true;
  } else {
    return false;
  }
}

if ( ! function_exists('clean_text'))
{
  function clean_text($string)
  {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
  }
}

if ( ! function_exists('clean'))
{
  function clean($string)
  {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
  }
}

function isDemo()
{
  if ( config('app.demo') ) {
    if ( in_array( GetIP(), [ '' ] ) ) {
      return false;
    } else {
      return true;
    }
  } else {
    return false;
  }
}

/**
* Common method to send user restriction message for invalid attempt
* @return [type] [description]
*/
function prepareBlockUserMessage( $status = 'danger', $operation = 'create', $message = '')
{
  flashMessage($status, $operation, $message);
  return back();
}

function getPhrase( $key ) {

   $phrase = app('App\Language');

      if (func_num_args() == 0) {
          return '';
      }

      return  $phrase::getPhrase($key);
}

 /**
 * This method fetches the specified key in the type of setting
 * @param  [type] $key          [description]
 * @param  [type] $setting_type [description]
 * @return [type]               [description]
 */
function getSetting($key, $setting_type, $default = '')
{
    $value = App\Settings::getSetting($key, $setting_type );

    if ( 'invalid_setting' === $value ) {
      $value = $default;
    }
    return $value;
}

function getLocals() {
  $locales = array_merge( [ config( 'app.locale' ) ],
      \Barryvdh\TranslationManager\Models\Translation::groupBy( 'locale' )->pluck( 'locale' )->toArray() );

  $locales = array_unique( $locales );
  sort( $locales );
  return $locales;
}

if ( ! function_exists('get_text'))
{
  function get_text($string)
  {
    $string = str_replace('_', ' ', $string); // Replaces hyphen with space.
    return ucwords($string);
  }
}

function getContactInfo( $user_id = '', $key = '' ) {

  if ( ! empty( $user_id ) ) {
    $contact = \App\User::where( 'id', '=', $user_id)->first();
  } else {
    $contact = \App\User::where( 'id', '=', Auth::id())->first();
  }

  if ( isset( $contact->$key ) ) {
    return $contact->$key;
  } else {
    return null;
  }
}

/////////////////////////////Language helper start///////////////////////////////
function translate($sl, $tl, $q)
{

    $apiKey = getSetting('api_key', 'translations');
    if ( empty( $apiKey ) ) {
      $apiKey = 'AIzaSyDoKNAWR3TU1j7KlfLmY8XfTHiwCP6jiVc';
    }

    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($q) . '&source='.$sl.'&target=' . $tl;

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);     //We want the result to be saved into variable, not printed out
    $response = curl_exec($handle);
    curl_close($handle);

    $responseDecoded = json_decode($response, true);

    $text = ! empty( $responseDecoded['data']['translations'][0]['translatedText'] ) ? $responseDecoded['data']['translations'][0]['translatedText'] : $q;

    return $text;
}

function getLanguageId( $code ) {
  return \App\Language::where('code', '=', $code)->first()->id;
}



function storeLanguages() {
  foreach(config('app.languages') as $short => $title) {
    $language = array( 'language' => $title, 'code' => $short, 'is_rtl' => 'No');
    \App\Language::firstOrCreate( $language );
  }
}

function getLanguages()
{

  $session_languages = json_decode(session('languages'));
  if ( ! empty( $session_languages ) ) {
      return $session_languages;
  } else {
      $session_languages = updateLanguages();
      return $session_languages;
  }
}

function updateLanguages()
{
  $session_languages = \App\Language::select(['code', 'language', 'is_rtl'])->get()->toArray();
  if ( empty( $session_languages ) ) {
    $lang = [
      'code' => 'en',
      'language' => 'English',
      'is_rtl' => 'No',
    ];
    $session_languages[] = $lang;
    \App\Language::create( $lang );
  }
  session()->put('languages', json_encode($session_languages));
  return json_decode(session('languages'));
}

function validateRequirements()
{
  $requirements = [
      'phpversion' => 'PHP Version >= 7.1.3',
      'env' => '.env Writable',
      'PDO' => 'PDO PHP Extension',
      'Ctype' => 'Ctype PHP Extension',
      'JSON' => 'JSON PHP Extension',
      'BCMath' => 'BCMath PHP Extension',
      'max_execution_time' => 'max_execution_time',
      'tokenizer' => 'Tokenizer PHP Extension',
      'xml' => 'XML PHP Extension',
      'gd' => 'GD Library',
      'fileinfo' => 'fileinfo',
      'openssl' => 'openssl',
      'mbstring' => 'Mbstring PHP Extension',
    ];

    $isInstallable = true;
    $message = '';
    foreach ($requirements as $key => $desc) {
      if ( 'phpversion' == $key ) {
        if (version_compare(phpversion(), '7.1.3', '<')) {
          $isInstallable = false;
          $message .= $desc . '##';
        }
      } elseif ( 'max_execution_time' == $key ) {
        if( ! ini_get('max_execution_time') ) {
          $isInstallable = false;
          $message .= $desc . '##';
        }
      } elseif ( 'env' == $key ) {
        if ( ! is_writable( base_path() . '/.env' ) ) {
          $isInstallable = false;
          $message .= $desc . '##';
        }
      } else {
        if (! extension_loaded( $key ) ) {
          $isInstallable = false;
          $message .= $desc . '##';
        }
      }
    }
    return  ['status' => $isInstallable, 'message' => $message];
}


function getSettingsPath()
{
  $imageObject = new \App\ImageSettings();
  $destinationPath      = public_path() . $imageObject->getSettingsImagePath();
  return $destinationPath;
}



function getLocalSetting( $module, $key, $default = '' ) {

  $local_settings = (array) json_decode(session('local_settings'), true);

  if ( empty( $local_settings ) ) {
    $local_settings = updateLocalSettings();
  }

  if ( ! empty( $local_settings[ $module ][ $key ] ) ) {
    return $local_settings[ $module ][ $key ];
  } else {
    return $default;
  }
}

function updateLocalSettings( $module = '' )
{
  $default_currency = $user_currency = App\Currency::where('is_default', 'yes')->first();
  if ( ! $default_currency ) {
    $default_currency = $user_currency = App\Currency::where('id', DEFAULT_CURRENCY_ID)->first();
  }
  $default_currency = $default_currency->toArray();
  $contact = \App\User::where( 'id', Auth::id())->first();
  if ( $contact && $contact->currency ) {
      $user_currency = $contact->currency->toArray();
  }

  $currencies = App\Currency::where('status', 'Active')->get();
  $currencies_arr = [];
  if ( $currencies->count() > 0 ) {
    foreach ($currencies as $curr) {
      $currencies_arr[ $curr->id ] = $curr;
    }
  }

  $local_settings = [
    'default_currency' => $default_currency,
    'user_currency' => $user_currency,
    'currencies' => $currencies_arr,
  ];
  session()->put('local_settings', json_encode($local_settings));
  return (array) json_decode(session('local_settings'), true);
}


function getDefaultCurrency( $type = 'symbol', $customer_id = '' ) {

  if ( ! isAdmin() && ! isAgent() ) {
    $customer_id = Auth::id();
  }
  $symbol = getLocalSetting('default_currency', 'symbol');
  $display_currency = App\Settings::getSetting('display_currency', 'currency_settings', 'symbol');
  if( 'id' === $type ) {
    $symbol = getLocalSetting('default_currency', 'id', DEFAULT_CURRENCY_ID);
  } elseif ( ( 'code' === $display_currency ) || ( 'code' === $type ) ) {
    $symbol = getLocalSetting('default_currency', 'code', '$');
  }

  if ( ! empty( $customer_id ) ) {
    $contact = \App\User::where( 'id', $customer_id)->first();
    if ( $contact->currency ) {
        $currency = $contact->currency;
        $symbol = $currency->symbol;
        if( 'id' === $type ) {
          $symbol = $currency->id;
        } elseif ( ( 'code' === $display_currency ) || ( 'code' === $type ) ) {
          $symbol = $currency->code;
        }
    }
  }
  return $symbol;
}


function getCurrency( $id, $field = '' ) {

  $currency = getLocalSetting('currencies', $id);

  if( ! $currency ) {
    if ( is_numeric( $id ) ) {
      $currency = \App\Currency::find( $id );
    } else {
      $currency = \App\Currency::where( 'code', $id)->first();
    }
  } else {
    $currency = (Object) $currency;
  }

  if ( $currency ) {
    if ($currency instanceof Illuminate\Database\Eloquent\Collection) {
      $newcurrency = $currency->pop();
    } else {
      $newcurrency = $currency;
    }
    return $newcurrency->{$field};
  } else {
    $currency = getDefaultCurrency();
  }
  return $currency;
}

function getCurrencyPosition() {
  return App\Settings::getSetting('currency_position', 'currency_settings');
}

function digiCurrency( $amount, $default = '', $withcurrency = true ) {

  $currency_postion = getCurrencyPosition();

  $toundsand_separator = App\Settings::getSetting('toundsand_separator', 'currency_settings');
  if ( empty( $toundsand_separator ) ) {
    $toundsand_separator = ',';
  }
  $decimal_separator = App\Settings::getSetting('decimal_separator', 'currency_settings');
  if ( empty( $toundsand_separator ) ) {
    $toundsand_separator = '.';
  }
  $decimals = App\Settings::getSetting('decimals', 'currency_settings');
  if ( empty( $decimals ) ) {
    $decimals = '2';
  }

  $amount = number_format( $amount, $decimals, $decimal_separator, $toundsand_separator);

  if ( $withcurrency ) {
    $currency_position = getCurrencyPosition();

    $currency = getCurrency( $default, 'symbol' );


    if ( 'left' === $currency_position ) {
      $amount = $currency . $amount;
    }
    if ( 'right' === $currency_position ) {
      $amount = $amount . $currency;
    }
    if ( 'left_with_space' === $currency_position ) {
      $amount = $currency . ' ' . $amount;
    }
    if ( 'right_with_space' === $currency_position ) {
      $amount = $amount . ' ' . $currency;
    }
  }

  return $amount;
}


function stripeCurrencies() {
  return [
    'usd', 'aed', 'afn', 'all', 'amd', 'ang', 'aoa', 'ars', 'aud', 'awg', 'azn', 'bam', 'bbd', 'bdt', 'bgn', 'bif', 'bmd', 'bnd', 'bob', 'brl', 'bsd',
    'bwp', 'bzd', 'cad', 'cdf', 'chf', 'clp', 'cny', 'cop', 'crc', 'cve', 'czk', 'djf', 'dkk', 'dop', 'dzd', 'egp', 'etb', 'eur', 'fjd', 'fkp', 'gbp',
    'gel', 'gip', 'gmd', 'gnf', 'gtq', 'gyd', 'hkd', 'hnl', 'hrk', 'htg', 'huf', 'idr', 'ils', 'inr', 'isk', 'jmd', 'jpy', 'kes', 'kgs', 'khr', 'kmf',
    'krw', 'kyd', 'kzt', 'lak', 'lbp', 'lkr', 'lrd', 'lsl', 'mad', 'mdl', 'mga', 'mkd', 'mmk', 'mnt', 'mop', 'mro', 'mur', 'mvr', 'mwk', 'mxn', 'myr',
    'mzn', 'nad', 'ngn', 'nio', 'nok', 'npr', 'nzd', 'pab', 'pen', 'pgk', 'php', 'pkr', 'pln', 'pyg', 'qar', 'ron', 'rsd', 'rub', 'rwf', 'sar', 'sbd',
    'scr', 'sek', 'sgd', 'shp', 'sll', 'sos', 'srd', 'std', 'szl', 'thb', 'tjs', 'top', 'try', 'ttd', 'twd', 'tzs', 'uah', 'ugx', 'uyu', 'uzs', 'vnd',
    'vuv', 'wst', 'xaf', 'xcd', 'xof', 'xpf', 'yer', 'zar', 'zmw', 'eek', 'lvl', 'svc', 'vef',
  ];
}


function paypalCurrencies() {
  return ['AUD',
  'BRL', // This currency is supported as a payment currency and a currency balance for in-country PayPal accounts only.
  'CAD', 'CZK', 'DKK', 'EUR', 'HKD',
  'HUF', // This currency does not support decimals. If you pass a decimal amount, an error occurs.
  //'INR', // This currency is supported as a payment currency and a currency balance for in-country PayPal India accounts only.
  'ILS',
  'JPY', // This currency does not support decimals. If you pass a decimal amount, an error occurs.
  'MYR', // This currency is supported as a payment currency and a currency balance for in-country PayPal accounts only.
  'MXN',
  'TWD', // This currency does not support decimals. If you pass a decimal amount, an error occurs.
  'NZD', 'NOK', 'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD'];
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

function haveTransactions( $contact_id ) {
  $invoice_payments = DB::table('payment_history')->join('invoices', 'invoices.id', '=', 'payment_history.invoice_id')->where('payment_history.paymentstatus', 'success')->where('invoices.customer_id', $contact_id)->count(); // Invoices


  if ( $invoice_payments > 0 ) {
    return true;
  } else {
    return false;
  }
}

if (! function_exists( 'digi_get_help' ) ) {
  /**
   * Returns the help text as tooltip
   *
   * @since 1.0
   * @return string
   */
  function digi_get_help( $help = 'This is help text', $icon = 'fa fa-question-circle fa-lg', $class = '' ) {
    $text = sprintf( '&nbsp;<span class="st_tooltip '.$class.'" title="%s" data-toggle="tooltip"><span class="' . $icon . '"></span></span>', $help );
    return $text;
  }
}