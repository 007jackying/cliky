<?php

use Illuminate\Http\Request;

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

Route::post('register','APIController@register')->name('register');
Route::get('topRetailers','APIController@topRetailers')->name('topRetailers');
Route::get('topOffers','APIController@topOffers')->name('topOffers');
Route::get('offers/{retailer?}/{department?}/{type?}/{price?}/{discount?}','APIController@offers')->name('offers');
Route::get('countOffer','APIController@getOfferCount')->name('countOffer');
Route::group(['middleware'=>'auth.basic'],function() {
    Route::get('me','APIController@me')->name('me');
    Route::get('retailers','APIController@retailers')->name('retailers');
    Route::get('departments','APIController@departments')->name('departments');
    Route::get('types','APIController@types')->name('types');
});
