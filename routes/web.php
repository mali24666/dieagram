<?php
 use App\Http\Controllers\admin\TranseformerController;
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
    Route::resource('users', 'UsersController');

    // Transeformer
    Route::delete('transeformers/destroy', 'TranseformerController@massDestroy')->name('transeformers.massDestroy');
    Route::post('transeformers/media', 'TranseformerController@storeMedia')->name('transeformers.storeMedia');
    Route::post('transeformers/ckmedia', 'TranseformerController@storeCKEditorImages')->name('transeformers.storeCKEditorImages');
    Route::resource('transeformers', 'TranseformerController');
    Route::get('transeformers/fetchTranse/{id}', 'TranseformerController@fetchTranse')->name('transeformers.fetchTranse');

    // Cb
    Route::delete('cbs/destroy', 'CbController@massDestroy')->name('cbs.massDestroy');
    Route::resource('cbs', 'CbController');

    // Minibller
    Route::delete('minibllers/destroy', 'MinibllerController@massDestroy')->name('minibllers.massDestroy');
    Route::post('minibllers/media', 'MinibllerController@storeMedia')->name('minibllers.storeMedia');
    Route::post('minibllers/ckmedia', 'MinibllerController@storeCKEditorImages')->name('minibllers.storeCKEditorImages');
    Route::resource('minibllers', 'MinibllerController');

    // Box
    Route::delete('boxes/destroy', 'BoxController@massDestroy')->name('boxes.massDestroy');
    Route::post('boxes/media', 'BoxController@storeMedia')->name('boxes.storeMedia');
    Route::post('boxes/ckmedia', 'BoxController@storeCKEditorImages')->name('boxes.storeCKEditorImages');
    Route::resource('boxes', 'BoxController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Bill
    Route::delete('bills/destroy', 'BillController@massDestroy')->name('bills.massDestroy');
    Route::resource('bills', 'BillController');

    // Allnote
    Route::delete('allnotes/destroy', 'AllnoteController@massDestroy')->name('allnotes.massDestroy');
    Route::resource('allnotes', 'AllnoteController', ['except' => ['show']]);

    // Minibllarnote
    Route::delete('minibllarnotes/destroy', 'MinibllarnoteController@massDestroy')->name('minibllarnotes.massDestroy');
    Route::resource('minibllarnotes', 'MinibllarnoteController', ['except' => ['show']]);

    // Lic
    Route::delete('lics/destroy', 'LicController@massDestroy')->name('lics.massDestroy');
    Route::post('lics/media', 'LicController@storeMedia')->name('lics.storeMedia');
    Route::post('lics/ckmedia', 'LicController@storeCKEditorImages')->name('lics.storeCKEditorImages');
    Route::resource('lics', 'LicController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::post('user-alerts/media', 'UserAlertsController@storeMedia')->name('user-alerts.storeMedia');
    Route::post('user-alerts/ckmedia', 'UserAlertsController@storeCKEditorImages')->name('user-alerts.storeCKEditorImages');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController');

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Esfelt
    Route::delete('esfelts/destroy', 'EsfeltController@massDestroy')->name('esfelts.massDestroy');
    Route::post('esfelts/media', 'EsfeltController@storeMedia')->name('esfelts.storeMedia');
    Route::post('esfelts/ckmedia', 'EsfeltController@storeCKEditorImages')->name('esfelts.storeCKEditorImages');
    Route::resource('esfelts', 'EsfeltController');

    // Close
    Route::delete('closes/destroy', 'CloseController@massDestroy')->name('closes.massDestroy');
    Route::post('closes/media', 'CloseController@storeMedia')->name('closes.storeMedia');
    Route::post('closes/ckmedia', 'CloseController@storeCKEditorImages')->name('closes.storeCKEditorImages');
    Route::resource('closes', 'CloseController');

    // Contractor
    Route::delete('contractors/destroy', 'ContractorController@massDestroy')->name('contractors.massDestroy');
    Route::post('contractors/media', 'ContractorController@storeMedia')->name('contractors.storeMedia');
    Route::post('contractors/ckmedia', 'ContractorController@storeCKEditorImages')->name('contractors.storeCKEditorImages');
    Route::resource('contractors', 'ContractorController');

    // Billcon
    Route::delete('billcons/destroy', 'BillconController@massDestroy')->name('billcons.massDestroy');
    Route::post('billcons/media', 'BillconController@storeMedia')->name('billcons.storeMedia');
    Route::post('billcons/ckmedia', 'BillconController@storeCKEditorImages')->name('billcons.storeCKEditorImages');
    Route::resource('billcons', 'BillconController');

    // Station
    Route::delete('stations/destroy', 'StationController@massDestroy')->name('stations.massDestroy');
    Route::resource('stations', 'StationController');

    // Line
    Route::delete('lines/destroy', 'LineController@massDestroy')->name('lines.massDestroy');
    Route::resource('lines', 'LineController');
    Route::get('/line/fetchfeeder/{id}', 'LineController@fetchfeeder')->name('lines.fetchfeeder');

    // Ct
    Route::delete('cts/destroy', 'CtController@massDestroy')->name('cts.massDestroy');
    Route::resource('cts', 'CtController');
    Route::get('/cts/fetchCt/{id}', 'CtController@fetchCt')->name('cts.fetchCt');

    // Diagram
    Route::delete('diagrams/destroy', 'DiagramController@massDestroy')->name('diagrams.massDestroy');
    Route::resource('diagrams', 'DiagramController');

    // Project
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectController');

    // Rmu
    Route::delete('rmus/destroy', 'RmuController@massDestroy')->name('rmus.massDestroy');
    Route::resource('rmus', 'RmuController');

    // Autorecloser
    Route::delete('autoreclosers/destroy', 'AutorecloserController@massDestroy')->name('autoreclosers.massDestroy');
    Route::resource('autoreclosers', 'AutorecloserController');

    // Section Lazy
    Route::delete('section-lazies/destroy', 'SectionLazyController@massDestroy')->name('section-lazies.massDestroy');
    Route::resource('section-lazies', 'SectionLazyController');

    // Avr
    Route::delete('avrs/destroy', 'AvrController@massDestroy')->name('avrs.massDestroy');
    Route::resource('avrs', 'AvrController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
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
 //project 
 Route::get('/pr', function () {
    return view('projects');
});

Route::apiResource('projects', ProjectController::class);
Route::get('projects/fetchTranc/{id}', 'ProjectController@fetchTranc')->name('project.fetchTranc');
Route::post('projects/ct_postion/{id}', 'ProjectController@ct_postion')->name('project.ct_postion');

