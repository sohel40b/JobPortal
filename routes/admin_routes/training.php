<?php

Route::get('list-training', array_merge(['uses' => 'Admin\TrainingController@indexTraining'], $all_users))->name('list.training');
Route::get('create-training', array_merge(['uses' => 'Admin\TrainingController@createTraining'], $all_users))->name('create.training');
Route::post('store-training', array_merge(['uses' => 'Admin\TrainingController@storeTraining'], $all_users))->name('store.training');
Route::get('edit-training/{id}', array_merge(['uses' => 'Admin\TrainingController@editTraining'], $all_users))->name('edit.training');
Route::put('update-training/{id}', array_merge(['uses' => 'Admin\TrainingController@updateTraining'], $all_users))->name('update.training');
Route::delete('delete-training', array_merge(['uses' => 'Admin\TrainingController@deleteTraining'], $all_users))->name('delete.training');
Route::get('fetch-training', array_merge(['uses' => 'Admin\TrainingController@fetchTrainingData'], $all_users))->name('fetch.data.training');

