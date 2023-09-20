<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;

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
Route::get('bidyaan-login', [DashboardController::class, 'bidyaanLogin'])->name('bidyaan-login');
Route::get('bidyaan-login1', [DashboardController::class, 'change'])->name('bidyaan-login1');


// ---------------------------------------------------------------------


Route::middleware('auth')->group(function () {



    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('user-role', [RoleController::class, 'index'])->name('user_role');

    Route::post('add-user-role', [RoleController::class, 'store'])->name('add_user_role');


    Route::get('user-role-edit/{id}', [RoleController::class, 'editRole'])->name('user_role.edit');


    Route::get('user-role-delete/{id}', [RoleController::class, 'destroy'])->name('user_role_delete');
    

    Route::get('/school/{id}', [DashboardController::class, 'change'])->name('school');


    Route::get('invoice-list', [InvoiceController::class, 'index'])->name('invoice_view');

    Route::get('invoice-create', [InvoiceController::class, 'create'])->name('generate_invoice');

    Route::post('active-student-for-invoice', [InvoiceController::class, 'acticeStudentForInvoice'])->name('active_student_for_invoice');

    Route::get('add-invoice', [InvoiceController::class, 'store'])->name('add_invoice'); 

    Route::get('view-invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.view');
    Route::get('print-invoice/{id}', [InvoiceController::class, 'print'])->name('invoice.print');





    Route::get('/data_table', function () {
      
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



// Route::get('change-db-connection', function () {

   
//    Cache::put('db-connection', request('connection','mysql'));
// });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// =============================================

