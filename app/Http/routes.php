<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function () use ($app) {
	$app->get('/', function() {
		return '<div style="text-align: center; font-family: Verdana, sans-serif"><h1>API CEP</h1><p>Saiba mais em <a href="https://github.com/davidalves1">github</a></p>';
	});

	$app->get('/{cep}', ['uses' => 'CepController@consulta']);
});
