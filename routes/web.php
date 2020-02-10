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

//Admin
Route::group(['middleware' => ['auth', 'unit', 'level:3'], 'prefix' => 'admin'], function(){

	Route::resource('units', 'UnitController')->except('show');
	Route::get('educations/unit/{unit}', 'EducationController@filter')->name('educations.filter');
	Route::resource('educations', 'EducationController')->except('show');

});

//Onderwijsco en hoger
Route::group(['middleware' => ['auth', 'unit', 'level:2'], 'prefix' => 'coord'], function(){

	Route::get('tracks/education/{education}', 'TrackController@filter')->name('tracks.filter');
	Route::resource('tracks', 'TrackController');
	Route::resource('terms', 'TermController');
	Route::resource('rating_scales', 'RatingScaleController');

});

//Docent en hoger
Route::group(['middleware' => ['auth', 'unit', 'level:1']], function(){

	Route::get('/', 'DashboardController@show')->name('home');

});

// No unit
Route::group(['middleware' => ['auth', 'level:1']], function(){
	Route::get('/unit', 'DashboardController@unit')->name('unit');
});
Route::group(['middleware' => ['auth', 'level:3'], 'prefix' => 'admin'], function(){
	Route::get('users/unit/{unit}', 'UserController@filter')->name('users.filter');
	Route::resource('users', 'UserController')->except(['create', 'store', 'show']);
});


// Students
Route::group(['middleware' => 'auth', 'prefix' => 'student', 'namespace' => 'Student'], function(){

	Route::get('/', 'DashboardController@show')->name('student');
	Route::get('/u/{user}', 'DashboardController@show')->name('student.u');

});


// AMOlogin
Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');	

Route::get('/amoclient/ready', function(){
	return redirect()->route('home');
});

Route::get('/logout', function(){
	return redirect('/amoclient/logout');;
})->name('logout');
