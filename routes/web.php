<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

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

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

//Front Pages Route
Route::get('/', 'FrontController@index')->name('home');
Route::get('about-us', 'FrontController@about')->name('about');
Route::get('security', 'FrontController@security')->name('security');
Route::get('credit-score', 'FrontController@creditScore')->name('credit-score');
Route::get('market-news', 'FrontController@marketNews')->name('news');
Route::get('economic-calender', 'FrontController@economicCalender')->name('calender');
Route::get('calculator', 'FrontController@calculator')->name('calculator');
Route::get('webtrader', 'FrontController@webtrader')->name('webtrader');
Route::get('trader7', 'FrontController@trader7')->name('trader7');
Route::get('contact-us', 'FrontController@contact')->name('contact');
Route::get('forex', 'FrontController@forex')->name('forex');
Route::get('futures', 'FrontController@futures')->name('futures');
Route::get('indices', 'FrontController@indices')->name('indices');
Route::get('shares', 'FrontController@shares')->name('shares');
Route::get('metals', 'FrontController@metals')->name('metals');
Route::get('energies', 'FrontController@energies')->name('energies');
Route::get('crypto', 'FrontController@crypto')->name('crypto');
Route::get('privacy', 'FrontController@privacy')->name('privacy');
Route::get('terms-of-serv', 'FrontController@terms')->name('terms-of-serv');
Route::get('order-execution', 'FrontController@Execution')->name('order-execution');
Route::get('risk-disclosure', 'FrontController@disclosure')->name('risk-disclosure');
// Route::get('products', 'FrontController@products')->name('products');
Route::get('account-types', 'FrontController@accountTypes')->name('account-types');
// Route::get('trading-platforms', 'FrontController@tradingPlatforms')->name('trading-platforms');
Route::post('/send-contact-message', 'FrontController@sendContact')->name('sendcontactmessage');
// Route::get('private/ftds', 'FrontController@ftds')->name('ftds');

Route::get('dependent-dropdown', 'FrontController@fetchDependent');
Route::get('get-state-list', 'FrontController@getStateList')->name('fetchstates');
Route::get('get-town-list', 'FrontController@getTownList')->name('fetchtowns');

// switch lang
Route::get('/switch/lang/{lang}', 'FrontController@switchLang')->name('switchlang');


// Everything About Admin Route started here
Route::prefix('adminlogin')->group(function () {
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('adminloginform');
    Route::post('login', 'Admin\Auth\LoginController@adminlogin')->name('adminlogin');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('adminlogout');
    Route::get('dashboard', 'Admin\Auth\LoginController@validate_admin')->name('validate_admin');
    Route::get('verify/resend', 'Admin\Auth\TwoFactorController@resend')->name('admin.verify.resend');
    Route::resource('verify', 'Admin\Auth\TwoFactorController')->only(['index', 'store'])->name('get', 'admin.verify');
});

