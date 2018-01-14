<?php

Route::get('/ajax-distritos', 'ApiController@ajax_distritos');

Route::get('/ajax-corregimientos', 'ApiController@ajax_corregimientos');

Route::get('/user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Route::get('/email-confirmed', 'Auth\LoginController@email_confirmed');

Route::get('/terms-and-conditions', 'HelpController@terms');

Route::get('/privicy-policy', 'HelpController@privacy');

Route::get('/disclaimer', 'HelpController@disclaimer');

Route::get('/', function () {

    if(Auth::check()){

        if(Auth::user()->hasRole('Paciente')) return redirect('/home');

        if(Auth::user()->hasRole('Medico')) return redirect('/show-patients');

        if(Auth::user()->hasRole('Administrador')) return redirect('show-doctors');
    }

    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['paciente']], function () {

        Route::get('/home', 'PacienteController@index');

        Route::get('/new-measurement', 'BloodPressureController@new_measurement');

        Route::get('/show-measurements', 'BloodPressureController@show_measurements');

        Route::post('/store_blood_pressure', 'BloodPressureController@store_blood_pressure');

        Route::get('/trends-of-blood-pressure', 'PacienteController@show_trends_bp');

        Route::get('/new-weight', 'PacienteController@new_weight');

        Route::post('/store-weight', 'PacienteController@store_weight');

        Route::get('/show-weights', 'PacienteController@show_weights');

        Route::get('/trends-of-weights', 'PacienteController@show_trends_weights');

        Route::get('/profile', 'PacienteController@profile');

        Route::post('/profile', 'PacienteController@update_profile');

        Route::get('/change-password', 'PacienteController@change_password');

        Route::post('/update-password', 'PacienteController@update_password');

        Route::get('/edit-hta/{id}', 'BloodPressureController@show_hta');

        Route::post('/update-hta', 'BloodPressureController@update_hta');

        Route::get('/delete-hta/{id}', 'BloodPressureController@delete_hta');

        Route::get('/edit-peso/{id}', 'PacienteController@edit_weight');

        Route::post('/update-peso', 'PacienteController@update_weight');

        Route::get('/delete-peso/{id}', 'PacienteController@delete_weight');

        Route::get('/new-waist', 'PacienteController@new_waist');

        Route::get('/show-waist', 'PacienteController@show_waist');

        Route::post('/store-waist', 'PacienteController@store_waist');

        Route::get('/trends-of-waist', 'PacienteController@show_trends_waists');

        Route::get('/edit-cintura/{id}', 'PacienteController@edit_waist');

        Route::post('/update-cintura', 'PacienteController@update_waist');

        Route::get('/delete-cintura/{id}', 'PacienteController@delete_waist');

    });

    Route::group(['middleware' => ['medico']], function () {

        Route::get('/panel', 'DoctorController@index');

        Route::get('/show-patients', 'DoctorController@show_patients');

        Route::get('/add-patient', 'DoctorController@add_patient');

        Route::post('/store-patient', 'DoctorController@store_patient');

        Route::get('/show-patient/{id}', 'DoctorController@show_patient_info');

        Route::get('/new-hta/{id}', 'DoctorController@new_hta');

        Route::post('/store_hta', 'DoctorController@store_hta');

        Route::get('/edit-hta-by-doc/{id}', 'DoctorController@edit_hta');

        Route::post('/update-hta-by-doc', 'DoctorController@update_hta');

        Route::get('/delete-hta-by-doc/{id}', 'DoctorController@delete_hta');

        Route::get('/new-weight-by-doc/{id}', 'DoctorController@new_weight');

        Route::post('/store-weight-by-doc', 'DoctorController@store_weight');

        Route::get('/edit-weight-by-doc/{id}', 'DoctorController@edit_weight');

        Route::post('/update-weight-by-doc', 'DoctorController@update_weight');

        Route::get('/delete-weight-by-doc/{id}', 'DoctorController@delete_weight');

        Route::get('/new-waist-by-doc/{id}', 'DoctorController@new_waist');

        Route::post('/store-waist-by-doc', 'DoctorController@store_waist');

        Route::get('/edit-waist-by-doc/{id}', 'DoctorController@edit_waist');

        Route::post('/update-waist-by-doc', 'DoctorController@update_waist');

        Route::get('/delete-waist-by-doc/{id}', 'DoctorController@delete_waist');

    });

    Route::group(['middleware' => ['admin']], function () {

        Route::get('/dashboard', 'AdminController@index');

        Route::get('/new-doctor', 'AdminController@new_doctor');

        Route::post('/store-doctor', 'AdminController@store_doctor');

        Route::get('/show-doctors', 'AdminController@show_doctors');

    });
});


