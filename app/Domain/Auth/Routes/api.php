<?php

Route::group(['prefix'=>'auth'], function() {
    Route::post('/login', 'AuthController@login');
});
