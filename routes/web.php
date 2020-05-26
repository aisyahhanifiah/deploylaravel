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

Route::group(['middleware' => 'guest'], function (){
	Route::get('/', function () {
		return view('welcome');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('payment/club/{id}', 'PaymentController@show1')->name('payment.show1');
	Route::get('payment/event/{id}', 'PaymentController@show2')->name('payment.show2');

	Route::get('print/receipt/club/{id}', 'PaymentController@printReceiptClub')->name('print.receipt.club');
	Route::get('print/receipt/event/{id}', 'PaymentController@printReceiptEvent')->name('print.receipt.event');

	Route::resource('club', 'ClubController');
	Route::resource('event', 'EventController');

	Route::resource('myclub', 'UserClubController');
	Route::post('myclub', 'UserClubController@join')->name('myclub.join');

	Route::resource('myevent', 'UserEventController');
	Route::post('myevent', 'UserEventController@join')->name('myevent.join');

	Route::resource('mymeeting', 'UserMeetingController');

	Route::put('save', 'CustomerController@save')->name('save.customer');
	Route::post('club/purchase', 'UserClubController@purchase')->name('club.purchase');
	Route::post('event/purchase', 'UserEventController@purchase')->name('event.purchase');

	Route::get('connect/{club}', 'SellerController@create')->name('stripe.create');
	Route::get('stripe/login/{club}', 'SellerController@connect')->name('stripe.login');
	Route::get('stripe', 'SellerController@save')->name('stripe.connect');

	Route::resource('payment', 'PaymentController');

	// Route::get('admin/club/export', 'ExportController@exportClub')->name('admin.export');
});

Route::group(['middleware' => ['auth', 'admin', 'committee']], function () {
	Route::resource('committee/club', 'CommitteeClubController', ['as'=>'committee']);
	Route::resource('committee/club/member', 'CommitteeClubMemberController', ['as'=>'committee.club']);
	Route::resource('committee/club/image', 'ClubImageController', ['as'=>'club']);
	Route::get('export/club/member/{club}', 'ExportController@exportMemberForClub')->name('memberforclub.export');

	Route::resource('committee/event', 'CommitteeEventController', ['as'=>'committee']);
	Route::resource('committee/event/member', 'CommitteeEventMemberController', ['as'=>'committee.event']);
	Route::resource('committee/event/image', 'EventImageController', ['as'=>'event']);
	Route::get('export/event', 'ExportController@exportEvent')->name('event.export');
	Route::get('export/event/{club}', 'ExportController@exportEventForClub')->name('eventforclub.export');
	Route::get('export/event/member/{event}', 'ExportController@exportMemberForEvent')->name('memberforevent.export');

	Route::resource('committee/meeting', 'CommitteeMeetingController', ['as'=>'committee']);
	Route::resource('committee/meeting/member', 'CommitteeMeetingMemberController', ['as'=>'committee.meeting']);
	Route::get('export/meeting/{club}', 'ExportController@exportMeetingForClub')->name('meetingforclub.export');
	Route::get('export/meeting/member/{meeting}', 'ExportController@exportMemberForMeeting')->name('memberformeeting.export');

});

Route::group(['middleware' => ['auth', 'admin']], function () {
	Route::resource('admin/club', 'AdminClubController', ['as'=>'admin']);
	Route::get('export/club', 'ExportController@exportClub')->name('club.export');
	Route::resource('admin/club/member', 'AdminClubMemberController', ['as'=>'admin.club']);

	Route::resource('admin/event', 'AdminEventController', ['as'=>'admin']);
	// Route::get('export/event', 'ExportController@exportEvent')->name('event.export');
	Route::resource('admin/event/member', 'AdminEventMemberController', ['as'=>'admin.event']);

	Route::resource('admin/user', 'AdminUserController', ['as'=>'admin']);
	Route::get('export/user', 'ExportController@exportUser')->name('user.export');
});

