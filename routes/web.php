<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

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

//Route for All the listings
// Route::get('/', function () {
//     return view('listings',[
//         'heading' => 'Latest listings',
//         'listings' => listing::all()
//     ]);
// });

//Route for Single listings
// Route::get('/listing/{id}', function ($id){
//     return view('listing',[
//         'listing' =>Listing::find($id)
//     ]);
// });

// Alternate way while using eloquent
// Route::get('/listing/{listing}', function(listing $id){
//     return view('listing',[
//         'listing' => $id
//     ]);
// });


// //Route for Single listings
// // Route::get('/listing/{id}', function ($id){
// //     return view('listing',[
// //         'listing' =>Listing::find($id)
// //     ]);
// // });

// // Alternate way while using 

// Show all job listing
Route::get('/', [ListingController::class, 'index']);

// Create Job
Route::get('/listings/create', [ListingController::class, 'create']);

Route::post('/listings', [ListingController::class, 'store']);

// Single Job Lising
Route::get('/listings/{listing}', [ListingController::class, 'show']);
