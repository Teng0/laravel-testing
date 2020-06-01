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
Route::get('ajaxdata/delteData',"AjaxdataController@delteData")->name("ajaxdata.delteData");
Route::get('ajaxdata/massDelete',"AjaxdataController@massDelete")->name("ajaxdata.massDelete");


Route::get('/uploadfile', 'UploadfileController@index');
Route::post('/uploadfile', 'UploadfileController@upload');

Route::get("/main","MainController@index")->name("main");
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('/main/successlogin', 'MainController@successlogin');
Route::get('/main/logout', 'MainController@logout');
Route::post('/main/emailAvailable', 'MainController@emailAvailable')->name("MainController.emailAvailable");


Route::get('dynamic_dependent', 'DynamicDependent@index');
Route::post('dynamic_dependent/fetch', 'DynamicDependent@fetch')->name('dynamicdependent.fetch');


Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
Route::get('/live_search/export', 'LiveSearch@export')->name('live_search.export');
