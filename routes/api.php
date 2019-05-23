<?php

use Illuminate\Http\Request;


Route::post('auth/login', 'AuthController@login');
Route::get('/information-home','InformationController@showAll');
Route::get('/download-home','DownloadController@showAll');
Route::get('/informasi/{slug}','InformationController@getBySlug');
Route::get('/download-file/{slug}/{fileToDownload}','DownloadController@downloadFile');
Route::get('/participant/statistic','ParticipantController@getParticipantStatistic');
Route::post('/test-save',function (){
   $task = \App\Models\SchedulesModel::all();

    return response(['test'=>$task],200);
});

Route::group(['middleware'=>'jwt.auth'],function (){
    Route::get('auth/user', 'AuthController@user');
    Route::post('user/change-password','AuthController@changePassword');

    Route::get('/user','UserController@showAll');
    Route::post('/user/create','UserController@create');
    Route::get('/user/{id}','UserController@read');
    Route::post('/user/update','UserController@update');
    Route::post('/user/{id}/delete','UserController@delete');
    Route::post('/user/update-profle','UserController@updateProfile');

    Route::get('/user-level','UserLevelController@showAll');
    Route::post('/user-level/create','UserLevelController@create');
    Route::get('/user-level/{id}','UserLevelController@read');
    Route::post('/user-level/update','UserLevelController@update');
    Route::post('/user-level/{id}/delete','UserLevelController@delete');

    Route::get('/position','PositionController@pagination');
    Route::get('/position/all','PositionController@showAll');
    Route::post('/position/create','PositionController@create');
    Route::get('/position/{id}','PositionController@read');
    Route::post('/position/update','PositionController@update');
    Route::post('/position/{id}/delete','PositionController@delete');

    Route::get('/contingent','ContingentController@pagination');
    Route::get('/contingent/all','ContingentController@showAll');
    Route::post('/contingent/create','ContingentController@create');
    Route::get('/contingent/{id}','ContingentController@read');
    Route::post('/contingent/update','ContingentController@update');
    Route::post('/contingent/{id}/delete','ContingentController@delete');

    Route::get('/participant','ParticipantController@pagination');
    Route::get('/participant-contingent/{contingentId}','ParticipantController@paginationByContingent');
    Route::get('/participant/all','ParticipantController@showAll');
    Route::post('/participant/create','ParticipantController@create');
    Route::get('/participant/{id}','ParticipantController@read');
    Route::post('/participant/update','ParticipantController@update');
    Route::post('/participant/{id}/delete','ParticipantController@delete');
    Route::post('/participant/upload-document','ParticipantController@uploadDocument');
    Route::post('/participant/delete-document','ParticipantController@deleteDocument');


    Route::get('/information','InformationController@showAll');
    Route::post('/information/create','InformationController@create');
    Route::get('/information/{id}','InformationController@read');
    Route::post('/information/update','InformationController@update');
    Route::post('/information/{id}/delete','InformationController@delete');
    Route::post('/information/upload-image','InformationController@uploadImage');

    Route::get('/download','DownloadController@showAll');
    Route::post('/download/create','DownloadController@create');
    Route::get('/download/{id}','DownloadController@read');
    Route::post('/download/update','DownloadController@update');
    Route::post('/download/{id}/delete','DownloadController@delete');
    Route::get('/download/{slug}','DownloadController@getBySlug');
    Route::post('/download/upload-download-document','DownloadController@uploadDownloadDocument');


    Route::get('/task-category','TaskCategoriesController@showAll');
    Route::post('/task-category','TaskCategoriesController@create');
    Route::get('/task-category/{uuid}','TaskCategoriesController@read');
    Route::put('/task-category/{uuid}','TaskCategoriesController@update');
    Route::delete('/task-category/{uuid}','TaskCategoriesController@delete');

    Route::get('/task','TasksController@showAll');
    Route::post('/task','TasksController@create');
    Route::get('/task/{uuid}','TasksController@read');
    Route::put('/task/{uuid}','TasksController@update');
    Route::delete('/task/{uuid}','TasksController@delete');
    Route::get('/task-non-masal','TasksController@getValuationNonMasal');

    Route::get('/schedule','SchedulesController@showAll');
    Route::post('/schedule','SchedulesController@create');
    Route::get('/schedule/{uuid}','SchedulesController@read');
    Route::put('/schedule/{uuid}','SchedulesController@update');
    Route::delete('/schedule/{uuid}','SchedulesController@delete');
    Route::get('/schedule-valuation/all','SchedulesController@getScheduleValuationAll');
    Route::get('/schedule-valuation/{uuid}','SchedulesController@getScheduleValuationFiltered');


    Route::post('/participant-task','ParticipantTasksController@create');
    Route::get('/participant-task/{contingentId}','ParticipantTasksController@getParticipantTaskByContingent');

});

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');

});