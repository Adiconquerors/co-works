<?php
use Illuminate\Http\Request;
    

if( env('DB_DATABASE') == '' )
{
    Route::get('install-instructions', 'Admin\InstallatationController@index')->name('install.index');
    Route::match(['get', 'post'], '/install-check-requiremetns', 'Admin\InstallatationController@requirements')->name('install.requirements');
    Route::match(['get', 'post'], '/install-project', 'Admin\InstallatationController@installProject')->name('install.project');
}
Route::match(['get', 'post'], 'install/register', 'Admin\InstallatationController@registerUser')->name('install.register');

Route::middleware(['install'])->group( function () {

  Route::get('/', function () {
        return view('auth.login');
    });

Route::get('language/{lang}', function ($lang) {

    if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

    $direction = 'ltr';
    $code = 'en';
    $language = \App\Language::where('code', '=', $lang)->first();            
    if ( $language ) {
        $code= $language->code;
        if ('Yes' === $language->is_rtl) {
          $direction = 'rtl';
        }
    }
    
    return redirect()->back()
        ->withCookie(cookie()->forever('language', $lang))
        ->withCookie(cookie()->forever('direction', $direction));
        
})->name('admin.language');


Route::get('/blog/{sub_space_type_id?}', 'BlogController@blog')->name('blog');

Route::get('/dashboard', [ 'uses' => 'DashboardController@dashboard', 'as' => 'dashboard'] );

Route::get('/blog-article/{id}', 'BlogController@eachArticle')->name('each.article');

// Authentication Routes
Route::get('login_test', 'Auth\LoginController@getLogin')->name('login_test');
Route::post('login_test', 'Auth\LoginController@postLogin')->name('login.login_test');

Route::get('user/activate/{code}', 'Auth\LoginController@confirm')->name('user.activate');

//logout route
Route::post('logout_test', 'Auth\LoginController@logout')->name('logout_test');

// Forgot Password
//logout route

// Registration Routes
Route::get('register-user', 'Auth\RegisterController@getRegister')->name('register_test');
//Resend verification link
Route::post('resend-user-verification', 'Auth\RegisterController@resendEmailVerification')->name('resend.emailverification');
//end resend verification

Route::post('register-user', 'Auth\RegisterController@postRegister')->name('register_test');
Route::match(['get', 'post'], 'validate-user', 'Auth\LoginController@validateUser')->name('validate_user');
Route::match(['get', 'post'], 'resend-otp', 'Auth\LoginController@resendOtp')->name('resend_otp');

Route::get('workspaces', 'MainPagesController@workspace')->name('main_page.workspace');
Route::get('topbarlocations', 'MainPagesController@topbarLocation')->name('main_page.topbarlocations');
Route::get('topbarlandlords', 'MainPagesController@topbarLandlords')->name('main_page.topbarlandlords');

Route::match(['get', 'post'], 'post-requirement', 'MainPagesController@postRequirement')->name('main_page.post-requirement');

Route::get('/how_it_works', function () {
    return view('main-pages.how-it-works');
});




Route::get('/about_us', function () {
    return view('main-pages.about-us');
});

//test adminlayout
Route::get('/admin_layout', function () {
    return view('layouts.new_admin_layout');
});
//end test adminlayout

Route::get('/map-pointer-clusters', function () {
    return view('map-pointer-clusters');
});

Route::get('/single_page', function () {
    return view('home-pages.single-page');
});

Route::get('/profile', function () {
    return view('home-pages.profile');
});



 Route::get('/email-profile', function () {
     return view('home-pages.email-profile');
 })->name('new-email');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

 Route::resource('space_types', 'SpaceTypesController');
 Route::get('space-types/{parent_id?}', [ 'uses' =>'SpaceTypesController@index' , 'as' => 'space-types.index']);
 Route::get('space-types', [ 'uses' =>'SpaceTypesController@mainindex' , 'as' => 'space-types.mainindex']);

 Route::match(['get', 'post'],'space-types-parent/{parent_id?}', [ 'uses' =>'SpaceTypesController@mainedit' , 'as' => 'space-types.mainedit']);

 // Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password_form');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
// end change password

Route::resource('sub_space_types', 'SubSpaceTypesController');
Route::resource('sub_types', 'SubTypesController');;
Route::resource('testimonials', 'TestimonialsController');
Route::resource('currencies', 'Admin\CurrenciesController');
Route::get('currencies/{currency_id}/{list?}', [ 'uses' => 'Admin\CurrenciesController@show', 'as' => 'currencies.show' ] );
Route::post('currencies_mass_destroy', ['uses' => 'Admin\CurrenciesController@massDestroy', 'as' => 'currencies.mass_destroy']);
Route::post('currencies_restore/{id}', ['uses' => 'Admin\CurrenciesController@restore', 'as' => 'currencies.restore']);
Route::delete('currencies_perma_del/{id}', ['uses' => 'Admin\CurrenciesController@perma_del', 'as' => 'currencies.perma_del']);
Route::get('currency/makedefault/{id}', [ 'uses' => 'Admin\CurrenciesController@makeDefault', 'as' => 'currency.makedefault' ]);
Route::get('currency/update-rates', [ 'uses' => 'Admin\CurrenciesController@updateRates', 'as' => 'currency.update_rates' ]);
Route::resource('amenities', 'AmenitiesController');
Route::resource('our_clients', 'OurClientController');
Route::resource('venues', 'VenuesController');
Route::resource('locations', 'LocationsController');
Route::resource('days', 'DayController');
Route::resource('articles', 'ArticlesController');
Route::resource('icon', 'IconsController');
Route::resource('membership_fees', 'MembershipFeesController');
Route::resource('users', 'UsersController');
Route::resource('permissions', 'Admin\PermissionsController');

Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

 
  Route::resource('roles', 'Admin\RolesController');
  Route::get('roles/{id}/{list?}', [ 'uses' => 'Admin\RolesController@show', 'as' => 'roles.show' ] );
  Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);

 //Email Templates
 Route::resource('templates', 'EmailTemplateController');
 Route::get('template/duplicate/{id}', [ 'uses' => 'EmailTemplateController@duplicate', 'as' => 'templates.duplicate' ]);
//End Email Templates

 Route::match(['get','post'],'/venue-filter/list', [ 'uses' =>'VenuesController@venueFilter' , 'as' => 'venues.filter'])->middleware('auth');

 //LEAD CRM Inquiries
 Route::resource('enquire', 'EnquireController');

 Route::match(['get','post'],'/booking-filter/list', [ 'uses' =>'EnquireController@bookingInitiatedFilter' , 'as' => 'enquiresbookinginitiated.filter'])->middleware('auth');

 Route::match(['get','post'],'/booking-module-filter/list', [ 'uses' =>'EnquireController@bookingInitiatedModuleFilter' , 'as' => 'enquiresbookinginitiatedmodule.filter'])->middleware('auth');

 Route::post('deal-completed/{id}', 'EnquireController@dealCompleted')->name('enquiries.dealcompleted');

  //junklead
  Route::post('/enquire/junklead/{id}/{junk_lead}', 'EnquireController@junklead')->name('enquiries.junklead');
 //end junklead 

 //dealtracker
Route::get('deals-completed', 'EnquireController@dealsCompleted')->name('dealtracker.dealscompleted');
Route::post('deals-completed/paid{id}', 'EnquireController@dealsPaid')->name('dealtracker.dealspaid');
Route::post('deals-completed/unpaid{id}', 'EnquireController@dealsUnpaid')->name('dealtracker.dealsunpaid');
//End dealtracker 

Route::get('seeker-details', 'EnquireController@seekerDetailsIndex')->name('dealtracker.seekerdetails');

Route::get('booking-initiated', 'EnquireController@bookingInitiatedDetailsIndex')->name('dealtracker.bookinginitiated');

Route::get('payment-received', 'EnquireController@paymentReceived')->name('dealtracker.paymentreceived');

// client dashboard
Route::get('clients', 'EnquireController@clientsDashboard')->name('clients.dashboard');
Route::get('unpaid-invoices', 'InvoiceController@unpaidInvoices')->name('unpaid.invoices');
Route::get('unpaid-invoice/show/{id}', 'InvoiceController@show')->name('unpaidinvoice.show');

 // Connect
Route::get('/getconnect', [ 'uses' =>'ConnectController@getConnect' , 'as' => 'getconnect']);

Route::post('/connect', [ 'uses' =>'ConnectController@sendConnect' , 'as' => 'connect']);
 //End Connect  


Route::post('invoice/paynow/{id}/{module}', ['uses' => 'InvoiceController@payNow', 'as' => 'invoice.paynow']);
Route::get('shop/payment-success/{slug}', ['uses' => 'InvoiceController@paymentSuccess', 'as' => 'invoice.payment-success']);


Route::post('payment/process-payment/{slug}', ['uses' => 'InvoiceController@processPayment', 'as' => 'payment.process-payment']);

Route::get('payment/payment-payu/{slug}', ['uses' => 'InvoiceController@processPayu', 'as' => 'payment.process-payu']);

Route::get('payment/payment-failed/{slug}', ['uses' => 'InvoiceController@paymentFailed', 'as' => 'payment.payment-failed']);

Route::get('payment/payment-cancelled/{slug}', ['uses' => 'InvoiceController@paymentCancelled', 'as' => 'payment.payment-cancelled']);

// End Payment

Route::delete('destroy/{id}', 'InvoiceController@destroy')->name('unpaid-invoices.destroy');
Route::get('bookings', 'InvoiceController@bookings')->name('bookings');
Route::get('paid-invoices', 'InvoiceController@paidInvoices')->name('paid.invoices');
    

Route::get('invoices/invoicepdf/{id}', [ 'uses' => 'InvoiceController@invoicePDF', 'as' => 'invoices.invoicepdf'] );

Route::get('invoices/bookinginvoicepdf/{id}', [ 'uses' => 'InvoiceController@bookingPDF', 'as' => 'invoices.bookinginvoicepdf'] );

 Route::post('/invoice/form/', ['uses' => 'InvoiceController@paymentForm', 'as' => 'invoices.payments']);

 Route::post('/payment/save-form/', ['uses' => 'InvoiceController@savePaymentForm', 'as' => 'payments.save']);
//end client dashboard



 //Leads
 Route::resource('leads', 'LeadsController');
 Route::match(['get','post'],'/dealstatus-filter-list', [ 'uses' =>'LeadsController@dealStatusFilter' , 'as' => 'leads.dealstatusfilter'])->middleware('auth');

 //LeadCrm ajax
 Route::post('/enquire/form/', ['uses' => 'EnquireAjaxController@seekerDetails', 'as' => 'enquires.seekerdetails']);

 Route::post('/enquire/save-form/', ['uses' => 'EnquireAjaxController@saveSeekerDetails', 'as' => 'seekerdetails.save']);


 //important
 Route::post('enquire/important-lead/', 'EnquireAjaxController@important')->name('enquire.important');
 Route::post('bookinginitiated/selected-property/', 'EnquireAjaxController@bookingInitiatedForSelectedProperty')->name('bookinginitiated.selectproperty');
 Route::post('uploadimage/ajax/', 'EnquireAjaxController@uploadImageAjax')->name('uploadimage.ajax');

Route::resource('article_carousals', 'ArticlesCarousalController');


Route::match(['get', 'post'], '/properties', [ 'uses' =>'PropertyController@index' , 'as' => 'properties.list']);



// Export
 Route::get('users-exports/', 'UsersController@export')->name('users.export');
 Route::get('properties-export/', 'PropertyController@propertiesExport')->name('properties.export');
 Route::get('inquiries-export/', 'EnquireController@inquiriesExport')->name('inquiries.export');
 Route::get('thismonth-inquiries-export/', 'EnquireController@presentMonthInquiriesExport')->name('thismonthinquiries.export');

//End Export

Route::match(['get','post'],'property-index-list', [ 'uses' =>'PropertyController@listingIndex' , 'as' => 'properties.index'])->middleware('auth');

Route::match(['get','post'],'property-index/sub/list', [ 'uses' =>'PropertyController@listingSubTypeIndex' , 'as' => 'properties.subindex'])->middleware('auth');

Route::match(['get','post'],'/property-filter/list', [ 'uses' =>'PropertyController@listingFilter' , 'as' => 'properties.filter'])->middleware('auth');

Route::match(['get','post'],'/enquiry-filter/list', [ 'uses' =>'EnquireController@enquiryFilter' , 'as' => 'enquires.filter'])->middleware('auth');



Route::get('/property-store-add', [ 'uses' =>'PropertyController@create' , 'as' => 'properties.create'])->middleware('auth');
Route::post('/property-store-add',  [ 'uses' =>'PropertyController@store' , 'as' => 'properties.store'])->middleware('auth');

Route::get('/property-store-edit/{slug}', [ 'uses' =>'PropertyController@propEdit' , 'as' => 'prop.edit'])->middleware('auth');
Route::put('/property-store-edit/{slug}',  [ 'uses' =>'PropertyController@update' , 'as' => 'prop.update'])->middleware('auth');
Route::get('/property-show-show/{slug}',  [ 'uses' =>'PropertyController@listingShow' , 'as' => 'properties.show'])->middleware('auth');
Route::get('/profile/agent/{slug}/{agent_id}', 'PropertyController@getAgentProfile')->name('prop.agent');



//propety enquire
//  Route::post('/property_store/add', 'PropertyController@send' );

Route::get('/property/{slug}/{sub_space_type_id}', [ 'uses' =>'PropertyController@edit' , 'as' => 'properties.edit']);






Route::post('/property_enquire/enquire',  [ 'uses' =>'EnquireController@enquireStore' , 'as' => 'properties.enquire']);

Route::post('/enquire/otp/{slug}',  [ 'uses' =>'EnquireController@enquireOtp' , 'as' => 'enquire.otp']);

Route::post('/enquire/resendotp/{slug}',  [ 'uses' =>'EnquireController@resendEnquireOtp' , 'as' => 'resend.enquireotp']);



Route::post('/property/contact/{slug}', 'PropertyController@contactSend')->name('properties.send');

 Route::get('blog-search', 'BlogSearchController@search')->name('blog_search');



Route::get('/profile/settings', 'ProfileSettingsController@getprofile')->name('get.profile');

 Route::post('/profile/settings', 'ProfileSettingsController@profileSettings')->name('profile.settings');

 Route::post('/resend/activation', 'ResendActivationController@activation')->name('resend.activation');


 Route::post('/explore', [ 'uses' =>'PropertyController@getProperties' , 'as' => 'properties.getProperties']);
 Route::post('/like-property', 'PropertyController@likeProperty')->name('property.likeit');
 
 Route::post('/review-property', 'PropertyController@reviewProperty')->name('properties.review');

 Route::delete('/property-destroy/{slug}', 'PropertyController@destroy')->name('properties.destroy');
 // property avalibility
 Route::post('/property/availability/{slug}/{is_approved}', 'PropertyController@availabilityStatus')->name('properties.availability');
//end property avaliability
Route::post('/property/mail-invoice', 'PropertyController@mailInvoice')->name('properties.mailInvoice');

Route::post('/property/send', 'PropertyController@sendInvoice')->name('properties.sendInvoice');

Route::post('invoice/save-payment', 'PropertyController@savePayment')->name('properties.savePayments');

// Property visits Share
Route::post('properties/total-visits', 'ShortlistAndVisitsController@propertiesVisitsShare')->name('properties.mailvisits');

Route::post('properties/send-visits', 'ShortlistAndVisitsController@sendPropertiesVisitsShare')->name('properties.sendvisits');
// End Property visits Share

Route::post('property/total-shortlists', 'ShortlistAndVisitsController@shortlistPropertiesShare')->name('properties.totalshortlists');

//shortlist
 Route::post('/shortlist-property', 'ShortlistAndVisitsController@shortlist')->name('property.shortlist');

 Route::post('/shortlist-property/close', 'ShortlistAndVisitsController@shortlistClose')->name('property.shortlist_close');
//End Shortlist

 //Visits
 Route::post('/visit-property', 'ShortlistAndVisitsController@scheduleVisit')->name('property.visit');

 Route::post('/visit-property/close', 'ShortlistAndVisitsController@visitClose')->name('property.visit_close');

 //End Visits

Route::get('/live_search', 'SearchController@index');


Route::get('search', 'MegaSearchController@search')->name('admin.mega-search');
Route::post('get-details', 'MegaSearchController@getDetails')->name('admin.get-mega-details');

Route::get('/live_search/action', 'SearchController@action')->name('live_search.action');

// provider dashboard
Route::get('providers', 'PropertyController@providersDashboard')->name('providers.dashboard')->middleware('auth');
//end provider dashboard

// InternalNotifications
    Route::get('internal_notifications/read', 'InternalNotificationsController@read');
    Route::resource('internal_notifications', 'InternalNotificationsController');

    Route::post('internal_notifications_mass_destroy', ['uses' => 'InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']); 
// End InternalNotifications

// Dynamic Menues
    Route::resource('menus', 'MenusController'); 
// End Dynamic Menues    
 

Route::get('/email', function () {
    return view('home-pages.email.email');
});

Route::get('/testpage', function () {
    return view('testpage');
});

// subscribe to news letter
Route::post('/subscribe-to-newsletter', 'BlogController@subscribeToNewsLetter')->name('blog.subscribenewsletter');

Route::post('blog-search-ajax', 'BlogController@getBlogs')->name('blog.search.ajax');

Route::get('/testsms', 'Auth\LoginController@sendSms');

// Settings.

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    
      Route::resource('languages', 'Admin\LanguagesController');
      Route::post('languages_mass_destroy', ['uses' => 'Admin\LanguagesController@massDestroy', 'as' => 'languages.mass_destroy']);
      Route::post('languages_restore/{id}', ['uses' => 'Admin\LanguagesController@restore', 'as' => 'languages.restore']);
      Route::delete('languages_perma_del/{id}', ['uses' => 'Admin\LanguagesController@perma_del', 'as' => 'languages.perma_del']);
      Route::get('userlanguage/changedirection/{id}', [ 'uses' => 'Admin\LanguagesController@changeDirection', 'as' => 'language.changedirection' ]);
      Route::get('make-default-language/{id}', [ 'uses' => 'Admin\LanguagesController@makeDefaultLanguage', 'as' => 'language.makedefault' ]);


    Route::resource('master_settings', 'Admin\MasterSettingsController');
    Route::post('master_settings_mass_destroy', ['uses' => 'Admin\MasterSettingsController@massDestroy', 'as' => 'master_settings.mass_destroy']);
    Route::post('master_settings_restore/{id}', ['uses' => 'Admin\MasterSettingsController@restore', 'as' => 'master_settings.restore']);
    Route::delete('master_settings_perma_del/{id}', ['uses' => 'Admin\MasterSettingsController@perma_del', 'as' => 'master_settings.perma_del']);
    Route::post('mastersettings/translate', ['uses' => 'Admin\MasterSettingsController@translate', 'as' => 'master_settings.translate']);
    
    Route::get('mastersettings/settings/', 'Admin\GeneralSettingsController@index');
    Route::get('mastersettings/settings/index', 'Admin\GeneralSettingsController@index');
    Route::get('mastersettings/settings/add', 'Admin\GeneralSettingsController@create');
    Route::post('mastersettings/settings/add', 'Admin\GeneralSettingsController@store');
    Route::get('mastersettings/settings/edit/{slug}', 'Admin\GeneralSettingsController@edit');
    Route::patch('mastersettings/settings/edit/{slug}', 'Admin\GeneralSettingsController@update');
    Route::get('mastersettings/settings/view/{slug}', 'Admin\GeneralSettingsController@viewSettings');
    Route::get('mastersettings/settings/add-sub-settings/{slug}', 'Admin\GeneralSettingsController@addSubSettings');
    Route::post('mastersettings/settings/add-sub-settings/{slug}', 'Admin\GeneralSettingsController@storeSubSettings');
    Route::patch('mastersettings/settings/add-sub-settings/{slug}', 'Admin\GeneralSettingsController@updateSubSettings');

    Route::resource('payment_gateways', 'Admin\PaymentGatewaysController');
    Route::resource('sms_gateways', 'Admin\SmsGatewaysController');

    
      
  });
});

Route::fallback('DashboardController@dashboard');