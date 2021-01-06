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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'CompaniesController@index');
Route::resource('companies', 'CompaniesController');
Route::get('/getall', 'CompaniesController@getall')->name('getall.companies');
Route::resource('employees', 'EmployeesController');
Route::get('/getallemployees', 'EmployeesController@getallemployees')->name('getallemployees.employees');


