<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['admin']], function () {


        // Class Fault
        Route::get('/master/fault', [FaultController::class, 'getFault'])->name('getFault');
        Route::get('/edit/{fault:fault_id}/fault', [FaultController::class, 'editFault'])->name('editFault');
        Route::patch('/fault/{fault:fault_id}/update', [FaultController::class, 'setFault'])->name('setFault');
        Route::delete('/delete/{fault:fault_id}/fault', [FaultController::class, 'deleteFault'])->name('deleteFault');
        Route::post('/add/fault', [FaultController::class, 'addFault'])->name('addFault');
        //

        // Class User
        Route::get('/master/user', [UserController::class, 'getUser'])->name('getUser');
        Route::post('/add/user', [UserController::class, 'addUser'])->name('addUser');
        Route::get('/edit/{user:user_id}/user', [UserController::class, 'editUser'])->name('editUser');
        Route::patch('/user/{user:user_id}/update', [UserController::class, 'updateUser'])->name('updateUser');
        Route::delete('/delete/{user:user_id}/user', [UserController::class, 'destroyUser'])->name('destroyUser');
        //

        // Report
        Route::get('/report', [ReportController::class, 'getReport'])->name('getReport');
        Route::post('/post/report', [ReportController::class, 'report'])->name('report');
        Route::get('/detail/{parking:kode_parkir}', [ReportController::class, 'detailKendaraan'])->name('detailKendaraan');
        Route::post('/generate-pdf', [ReportController::class, 'generatePDF'])->name('generatePDF');
        //
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //

    // CLass Parking
    Route::get('/parkir/masuk', [ParkingController::class, 'getParkirMasuk'])->name('getParkirMasuk');
    Route::get('/parkir/keluar', [ParkingController::class, 'ParkirKeluar'])->name('getParkirKeluar');
    Route::get('/parkir/fault', [ParkingController::class, 'Pelanggaran'])->name('getPelanggaran');
    Route::post('/parkir/masuk', [ParkingController::class, 'postParkirMasuk'])->name('postParkirMasuk');
    Route::post('/parkir/keluar', [ParkingController::class, 'ParkirKeluar'])->name('postParkirKeluar');
    Route::post('/parkir/fault', [ParkingController::class, 'Pelanggaran'])->name('postPelanggaran');
    Route::delete('/delete/{parking:kode_parkir}/kendaraan', [ParkingController::class, 'destroyKendaraan'])->name('destroyKendaraan');

    // User
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profil'])->name('profil');
    Route::get('/edit', [UserController::class, 'profil'])->name('profil');
    Route::get('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
    Route::patch('/profil/{user:user_id}/update', [UserController::class, 'newPassword'])->name('newPassword');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('postLogin');
});
