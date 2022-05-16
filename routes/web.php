<?php

use Illuminate\Support\Facades\Route;
use App\Models\listing;

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
Route::get('/', function () {
    return view('listings',[
        'heading' => 'Latest listings',
        'listings' => listing::all()
    ]);
});

//Route for Single listings
// Route::get('/listing/{id}', function ($id){
//     return view('listing',[
//         'listing' =>Listing::find($id)
//     ]);
// });

// Alternate way while using eloquent
Route::get('/listing/{id}', function(listing $id){
    return view('listing',[
        'listing' => $id
    ]);
});
