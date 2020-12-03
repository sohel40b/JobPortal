<?php

Route::get('list-resource-person', array_merge(['uses' => 'Admin\ResourcePersonController@indexResourcePerson'], $all_users))->name('list.resource.person');
Route::get('create-resource-person', array_merge(['uses' => 'Admin\ResourcePersonController@createResourcePerson'], $all_users))->name('create.resource.person');
Route::post('store-resource-person', array_merge(['uses' => 'Admin\ResourcePersonController@storeResourcePerson'], $all_users))->name('store.resource.person');
Route::get('edit-resource-person/{id}', array_merge(['uses' => 'Admin\ResourcePersonController@editResourcePerson'], $all_users))->name('edit.resource.person');
Route::put('update-resource-person/{id}', array_merge(['uses' => 'Admin\ResourcePersonController@updateResourcePerson'], $all_users))->name('update.resource.person');
Route::delete('delete-resource-person', array_merge(['uses' => 'Admin\ResourcePersonController@deleteResourcePerson'], $all_users))->name('delete.resource.person');
Route::get('fetch-resource-person', array_merge(['uses' => 'Admin\ResourcePersonController@fetchResourcePersonData'], $all_users))->name('fetch.data.resource.person');

