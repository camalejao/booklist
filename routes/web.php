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

Route::get('/', function () {
    return view('index');
});

Route::get('/livro/{id}', function () {
    return view('livro');
});

Route::get('/autores', function () {
    return view('autores');
});

Route::get('/autor/{id}', function () {
    return view('autor');
});

Route::resource('/api/livros', 'LivrosController');

Route::resource('/api/autores', 'AutoresController', ['parameters' => ['autores' => 'autor']]);

Route::get('/api/autores-livros', 'AutoresController@indexWithBooks');


//Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

