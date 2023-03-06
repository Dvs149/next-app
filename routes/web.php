<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\FeedbackController;
use App\Http\Controllers\admin\UserImportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect('admin');
});
Route::get('/test', function () {
    return view('admin.empty_template');
});
Route::prefix('admin')->group(function () {
    // admin panel
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'user_list'])->name('admin.user');
            // Route::get('/profile/edit', [UserController::class, 'update_profile'])->name('admin.user.profile.edit');
            Route::get('/add', [UserController::class, 'add_user'])->name('admin.user.add');
            Route::post('/add', [UserController::class, 'create_user'])->name('admin.user.create');
            Route::get('/edit/{user_id}', [UserController::class, 'edit_user'])->name('admin.user.edit');
            Route::get('/view/{id}', [UserController::class, 'view_user'])->name('admin.user.edit');
            Route::post('/edit/{user}', [UserController::class, 'update_user'])->name('admin.user.update');
            Route::post('/suspend/{id}', [UserController::class, 'suspend_user'])->name('admin.user.suspend');
            Route::delete('/delete/{id}', [UserController::class, 'delete_user'])->name('admin.user.edit');
            Route::delete('/delete/photo/{id}/{pid}', [UserController::class, 'delete_photo_gallery'])->name('admin.user.photo.gallery');
            Route::post('/import', [UserImportController::class, 'user_import'])->name('admin.user.import.excel');
            Route::get('/export', [UserImportController::class, 'fileExport'])->name('admin.user.export.excel');
            Route::get('/feedback', [FeedbackController::class, 'feedback_list'])->name('admin.feedback');
            // Route::get('/feedback/edit/{feedback_id}', [FeedbackController::class, 'feedback_edit'])->name('admin.feedback.edit');
            Route::get('/feedback/view/{feedback_id}', [FeedbackController::class, 'feedback_view'])->name('admin.feedback.view');
        });
    });

    // admin route for authentication
    Route::get('/login', [AuthController::class, 'loginForm'])
        ->middleware('guest')
        ->name('login');
    Route::get('/registration', [AuthController::class, 'registrationForm'])
        ->middleware('guest')
        ->name('registration');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
        ->middleware('guest')
        ->name('password.email');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')
        ->get('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
