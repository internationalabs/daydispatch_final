<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\ApiControllers\WebsiteLeads;
use App\Http\Controllers\Api\NewListingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/Website-Leads', [WebsiteLeads::class, 'webLeads'])->name('Website.Leads.Api');

Route::post('/New-Listing', [NewListingController::class, 'create']);