Route::group(['prefix' => 'admin',  'middleware' => ['isadmin', 'twofactor']], function () {
    Route::get('dashboard', 'Admin\HomeController@index')->name('admin.dashboard');

    Route::post('dashboard/search', 'Admin\HomeController@search');
    Route::post('dashboard/searchdp', 'Admin\HomeController@searchDp');
    Route::post('dashboard/searchWith', 'Admin\HomeController@searchWt');

    // manage admins
    Route::get('admins', 'Admin\AdminController@index')->name('madmins');
    Route::get('admins/list', 'Admin\AdminController@getadmins')->name('fetchadmin');
    Route::get('admins/create', 'Admin\AdminController@create')->name('addadmin');
    Route::post('admins/store', 'Admin\AdminController@store')->name('saveadmin');
    Route::post('admins/update', 'Admin\AdminController@update')->name('editadmin');
    Route::post('admins/delete/{id}', 'Admin\AdminController@destroy')->name('deladmin');
    Route::get('admin/adminresetadminpass/{id}', 'Admin\AdminController@adminresetadminpass')->name('adminresetadminpass');
    Route::get('admins/adminchangepassword', 'Admin\AdminController@adminchangepassword')->name('adminchangepass');
    Route::post('admins/adminupdatepass', 'Admin\AdminController@adminupdatepass')->name('adminupdatepass');
    Route::get('admins/uublock/{id}', 'Admin\AdminController@ublock')->name('adminublock');
    Route::get('admins/uunblock/{id}', 'Admin\AdminController@unblock')->name('adminunblock');
    Route::post('admins/sendmail', 'Admin\AdminController@sendmail')->name('sendmail');

    // manage roles
    Route::get('roles/list', 'Admin\RoleController@index')->name('manageroles');
    Route::get('roles/create', 'Admin\RoleController@create')->name('createrole');
    Route::post('roles/store', 'Admin\RoleController@store')->name('storerole');
    Route::get('roles/edit/{id}', 'Admin\RoleController@edit')->name('editrole');
    Route::post('roles/update/{id}', 'Admin\RoleController@update')->name('updaterole');
    Route::post('roles/delete/{id}', 'Admin\RoleController@destroy')->name('deleterole');

    // manage permissions
    Route::get('perms/list', 'Admin\PermController@index')->name('manageperms');
    Route::get('perms/create', 'Admin\PermController@create')->name('createperm');
    Route::post('perms/store', 'Admin\PermController@store')->name('storeperm');
    Route::post('perms/delete/{id}', 'Admin\PermController@destroy')->name('deleteperm');

    // manage users
    Route::get('users', 'Admin\UsersController@index')->name('manageusers');
    Route::get('mobius_users', 'Admin\UsersController@fetchmobiususers')->name('fetchmobiususers');
    Route::get('users/getactions/{id}', 'Admin\UsersController@getactions')->name('getactions');
    Route::post('users/store', 'Admin\UsersController@store')->name('createuser');
    Route::post('users/update', 'Admin\UsersController@update')->name('updateuser');
    Route::get('users/unblock/{id}', 'Admin\UsersController@unblock')->name('userunblock');
    Route::get('users/ublock/{id}', 'Admin\UsersController@ublock')->name('userublock');
    Route::get('users/deluser/{id}', 'Admin\UsersController@destroy')->name('deluser');
    Route::post('users/sendmailsingle', 'Admin\UsersController@sendmailtooneuser')->name('sendmailtooneuser');
    Route::post('users/sendmailtoall', 'Admin\LogicController@sendmailtoall')->name('sendmailtoall');
    Route::post('users/addhistory', 'Admin\UsersController@addHistory')->name('addhistory');
    Route::get('users/resetpswd/{id}', 'Admin\UsersController@resetpswd')->name('resetpswd');
    Route::get('users/switchtouser/{id}', 'Admin\UsersController@switchtouser')->name('switchtouser');
    Route::get('users/access-wallet/{id}', 'Admin\UsersController@userwallet')->name('userwallet');
    Route::get('users/clearacct/{id}', 'Admin\UsersController@clearacct')->name('clearacct');
    Route::post('users/topup', 'Admin\UsersController@topup')->name('topup');
    Route::get('users/delliveaccount/{id}', 'Admin\UsersController@dellaccounts')->name('dellaccounts');

    Route::post('users/changestyle', 'Admin\UsersController@changestyle')->name('changestyle');

    // manage withdrawals and their processing
    Route::get('withdrawals/list', 'Admin\HomeController@mwithdrawals')->name('mwithdrawals');
    Route::get('withdrawals/pwithdrawal/{id}', 'Admin\LogicController@pwithdrawal')->name('pwithdrawal');
    Route::post('withdrawals/rejectwithdrawal', 'Admin\LogicController@rejectwithdrawal')->name('rejectwithdrawal');

    // manage deposits and their processing
    Route::get('deposits/list', 'Admin\HomeController@mdeposits')->name('mdeposits');
    Route::get('deposits/pdeposit/{id}', 'Admin\LogicController@pdeposit')->name('pdeposit');
    Route::post('deposits/rejectdeposit/{id}', 'Admin\LogicController@rejectdeposit')->name('rejectdeposit');

    // Settings Routes
    Route::get('settings/siteinfo', 'Admin\SettingsController@index')->name('settings');
    Route::get('settings/preferences', 'Admin\SettingsController@prefsettings')->name('preferencesettings');
    Route::get('settings/payments', 'Admin\SettingsController@paysettings')->name('paymentsettings');
    Route::post('settings/updatesettings', 'Admin\SettingsController@updatesettings')->name('updatesettings');
    Route::post('settings/updatepreference', 'Admin\SettingsController@updatepreference')->name('updatepreference');
    Route::post('settings/updatewebinfo', 'Admin\SettingsController@updatewebinfo')->name('updatewebinfo');
    Route::post('settings/updatewdmethod', 'Admin\SettingsController@updatewdmethod')->name('updatewdmethod');
    Route::post('settings/addwdmethod', 'Admin\SettingsController@addwdmethod')->name('addwdmethod');
    Route::get('settings/deletewdmethod/{id}', 'Admin\SettingsController@deletewdmethod')->name('deletewdmethod');

    // KYC Routes
    Route::get('kyc/list', 'Admin\HomeController@kyc')->name('kyc');
    Route::get('kyc/accept/{id}', 'Admin\UsersController@acceptkyc')->name('acceptkyc');
    Route::get('kyc/reject/{id}', 'Admin\UsersController@rejectkyc')->name('rejectkyc');
    Route::get('kyc/reset/{id}', 'Admin\UsersController@resetkyc')->name('resetkyc');

    // frontpage editing
    Route::post('dashboard/savefaq', 'Admin\LogicController@savefaq')->name('savefaq');
    Route::post('dashboard/savetestimony', 'Admin\LogicController@savetestimony')->name('savetestimony');
    Route::post('dashboard/saveimg', 'Admin\LogicController@saveimg')->name('saveimg');
    Route::post('dashboard/savecontents', 'Admin\LogicController@savecontents')->name('savecontents');

    // Update Frontend Pages
    Route::post('dashboard/updatefaq', 'Admin\LogicController@updatefaq')->name('updatefaq');
    Route::post('dashboard/updatetestimony', 'Admin\LogicController@updatetestimony')->name('updatetestimony');
    Route::post('dashboard/updatecontents', 'Admin\LogicController@updatecontents')->name('updatecontents');
    Route::post('dashboard/updateimg', 'Admin\LogicController@updateimg')->name('updateimg');

    // Delete fa and tes routes
    Route::get('dashboard/delfaq/{id}', 'Admin\LogicController@delfaq');
    Route::get('dashboard/deltestimony/{id}', 'Admin\LogicController@deltest');

    // managing account types
    Route::get('accounttypes/list', 'Admin\HomeController@accounttypes')->name('accounttypes');
    Route::get('accounttypes/create', 'Admin\HomeController@showaddaccounttype')->name('showaddaccounttype');
    Route::post('accounttypes/store', 'Admin\HomeController@addaccounttype')->name('addaccounttype');
    Route::post('accounttypes/update/{id}', 'Admin\HomeController@updateaccounttype')->name('updateaccounttype');
    Route::get('accounttypes/delete/{id}', 'Admin\HomeController@delaccounttype')->name('delaccounttype');

    Route::get('ftds/list', 'Admin\HomeController@mftds')->name('mftds');

    Route::get('settings/frontpage', 'Admin\HomeController@frontpage')->name('frontpage');
});
// Everything About Admin Route ends here



