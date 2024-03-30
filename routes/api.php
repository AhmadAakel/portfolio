<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\Dashboard\InfoController as DashboardInfoController;
use App\Http\Controllers\Api\Dashboard\AuthController as DashboardAuthController;
use App\Http\Controllers\Api\Dashboard\SocialController as DashboardSocialController;
use App\Http\Controllers\Api\Dashboard\ProjectController as DashboardProjectController;
use App\Http\Controllers\Api\Dashboard\ReviewController as DashboardReviewController;
use App\Http\Controllers\Api\Dashboard\ServiceController as DashboardServiceController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    //portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index']);
    //Services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{service}', [ServiceController::class, 'show']);
    //Projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    //Info
    Route::get('/infos', [InfoController::class, 'index']);
    //Socials
    Route::get('/socials', [SocialController::class, 'index']);
    //Reviews
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::get('/reviews/{review}', [ReviewController::class, 'show']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::post('/dashboard/login', [DashboardAuthController::class, 'login']);});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/dashboard/logout', [DashboardAuthController::class, 'logout']);
    //info
    Route::get('/dashboard/infos', [DashboardInfoController::class, 'index']);
    Route::post('/dashboard/infos', [DashboardInfoController::class, 'store']);
    Route::put('/dashboard/infos/{user}', [DashboardInfoController::class, 'update']);
    Route::delete('/dashboard/infos/{info}', [DashboardInfoController::class, 'destroy']);
     //services
     Route::get('/dashboard/services', [DashboardServiceController::class, 'index']);
     Route::get('/dashboard/services/{service}', [DashboardServiceController::class, 'show']);
     Route::post('/dashboard/services', [DashboardServiceController::class, 'store']);
     Route::put('/dashboard/services/{service}', [DashboardServiceController::class, 'update']);
     Route::delete('/dashboard/services/{service}', [DashboardServiceController::class, 'destroy']);
     // projects
     Route::get('/dashboard/projects', [DashboardProjectController::class, 'index']);
     Route::get('/dashboard/projects/{project}', [DashboardProjectController::class, 'show']);
     Route::post('/dashboard/projects', [DashboardProjectController::class, 'store']);
     Route::put('/dashboard/projects/{project}', [DashboardProjectController::class, 'update']);
     Route::delete('/dashboard/projects/{project}', [DashboardProjectController::class, 'destroy']);
     // Links
     Route::get('/dashboard/socials', [DashboardSocialController::class, 'index']);
     Route::get('/dashboard/socials/{social}', [DashboardSocialController::class, 'show']);
     Route::post('/dashboard/socials', [DashboardSocialController::class, 'store']);
     Route::put('/dashboard/socials/{social}', [DashboardSocialController::class, 'update']);
     Route::delete('/dashboard/socials/{social}', [DashboardSocialController::class, 'destroy']);
     // Reviews
     Route::get('/dashboard/reviews', [DashboardReviewController::class, 'index']);
     Route::get('/dashboard/reviews/{review}', [DashboardReviewController::class, 'show']);
     Route::delete('/dashboard/reviews/{review}', [DashboardReviewController::class, 'destroy']);
    });