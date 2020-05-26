<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource("student","studentController");

Route::get("/ajaxdata","AjaxdataController@index")->name("ajaxdata");
Route::get('ajaxdata/getData',"AjaxdataController@getData")->name("ajaxdata.getData");
Route::post('ajaxdata/postData',"AjaxdataController@postData")->name("ajaxdata.postData");
Route::get('ajaxdata/fetchData',"AjaxdataController@fetchData")->name("ajaxdata.fetchData");


Route::get('/uploadfile', 'UploadfileController@index');
Route::post('/uploadfile', 'UploadfileController@upload');


