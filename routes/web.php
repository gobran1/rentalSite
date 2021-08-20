<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentWayController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Property;
use App\PostCard;
use App\PostCardSendService;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/properties', [PropertyController::class, 'store'])
    ->name('properties.store');

Route::get('/my-properties', [PropertyController::class, 'fetchUserProperties'])
    ->name('my-properties.index');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/property-item',function () {
    return view('components.property-item',['property' => Property::with('user','media','features')->first()]);
});

Route::get('/property-items',function () {
    return view('components.property-items',['properties' => Property::with('user','media','features')->get()]);
});
Route::get('/properties',function () {
    return view('property.index',['properties' => Property::with('user','media','features')->get(),'features' => \App\Models\Feature::get()]);
});
