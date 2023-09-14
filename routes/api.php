<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\ApiAuthController;
use App\Http\Controllers\User\DocumentManagementController;
use App\Http\Controllers\User\ProfileUserController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// route dengan auth user role admin
// Route::group(['middleware' => ['auth:sanctum','restrictRole:client'],'api'], function(){
//     Route::post('/logout',[ApiAuthController::class,'logout']);
//     Route::apiResource('/province', ProvinceController::class);
//     Route::apiResource('/category', CategoryController::class);
//     Route::apiResource('/product', ProductController::class);
//     Route::apiResource('/city', CityController::class);
//     Route::apiResource('/districs', DistricController::class);
//     Route::apiResource('/user', UserController::class);
//     Route::apiResource('/subdistrict', SubdistrictController::class);
//     Route::apiResource('/masterMarketPlace', MarketPlaceController::class);
//     Route::apiResource('/laporan', LaporanController::class);
//     Route::apiResource('/masterPriceList', MasterDataPricelistController::class);
//     Route::apiResource('/manajemenPembelian',ManajemenPembelianController::class);
//     Route::apiResource('/masterDataEkspedisi',MasterDataExpeditionController::class);
//     Route::apiResource('/notifikasi',NotificationController::class);
//     Route::apiResource('/masterKatalogWarna',MasterCatalogColorController::class);
//     Route::apiResource('/kategoriKatalogWarna',CategoryCatalogColorController::class);
//     Route::post('/updateProduct', [ProductController::class,'updateProduct']);

//     Route::post('/updateMarketplace/{id}', [MarketPlaceController::class,'updateMarketplace']);
//     Route::post('/updateEkspedisi',[MasterDataExpeditionController::class,'updateEkspedisi']);
//     Route::get('/detailCategory/{kode_kategori}', [CategoryController::class,'detailCategory']);
//     Route::get('/detailProduct/{product_id}', [ProductController::class,'detailProduct']);
//     Route::get('/detailMarketplace/{id}', [MarketPlaceController::class,'show']);
//     Route::post('/sendInvoice',[ManajemenPembelianController::class,'sendInvoice']);
//     Route::get('/lihatInvoice',[ManajemenPembelianController::class,'lihatInvoice']);
//     Route::delete('/deleteMarketPlace/{id}', [MarketPlaceController::class,'deleteMarketPlace']);
//     Route::post('/updatePricelist', [MasterDataPricelistController::class,'updatePricelist']);
//     Route::post('/verifikasiPembayaran',[ManajemenPembelianController::class,'verifikasiPembayaran']);
//     Route::post('/updateMasterKatalogWarna',[MasterCatalogColorController::class,'updateKatalogWarna']);
//     Route::get('/downloadLaporan',[LaporanController::class,'downloadLaporan']);
//     Route::get('/kodeKategori',[ProductController::class,'kodeKategori']);
//     Route::get('/kodeK3l',[ProductController::class,'kodeK3l']);
//     Route::get('/kodeWarna',[ProductController::class,'kodeWarna']);
//     Route::get('/getKategori',[MasterCatalogColorController::class,'dataKategori']);



// });

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/profileUser', ProfileUserController::class);
    Route::apiResource('/docManagement', DocumentManagementController::class);
    Route::post('/logout',[ApiAuthController::class,'logout']);
    Route::post('/updateProfile', [ProfileUserController::class,'updateData']);
    Route::post('/updateDocManagement', [DocumentManagementController::class,'updateData']);
});
Route::post('/register',[ApiAuthController::class,'register']);
Route::post('/login',[ApiAuthController::class,'login']);





