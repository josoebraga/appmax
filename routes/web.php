<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

/* Rotas do Produto */

Route::get('/product',['as'=>'product','uses'=>'ProductController@index']);
Route::get('/product/data',['as'=>'productData','uses'=>'ProductController@productData']);
Route::get('/product/create',['as'=>'productCreate','uses'=>'ProductController@create']);
Route::post('/product/store',['as'=>'productStore','uses'=>'ProductController@store']);
Route::get('/product/show/{id}',['as'=>'productShow','uses'=>'ProductController@show']);
Route::post('/product/update',['as'=>'productUpdate','uses'=>'ProductController@update']);
Route::get('/product/destroy/{id}',['as'=>'productDelete','uses'=>'ProductController@destroy']);

/* Rotas de Baixar Produto */

Route::get('/productSendCreateManual/{id}',['as'=>'productSendCreateManual','uses'=>'ProductSendController@create']);
Route::post('/productSendManual',['as'=>'productSendManual','uses'=>'ProductSendController@store']);

/* Rotas dos relatórios */

Route::get('/product/report',['as'=>'productReport','uses'=>'ProductReportController@index']);


