<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'front_routes' . DIRECTORY_SEPARATOR;
/* * ******** IndexController ************ */
Route::get('/', 'IndexController@index')->name('index');
Route::post('set-locale', 'IndexController@setLocale')->name('set.locale');
/* * ******** HomeController ************ */
Route::get('home', 'HomeController@index')->name('home');
/* * ******** TypeAheadController ******* */
Route::get('typeahead-currency_codes', 'TypeAheadController@typeAheadCurrencyCodes')->name('typeahead.currency_codes');
/* * ******** FaqController ******* */
Route::get('faq', 'FaqController@index')->name('faq');
/* * ******** CronController ******* */
Route::get('check-package-validity', 'CronController@checkPackageValidity');
/* * ******** Verification ******* */
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::get('company-email-verification/error', 'Company\Auth\RegisterController@getVerificationError')->name('company.email-verification.error');
Route::get('company-email-verification/check/{token}', 'Company\Auth\RegisterController@getVerification')->name('company.email-verification.check');
/* * ***************************** */
// Sociallite Start
// OAuth Routes
Route::get('login/jobseeker/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/jobseeker/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/employer/{provider}', 'Company\Auth\LoginController@redirectToProvider');
Route::get('login/employer/{provider}/callback', 'Company\Auth\LoginController@handleProviderCallback');
// Sociallite End
/* * ***************************** */
Route::post('tinymce-image_upload-front', 'TinyMceController@uploadImage')->name('tinymce.image_upload.front');

Route::get('cronjob/send-alerts', 'AlertCronController@index')->name('send-alerts');

Route::post('subscribe-newsletter', 'SubscriptionController@getSubscription')->name('subscribe.newsletter');

/* * ******** Admin Auth ************ */
include_once($real_path . 'admin_auth.php');
/* * ******** AjaxController ************ */
include_once($real_path . 'ajax.php');
/* * ******** CmsController ************ */
include_once($real_path . 'cms.php');
/* * ******** Company Auth ************ */
include_once($real_path . 'company_auth.php');
/* * ******** CompanyController ************ */

Auth::routes();

include_once($real_path . 'company.php');
/* * ******** ContactController ************ */
include_once($real_path . 'contact.php');
/* * ******** JobController ************ */
include_once($real_path . 'job.php');
/* * ******** OrderController ************ */
include_once($real_path . 'order.php');
/* * ******** UserController ************ */
include_once($real_path . 'site_user.php');
/* * ******** Training Controller************ */
include_once($real_path . 'training.php');
/* * ******** Training Auth************ */
include_once($real_path . 'training_auth.php');


Route::get('blog', 'BlogController@index')->name('blogs');
Route::get('blog/search', 'BlogController@search')->name('blog-search');
Route::get('blog/{slug}', 'BlogController@details')->name('blog-detail');
Route::get('/blog/category/{blog}', 'BlogController@categories')->name('blog-category');

Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/companies', 'SitemapController@companies');

/* * ********Page Link ********** */
Route::get('tax', 'PageLinkController@taxs')->name('taxs');
Route::get('publication', 'PageLinkController@publications')->name('publications');
Route::get('recruiment', 'PageLinkController@recruiments')->name('recruiments');




