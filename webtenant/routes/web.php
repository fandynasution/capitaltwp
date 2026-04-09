<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController as Account;
use App\Http\Controllers\LoginController as Login;
use App\Http\Controllers\DashController as Dash;
use App\Http\Controllers\TicketController as Ticket;
use App\Http\Controllers\TestController as Test;
use App\Http\Controllers\OvertimeController as Overtime;
use App\Http\Controllers\HistoryController as History;
use App\Http\Controllers\NewsController as News;
use App\Http\Controllers\OnlineSurveyController as OnlineSurvey;

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

//Login Controller
Route::get('/', [Login::class, 'index']);
Route::post('/based', [Login::class, 'based']);
Route::post('/login', [Login::class, 'login']);
Route::get('/logout', [Login::class, 'logout']);

Route::get('/test', [Test::class, 'index']);

//PrefentBack CheckAuth
Route::group(['middleware' => ['check-auth', 'revalidate']], function () {
	//DashboardController
	Route::get('/dash', [Dash::class, 'index']);
	Route::post('/dash/getGraph', [Dash::class, 'getGraph']);
	Route::post('/dash/gen', [Dash::class, 'gen']);
	// Route::post('/dash/export', [Dash::class, 'export']);
	Route::get('/dash/export/{nm}/{lot_no}', [Dash::class, 'export']);
	Route::post('/dash/cancelOT', [Dash::class, 'cancelOT']);

	// //AccountController
	Route::view('/account/profile', 'account/profile');
	Route::get('/account/getbyemail/{email}', [Account::class, 'getbyemail']);
	Route::post('/account/updateprofile', [Account::class, 'updateprofile']);
	Route::post('/account/savepic', [Account::class, 'savepic']);
	Route::post('/account/changepass', [Account::class, 'changepass']);
	
	//TicketController
	Route::get('/ticket', [Ticket::class, 'index']);
	Route::get('/ticket/{id}/{form}', [Ticket::class, 'index']);
	Route::get('/ticket/{id}', [Ticket::class, 'getByID']);
	Route::get('/ticket/getTicket/{ent}/{prj}', [Ticket::class, 'getTicket']);
	Route::get('/ticket/getTicketNew/{ent}/{prj}', [Ticket::class, 'getTicketNew']);
	Route::get('/ticket/getTicketPrefix/{ent}/{prefix}', [Ticket::class, 'getTicketPrefix']);
	Route::post('/ticket/getCat', [Ticket::class, 'getCat']);
	Route::get('/ticket/getCatEdit/{complain_type}/{category_cd}', [Ticket::class, 'getCatEdit']);
	Route::post('/ticket/getLotNo', [Ticket::class, 'getLotNo']);
	Route::get('/ticket/getLotNoEdit/{tenant_no}/{lot_no}', [Ticket::class, 'getLotNoEdit']);
	Route::post('/ticket/savepic', [Ticket::class, 'savepic']);
	Route::post('/ticket/save', [Ticket::class, 'save']);

	//OvertimeController
	Route::get('/overtime', [Overtime::class, 'index']);
	Route::post('/overtime/getLotNo', [Overtime::class, 'getLotNo']);
	Route::view('/overtime/view', 'overtime/viewlayout');
	// Route::post('/overtime/getWorkhour', [Overtime::class, 'getWorkhour']);
	Route::GET('/overtime/workhour', [Overtime::class, 'getWorkhournew']);
	Route::post('/overtime/save', [Overtime::class, 'save']);
	Route::post('/overtime/getLayoutView', [Overtime::class, 'getLayoutView']);

	//HistoryController
	Route::view('/history/ticket', 'history/ticket_history');
	Route::view('/history/overtime', 'history/overtime_history');
	Route::view('/history/billing', 'history/billing_history');
	Route::get('/hticketTable', [History::class, 'ticketTable']);
	Route::get('/hovertimeTable', [History::class, 'overtimeTable']);
	Route::get('/hbillingTable', [History::class, 'billingTable']);
	Route::post('/hticketSearch', [History::class, 'ticketSearch']);
	Route::post('/hovertimeSearch', [History::class, 'overtimeSearch']);
	Route::post('/hbillingSearch', [History::class, 'billingSearch']);

	//NewsController
	Route::get('/news', [News::class, 'index']);

	//OnlineSurveyController
	Route::get('/online_survey', [OnlineSurvey::class, 'index']);
	Route::post('/online_survey/save', [OnlineSurvey::class, 'save']);

});