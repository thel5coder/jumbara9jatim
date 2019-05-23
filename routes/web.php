<?php
Route::any('/{all}', function () {
    return view('main');
})->where(['all'=>'.*']);
