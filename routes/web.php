<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Feeds
    Route::delete('feeds/destroy', 'FeedsController@massDestroy')->name('feeds.massDestroy');
    Route::post('feeds/media', 'FeedsController@storeMedia')->name('feeds.storeMedia');
    Route::post('feeds/ckmedia', 'FeedsController@storeCKEditorImages')->name('feeds.storeCKEditorImages');
    Route::resource('feeds', 'FeedsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');

    // Journals
    Route::delete('journals/destroy', 'JournalsController@massDestroy')->name('journals.massDestroy');
    Route::post('journals/media', 'JournalsController@storeMedia')->name('journals.storeMedia');
    Route::post('journals/ckmedia', 'JournalsController@storeCKEditorImages')->name('journals.storeCKEditorImages');
    Route::resource('journals', 'JournalsController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::post('students/parse-csv-import', 'StudentsController@parseCsvImport')->name('students.parseCsvImport');
    Route::post('students/process-csv-import', 'StudentsController@processCsvImport')->name('students.processCsvImport');
    Route::resource('students', 'StudentsController');

    // Owner Fund Raiser
    Route::delete('owner-fund-raisers/destroy', 'OwnerFundRaiserController@massDestroy')->name('owner-fund-raisers.massDestroy');
    Route::post('owner-fund-raisers/media', 'OwnerFundRaiserController@storeMedia')->name('owner-fund-raisers.storeMedia');
    Route::post('owner-fund-raisers/ckmedia', 'OwnerFundRaiserController@storeCKEditorImages')->name('owner-fund-raisers.storeCKEditorImages');
    Route::resource('owner-fund-raisers', 'OwnerFundRaiserController');

    // Donor Fund Raiser
    Route::delete('donor-fund-raisers/destroy', 'DonorFundRaiserController@massDestroy')->name('donor-fund-raisers.massDestroy');
    Route::resource('donor-fund-raisers', 'DonorFundRaiserController');

    // Scholarship
    Route::delete('scholarships/destroy', 'ScholarshipController@massDestroy')->name('scholarships.massDestroy');
    Route::post('scholarships/media', 'ScholarshipController@storeMedia')->name('scholarships.storeMedia');
    Route::post('scholarships/ckmedia', 'ScholarshipController@storeCKEditorImages')->name('scholarships.storeCKEditorImages');
    Route::resource('scholarships', 'ScholarshipController');

    // Rate Journal
    Route::delete('rate-journals/destroy', 'RateJournalController@massDestroy')->name('rate-journals.massDestroy');
    Route::resource('rate-journals', 'RateJournalController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
