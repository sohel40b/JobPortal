<?php

//login route
Route::get('/signin', 'Training\Auth\LoginController@signin')->name('signin');
Route::post('/training-login', 'Training\Auth\LoginController@trainingLogin');

//registration route
Route::get('/signup', 'Training\Auth\RegisterController@signup')->name('signup');
Route::post('/training-register', 'Training\Auth\RegisterController@createStudent');

//logout route
Route::get('/logout', 'Training\Auth\LoginController@loggedOut')->name('training.logout');