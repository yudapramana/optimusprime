<?php

use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\AcademicSemesterController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\Verification\PaymentVerificationController;
use App\Http\Controllers\Admin\Verification\StudentVerificationController;
use App\Http\Controllers\Student\InstallmentController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ReceiptSignatureController;
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

// Route::get('/home', function () {
//     return view('student.home');
// });

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

// Route::group(['middleware' => ['auth', 'user-access:student']], function(){
//     Route::get('/installments/create', [InstallmentController::class, 'create'])->name('installments.create');
//     Route::post('/installments', [InstallmentController::class, 'store'])->name('installments.store');
// });

Route::middleware(['auth',  'user-access:student', 'student.verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/installments/create', [InstallmentController::class, 'create'])->name('installments.create');
    Route::post('/installments', [InstallmentController::class, 'store'])->name('installments.store');

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('{payment}/show', [PaymentController::class, 'show'])->name('show');
        Route::get('{payment}/edit', [PaymentController::class, 'edit'])->name('edit');
        Route::post('{payment}/update', [PaymentController::class, 'update'])->name('update');
        // Generate Receipt
        Route::get('{payment}/receipt', [PaymentController::class, 'generateReceipt'])->name('receipt');
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'user-access:admin']], function(){
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    Route::prefix('master')->group(function () {
        Route::resource('academic_semesters', AcademicSemesterController::class);
        Route::resource('faculties', FacultyController::class);
        Route::resource('banks', BankController::class);
        Route::resource('three_installment_criterias', App\Http\Controllers\Admin\ThreeInstallmentCriteriaController::class)->except(['show']);
        Route::resource('receipt_signatures', ReceiptSignatureController::class)->except(['show'])->names('receipt_signatures');

    });

    Route::prefix('data')->group(function () {
        Route::resource('students', StudentController::class);
        Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    });

    Route::prefix('verify')->group(function () {
        Route::get('students/', [StudentVerificationController::class, 'index'])->name('students.verification.index');
        Route::put('students/{student}', [StudentVerificationController::class, 'update'])->name('students.verification.update');

        Route::get('/payments', [PaymentVerificationController::class, 'index'])->name('payments.verification.index');
        // Route::post('/payments/{payment}', [PaymentVerificationController::class, 'update'])->name('payments.verification.update');
        Route::put('/payments/{payment}', [PaymentVerificationController::class, 'verify'])->name('payments.verify');
    });


    


});

