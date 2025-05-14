<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
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
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/students/pdf/download', [StudentController::class, 'download'])->name('students.download');
    Route::resource('/students', StudentController::class)->names('students');   
    //Route::resource('/teachers', TeacherCOntroller::class)->names('teachers'); 
    //Route::resource('/staffs', StaffController::class)->names('staffs');    

});

Route::middleware(['auth','isAdmin'])->group(function () {
    
    Route::get('/admin', [AdminController::class,'index'])->name('admin');   
    
});



// Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');


Route::get('students/{id}/payments/create', [StudentController::class, 'makePayment'])->name('students.payments.create');
Route::post('students/{id}/payments', [StudentController::class, 'storePayment'])->name('students.payments.store');


Route::resource('/courses', CourseController::class)->names('courses');





Route::get('/send-email', function () {
    $details = "This is a test email from Laravel.";
    Mail::to('haseeb.net@gmail.com')->queue(new TestMail($details));

    return "Email sent!";
});
