<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Feeds
    Route::post('feeds/media', 'FeedsApiController@storeMedia')->name('feeds.storeMedia');
    Route::apiResource('feeds', 'FeedsApiController');

    // Comments
    Route::apiResource('comments', 'CommentsApiController');

    // Journals
    Route::post('journals/media', 'JournalsApiController@storeMedia')->name('journals.storeMedia');
    Route::apiResource('journals', 'JournalsApiController');

    // Events
    Route::apiResource('events', 'EventsApiController');

    // Students
    Route::post('students/media', 'StudentsApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentsApiController');

    // Owner Fund Raiser
    Route::post('owner-fund-raisers/media', 'OwnerFundRaiserApiController@storeMedia')->name('owner-fund-raisers.storeMedia');
    Route::apiResource('owner-fund-raisers', 'OwnerFundRaiserApiController');

    // Donor Fund Raiser
    Route::apiResource('donor-fund-raisers', 'DonorFundRaiserApiController');

    // Scholarship
    Route::post('scholarships/media', 'ScholarshipApiController@storeMedia')->name('scholarships.storeMedia');
    Route::apiResource('scholarships', 'ScholarshipApiController');

    // Rate Journal
    Route::apiResource('rate-journals', 'RateJournalApiController');
});
