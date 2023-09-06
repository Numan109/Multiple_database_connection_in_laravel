<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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

// for crontab

Route::get('insert_monthly_active_student', [DashboardController::class, 'insert_monthly_active_student'])->name('insert_monthly_active_student');


// ---------------------------------------------------------------------


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // })->middleware(['auth','role:admin', 'verified']);

    Route::get('/data_table', function () {
        // return view('welcome');
        return view('backend.user_role',[
            'users'=> DB::table('users')->take(5)->get(),
            // 'users'=> DB::connection('mysql')->table('users')->take(5)->get(),
            // 'users'=> User::take(5)->get(),
            'dbConnection'=> Cache::get('db-connection','mysql')
        ]);
    })->name('data_table');

});





// Route::get('/dashboard', function () {
//     return view('dashboard');
  
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::get('change-db-connection', function () {
//    Cache::put('db-connection', request('connection','mysql'));
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// =============================================