// Everything About Users Route starts here
Route::get('/verify-email', 'UserController@verifyemail')->middleware('auth');

// saving the ref in session and redirecting to register
Route::get('ref/{id}', 'Controller@ref')->name('ref');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $request->session()->put('message', 'Thanks for succesfully verifying your email.');
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', 'FrontController@forgotpassword')->name('password.request');
Route::middleware(['auth'])->get('/dashboard', 'UserController@dashboard')->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {

    // Two Factor Authentication
    Route::post('dashboard/changetheme', 'UserController@changetheme')->name('changetheme');
    Route::get('dashboard/refreshAccounts', 'UserController@refreshAccounts')->name('refreshaccounts');
    Route::get('2fa', 'TwoFactorController@showTwoFactorForm')->name('2fa');
    Route::post('2fa', 'TwoFactorController@verifyTwoFactor');
    Route::post('dashboard/savedocs', 'UserController@savevdocs')->name('kycsubmit');

    Route::get('dashboard/skip_account', 'Controller@skip_account');
    Route::get('dashboard/tradinghistory', 'UserController@tradinghistory')->name('tradinghistory');
    Route::get('dashboard/accounthistory', 'UserController@accounthistory')->name('account.history');

    // Upadating user profile info
    Route::get('dashboard/profile', 'UserController@profile')->name('account.profile');
    Route::post('dashboard/profileinfo', 'UserController@updateprofile')->name('userprofile');
    Route::post('dashboard/updatepass', 'UserController@updatepass')->name('updatepass');
    Route::get('dashboard/changepassword', 'UserController@changepassword')->name('changepassword');
    Route::get('/dashboard/verify-account', 'UserController@verifyaccount')->name('account.verify');
    Route::get('/dashboard/manage-account-security', 'UserController@security')->name('account.security');
    Route::get('dashboard/withdrawaldetails', 'UserController@withdrawaldetails')->name('withdrawaldetails');
    Route::post('dashboard/updatewithdrawaldetails', 'UserController@updatewithdrawaldetails')->name('updatewithdrawaldetails');

    // Withdrawals & Deposits
    Route::get('dashboard/deposits', 'UserController@deposits')->name('account.deposits');
    Route::post('dashboard/paypalverify/{amount}', 'UserController@paypalverify')->name('paypalverify');
    Route::get('dashboard/withdrawals', 'UserController@withdrawals')->name('account.withdrawals');
    Route::get('dashboard/makewithdrawal', 'UserController@mwithdrawal')->name('mwithdrawal');
    Route::post('dashboard/withdrawal', 'UserController@savewithdrawal')->name('withdrawal');

    Route::get('ref/{id}', 'Controller@ref')->name('ref');
    Route::post('sendcontact', 'FrontController@sendcontact')->name('enquiry');
    Route::post('dashboard/chngemail', 'UserController@chngemail');
    Route::post('dashboard/savedeposit', 'UserController@savedeposit')->name('savedeposit');


    Route::get('dashboard/support', 'UserController@support')->name('account.support');
    Route::get('dashboard/downloads', 'UserController@downloads')->name('account.downloads');
    Route::get('dashboard/referuser', 'UserController@referuser')->name('referuser');
    Route::get('dashboard/notifications', 'UserController@notification')->name('notifications');

    Route::get('dashboard/delnotif/{id}', 'UserController@delnotif')->name('delnotif');
    Route::get('dashboard/delmarket/{id}', 'UserController@delmarket');
    Route::get('dashboard/delassets/{id}', 'UserController@delassets');

    // Trader7 account mg't
    Route::get('/dashboard/demo-accounts', 'T7Controller@demoaccounts')->name('account.demoaccounts');
    Route::get('/dashboard/live-accounts', 'T7Controller@liveaccounts')->name('account.liveaccounts');
    Route::post('/dashboard/add-account', 'T7Controller@addt7account')->name('account.addt7account'); //->middleware(['throttle:1,30']);
    Route::get('/dashboard/t7-demo-deposit/{id}', 'T7Controller@demotopup')->name('account.demotopup');
    Route::post('/dashboard/reset-account-password/{id}', 'T7Controller@resett7password')->name('account.resett7password');


    // user deposit routes
    Route::get('dashboard/select-payment-method', 'UserController@selectPaymentMethod')->name('selectpaymentmethod');
    Route::get('dashboard/startpayment/{accountId}/{methodId}', 'UserController@startPayment')->name('startpayment');


    // paypound payments
    Route::post('dashboard/start_paypound_charge', 'UserController@startPaypoundCharge')->name('startpaypoundcharge');
    Route::get('dashboard/verify_paypound_charge', 'UserController@verifyPaypoundCharge')->name('verifypaypoundcharge');

    // paystudio payments
    Route::post('dashboard/start_paystudio_charge', 'UserController@startPayStudioCharge')->name('startpaystudiocharge');
    Route::get('dashboard/verify_paystudio_charge', 'UserController@verifyPayStudioCharge')->name('verifypaystudiocharge');

    // chargemoney payments
    Route::post('dashboard/start_chargemoney_charge', 'UserController@startChargeMoneyCharge')->name('startchargemoneycharge');
    Route::get('dashboard/verify_chargemoney_charge', 'UserController@verifyChargeMoneyCharge')->name('verifychargemoneycharge');

    // ywallitpay payments
    Route::post('dashboard/start_ywallitpay_charge', 'UserController@startYWallitPayCharge')->name('startywallitpaycharge');
    Route::get('dashboard/verify_ywallitpay_charge', 'UserController@verifyYWallitPayCharge')->name('verifyywallitpaycharge');

    // virtualpay payments
    Route::post('dashboard/start_virtualpay_charge', 'UserController@startYWallitPayCharge')->name('startvirtualpaycharge');
    Route::get('dashboard/verify_virtualpay_charge', 'UserController@verifyYWallitPayCharge')->name('verifyvirtualpaycharge');

    // authorizenet payments
    Route::get('dashboard/authorizenet_pay', 'UserController@startAuthorizeNetPay')->name('authorizenetpay');
    Route::post('dashboard/authorizenet_dopay', 'UserController@handleAuthorizeNetPay')->name('authorizenetdopay');

    // cashonex payments
    Route::post('dashboard/start_cashonex_charge', 'UserController@startCashonexPay')->name('startcashonexcharge');
    Route::any('dashboard/verify_cashonex_charge', 'UserController@handleCashonexPay')->name('verifycashonexcharge');

    // numpay payments
    Route::any('dashboard/start_numpay_charge', 'UserController@startNumPay')->name('startnumpaycharge');
    Route::any('dashboard/verify_numpay_charge', 'UserController@handleNumPay')->name('verifynumpaycharge');

    // paycly payments
    Route::any('dashboard/start_paycly_charge', 'UserController@startPaycly')->name('startpayclycharge');
    Route::any('dashboard/verify_paycly_charge', 'UserController@handlePaycly')->name('verifypayclycharge');

    // ragapay payments
    Route::any('dashboard/success_ragapay_charge', 'UserController@successRagapay')->name('successragapaycharge');
    Route::any('dashboard/cancel_ragapay_charge', 'UserController@cancelRagapay')->name('cancelragapaycharge');
    Route::any('dashboard/callback_ragapay_charge', 'UserController@callbackRagapay')->name('callbackragapaycharge');

});

Route::get('/dashboard/weekend', 'Controller@checkdate');

