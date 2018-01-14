<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
$app = app();

$app->register(Dingo\Api\Provider\LaravelServiceProvider::class);

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

      $api->group(['namespace' => 'App\Http\Controllers'], function($api){

            $api->get('provincias', 'ApiController@ajax_provincia');

            $api->get('distritos/{id}', 'ApiController@ajax_distritos_movil');

            $api->get('corregimientos/{id}', 'ApiController@ajax_corregimientos_movil');

            $api->post('register', 'ApiController@store_user');

            $api->get('graph/{id}', 'ApiController@load_graph');

            $api->get('medidas/{id}', 'ApiController@medidas');

            $api->get('new-measurement', 'BloodPressureController@new_measurement');

            $api->get('medida/{id}', 'ApiController@medidasbyId');

            $api->post('nuevamedida', 'ApiController@nuevaMedida');

            $api->post('login', 'ApiController@LoginApi');

            $api->put('syncMedida','ApiController@update_blood_sync');

            $api->get('pesos/{id}','ApiController@show_weights');

            $api->get('peso/{id}','ApiController@get_peso_byId');

            $api->post('nuevo-peso','ApiController@nuevo_peso');

            $api->get('etnias', 'ApiController@ajax_etnia');

            $api->post('getEmail', 'ApiController@getEmail');

            $api->post('getUser', 'ApiController@getUser');

            $api->post('getSYNC', 'ApiController@get_no_sync');



            $api->group(['middleware' => 'auth:api'], function () use ($api) {
                $api->get('test', function (){
                    return 'hola';
                });

                $api->get('user', 'ApiController@getUserData');

                $api->get('patient', 'ApiController@getPatientData');
                $api->get('medidasHTA','ApiController@getHTAdata');
                $api->post('nuevamedida', 'ApiController@nuevaMedida');
                $api->get('medidasHTAinOrder/{order}','ApiController@getHTAdataOrder');
                $api->post('updatehta','ApiController@updateHTA');
                $api->post('delete_hta','ApiController@delete_hta');
                $api->get('getHTAbyID','ApiController@getMedidaById');
                //$api->get('getPreguntas','ApiController@getPreguntas');
                $api->post('update_profile','ApiController@update_profile');
                $api->get('peso', 'ApiController@show_weights');
                $api->post('nuevo_peso', 'ApiController@store_weight');
            });
      });

});
