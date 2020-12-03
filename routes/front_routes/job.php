<?php

Route::get('job/{slug}', 'Job\JobController@jobDetail')->name('job.detail');
Route::get('apply/{slug}', 'Job\JobController@applyJob')->name('apply.job');
Route::post('apply/{slug}', 'Job\JobController@postApplyJob')->name('post.apply.job');
Route::get('jobs', 'Job\JobController@jobsBySearch')->name('job.list');
Route::get('add-to-favourite-job/{job_slug}', 'Job\JobController@addToFavouriteJob')->name('add.to.favourite');
Route::get('remove-from-favourite-job/{job_slug}', 'Job\JobController@removeFromFavouriteJob')->name('remove.from.favourite');
Route::get('my-job-applications', 'Job\JobController@myJobApplications')->name('my.job.applications');
Route::get('my-favourite-jobs', 'Job\JobController@myFavouriteJobs')->name('my.favourite.jobs');
/** Job Type View */
/************************* */
Route::get('job-type', 'Job\JobPublishController@viewJobType')->name('job.type');
/** Hot Job */
Route::get('jobs/{slug}', 'Job\JobController@hotJobDetail')->name('hot.job.detail');
Route::get('post-hot-job', 'Job\JobPublishController@createHotJob')->name('post.hot.job');
Route::post('store-hot-job', 'Job\JobPublishController@storeHotJob')->name('store.hot.job');
Route::get('edit-hot-job/{id}', 'Job\JobPublishController@editHotJob')->name('edit.hot.job');
Route::put('update-hot-job/{id}', 'Job\JobPublishController@updateHotJob')->name('update.hot.job');
Route::get('hot-jobs', 'Job\JobController@hotJobsBySearch')->name('hot.job.list');


/************************** */
Route::get('post-job', 'Job\JobPublishController@createFrontJob')->name('post.job');
Route::post('store-front-job', 'Job\JobPublishController@storeFrontJob')->name('store.front.job');
Route::get('edit-front-job/{id}', 'Job\JobPublishController@editFrontJob')->name('edit.front.job');
Route::put('update-front-job/{id}', 'Job\JobPublishController@updateFrontJob')->name('update.front.job');
Route::delete('delete-front-job', 'Job\JobPublishController@deleteJob')->name('delete.front.job');


Route::post('submit-message', 'Job\SeekerSendController@submit_message')->name('submit-message');

Route::get('subscribe-alert', 'SubscriptionController@submitAlert')->name('subscribe.alert');
