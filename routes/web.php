<?php

use Illuminate\Support\Facades\Route;

//allow controllers
use App\Http\Controllers\IssueIntakeController;
use App\Http\Controllers\IssueThreadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'getItem']);


//various users
Route::get('/registerUser', [UserController::class, 'getRegistrationForm'])->name('getRegisterUserForm');

Route::post('/registerUser', [UserController::class, 'saveItem'])->name('registerUser');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/login', [UserController::class, 'login'])->name('getLoginUrl');
Route::post('/login', [UserController::class, 'attemptLogin'])->name('loginUser');


//issues
Route::get('/issues', [IssueIntakeController::class, 'getOverview'])->name('showIssues');
Route::get('/issueDetail/{id}', [IssueIntakeController::class, 'issueDetail']);

Route::post('/saveIssueIntake', [IssueIntakeController::class, 'saveItem'])->name('saveIssueIntake');

Route::post('/closeIssue', [IssueIntakeController::class, 'closeItem'])->name('closeIssue');

//issue threads
Route::post('/saveIssueThread', [IssueThreadController::class, 'addItem'])->name('saveIssueThread');
