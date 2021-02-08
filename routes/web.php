<?php

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


use Illuminate\Support\Facades\Storage;

Route::get('/data', function() {

    $contents = Storage::disk('local')->get('robarcko.txt');
    $decodedText = html_entity_decode($contents);
    dd($decodedText);
    $data = json_decode($decodedText, true);
    echo json_last_error();
    dd($data);
});


Route::get('/demo', [\App\Http\Controllers\DemoController::class,'index']);
Route::get('/demo1', [\App\Http\Controllers\DemoController::class,'search']);