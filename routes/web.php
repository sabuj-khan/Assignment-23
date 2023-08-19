<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Page Route API
Route::get('/userLogin', [PageController::class, 'userLoginPage']);
Route::get('/userRegistration', [PageController::class, 'userRegistrationPage']);
Route::get('/sendOtp', [PageController::class, 'sendingOTPCode']);
Route::get('/verifyOtp', [PageController::class, 'otpVerification']);
Route::get('/resetPassword', [PageController::class, 'resetUserPassword'])->middleware([TokenVerificationMiddleware::class]);

// Dashboard front end route
Route::get('/logout', [PageController::class, 'userLogoutPage']);
Route::get('/dashboard', [PageController::class, 'dashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [PageController::class, 'userProfileShow'])->middleware([TokenVerificationMiddleware::class]);

// Income Data Page
Route::get('/incomePage', [PageController::class, 'incomePageInfo'])->middleware([TokenVerificationMiddleware::class]);

// Expense Page
Route::get('/expensePage', [PageController::class, 'expensePageInfo'])->middleware([TokenVerificationMiddleware::class]);


// Authentication Ajux API Route
Route::post('/user-register', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'userLogging']);
Route::post('/send-otp', [UserController::class, 'sendingOTPCode']);
Route::post('/otp-verify', [UserController::class, 'otpVerification']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware([TokenVerificationMiddleware::class]);

// DashBoard All Ajux API Route
Route::get('/user-profile-info', [UserController::class, 'userProfileInformation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-user-info', [UserController::class, 'updateUserInformation'])->middleware([TokenVerificationMiddleware::class]);

// Income Ajux API Route
Route::get('/income-list', [IncomeController::class, 'incomeListDisplay'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/income-create', [IncomeController::class, 'incomeCreation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/income-update', [IncomeController::class, 'incomeUpdating'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/income-delete', [IncomeController::class, 'incomeDeleting'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/income-by-id', [IncomeController::class, 'incomeByIdShow'])->middleware([TokenVerificationMiddleware::class]);

// Expense Ajux API Route
Route::get('/expense-list', [ExpenseController::class, 'expenseListDisplay'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/expense-create', [ExpenseController::class, 'expenseCreation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/expense-update', [ExpenseController::class, 'expenseUpdating'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/expense-delete', [ExpenseController::class, 'expenseDeleting'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/expense-by-id', [ExpenseController::class, 'expenseByIdShow'])->middleware([TokenVerificationMiddleware::class]);






