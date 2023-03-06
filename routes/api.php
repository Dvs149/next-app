<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\RewardPointController;
use App\Http\Controllers\TestBitlinkController;
use App\Http\Controllers\BusinessInfoController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\PremiumPlansController;
use App\Http\Controllers\TeamColleaguesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/premium_plans', [PremiumPlansController::class, 'premium_plans']);
Route::get('/rewards_points', [RewardPointController::class, 'rewards_points']);
Route::get('/country_code', [CountryCodeController::class, 'country_code']);

Route::get('/get_business_info/profile_info/{u_id}', [BusinessInfoController::class, 'get_business_info'])->name('get_business_info');
Route::get('/get_business_info/team_and_colleagues_info/{u_id}', [BusinessInfoController::class, 'tac_info'])->name('tac_info');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user',[AuthController::class, 'user'])->name('user');

Route::post('/forgot-password',[AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::post('/reset-password',[AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_otp', [AuthController::class, 'create_otp']);
Route::post('/login_mobile', [AuthController::class, 'login_mobile']);
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/setting-details', [SettingController::class, 'setting'])->name('setting');
    Route::post('/setting', [SettingController::class, 'edit_setting'])->name('edit_setting');
    Route::post('/change_password', [SettingController::class, 'change_password'])->name('change_password');
    
    Route::post('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');
    
    Route::get('/get_theme_color', [ThemeController::class, 'get_theme_color'])->name('get_theme_color');
    Route::post('/edit_theme_color', [ThemeController::class, 'edit_theme_color'])->name('edit_theme_color');
    
    Route::get('/get_team_colleagues_data', [TeamColleaguesController::class, 'get_team_colleagues_data'])->name('get_team_colleagues_data');
    Route::post('/save_team_colleague', [TeamColleaguesController::class, 'save_team_colleague'])->name('save_team_colleague');
    Route::get('/search_name/{name}', [TeamColleaguesController::class, 'search_team_colleague_name'])->name('search_team_colleague_name');
    Route::get('/delete_colleague/{u_id}', [TeamColleaguesController::class, 'delete_team_mate'])->name('delete_team_mate');
    
    Route::get('/users_rewards_points', [RewardPointController::class, 'users_rewards_points'])->name('users_rewards_points');
    
    Route::get('/get_profile_data', [ProfileController::class, 'get_profile_data'])->name('get_profile_data');
    Route::post('/save_profile_data', [ProfileController::class, 'save_profile_data'])->name('save_profile_data');
    Route::post('/save_media', [ProfileController::class, 'save_media'])->name('save_media');

    Route::get('/delete_photo_gallery/{delete_photo_id}', [PhotoGalleryController::class, 'delete_photo_galary'])->name('delete_photo_galary');

    

    
    // testing purpose only
    Route::post('/test', [TestController::class, 'test'])->name('test');
    Route::post('/bitlytest', [TestBitlinkController::class, 'test'])->name('test');
});






Route::get('/tst', [TestController::class, 'tst'])->name('tst');
Route::get('/url_shortner', [TestController::class, 'shortner'])->name('shortner');

