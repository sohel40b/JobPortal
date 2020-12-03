<?php

Route::get('/training-home', 'Training\TrainingController@index')->name('training.home');
Route::get('/training-details', 'Training\TrainingController@trainingDetail')->name('training.detail');
//Route::get('/training-listing', 'Training\TrainingController@training_listing')->name('training.listing');
