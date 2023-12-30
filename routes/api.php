<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\ReservationOrderController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Auth APIs
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('change-password/{user}', [AuthController::class, 'changePassword'])->middleware('auth:sanctum');


// Categories APIs
Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::post('categories/{category}', [CategoryController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);


// Sites APIs
// Route::get('sites', [CategoryController::class, 'index']); // list of sites included in show category
Route::post('categories/{category}/sites', [SiteController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('sites/{site}', [SiteController::class, 'show']);
Route::post('sites/{site}', [SiteController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('sites/{site}', [SiteController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);


// Journeys APIs
// Route::get('journeys', [JourneyController::class, 'index']); // list of journeys included in show sites
Route::post('sites/{site}/journeys', [JourneyController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('journeys/{journey}', [JourneyController::class, 'show']);
Route::put('journeys/{journey}', [JourneyController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('journeys/{journey}', [JourneyController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);


// Reservation Order APIs
Route::get('reservation-orders', [ReservationOrderController::class, 'index'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('journeys/{journey}/reservation-orders', [ReservationOrderController::class, 'journeyReservations'])->middleware(['auth:sanctum', 'role:admin']);
Route::post('journeys/{journey}/reservation-orders/customer', [ReservationOrderController::class, 'storeCustomerReservationOrder']);
Route::post('journeys/{journey}/reservation-orders/company', [ReservationOrderController::class, 'storeCompanyReservationOrder'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('reservation-orders/statistics', [ReservationOrderController::class, 'statistics'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('reservation-orders/{reservationOrder}', [ReservationOrderController::class, 'show'])->middleware(['auth:sanctum', 'role:admin']);
// Route::put('reservation-orders/{reservationOrder}/company', [ReservationOrderController::class, 'updateCompanyReservationOrder']);
// Route::put('reservation-orders/{reservationOrder}/customer', [ReservationOrderController::class, 'updateCustomerReservationOrder']);
Route::delete('reservation-orders/{reservationOrder}', [ReservationOrderController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);

Route::put('change-reservation-orders-status/{reservationOrder}', [ReservationOrderController::class, 'ChangeReservationJourneyStatus'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('reservation-orders/seat-details/{individualJourneySeat}', [ReservationOrderController::class, 'seatDetails'])->middleware(['auth:sanctum', 'role:admin']);


// Delivery Order APIs
Route::get('delivery-orders', [DeliveryOrderController::class, 'index'])->middleware(['auth:sanctum', 'role:admin']);
Route::post('reservation-orders/{reservationOrder}/delivery-orders', [DeliveryOrderController::class, 'store']);
Route::post('delivery-orders/{deliveryOrder}', [DeliveryOrderController::class, 'acceptDeliveryOrder'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('delivery-orders/{deliveryOrder}', [DeliveryOrderController::class, 'show'])->middleware(['auth:sanctum', 'role:admin']);
// Route::put('delivery-orders/{deliveryOrder}', [DeliveryOrderController::class, 'update']);
// Route::delete('delivery-orders/{deliveryOrder}', [DeliveryOrderController::class, 'destroy']);

Route::get('driver-delivery-orders', [DeliveryOrderController::class, 'driverDeliveryOrderList'])->middleware(['auth:sanctum', 'role:driver']);
Route::get('driver-delivery-orders/{deliveryOrder}', [DeliveryOrderController::class, 'driverDeliveryOrderShow'])->middleware(['auth:sanctum', 'role:driver']);
Route::put('change-driver-delivery-orders-status/{deliveryOrder}', [DeliveryOrderController::class, 'changeDeliveryOrderStatus'])->middleware(['auth:sanctum', 'role:driver']);


// Settings APIs
Route::get('settings', [SettingController::class, 'show']);
Route::post('settings', [SettingController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::put('settings', [SettingController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);


// Notifications APIs
Route::get('notifications', [NotificationController::class, 'index']);
Route::post('notifications', [NotificationController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('notifications/{notification}', [NotificationController::class, 'show']);
Route::post('notifications/{notification}', [NotificationController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);


// Drivers APIs
Route::get('drivers', [DriverController::class, 'index'])->middleware(['auth:sanctum', 'role:admin']);
Route::post('drivers', [DriverController::class, 'store'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('drivers/{driver}', [DriverController::class, 'show'])->middleware(['auth:sanctum', 'role:admin']);
Route::put('drivers/{driver}', [DriverController::class, 'update'])->middleware(['auth:sanctum', 'role:admin']);
Route::delete('drivers/{driver}', [DriverController::class, 'destroy'])->middleware(['auth:sanctum', 'role:admin']);
