<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('phonebook');
});

//Route::get('/{name}', function () {
//    return redirect('/');
//})->where('name', '[A-Za-z]+');

Route::get('/{vue_capture?}', function () {
    return redirect('/');
})->where('vue_capture', '[\/\w\.-]*');

Route::resource('phonebook', 'PhonebookController');
Route::post('test', 'PhonebookController@test');
Route::post('get-phonebooks', 'PhonebookController@getData');
//Route::post('get-pagination', 'PhonebookController@getBooks');
Route::post('get-search', 'PhonebookController@getSearch');