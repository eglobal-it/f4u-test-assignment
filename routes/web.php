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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/key', function() {
//     return Str::random(32);
// });

$router->get('/clients', [
    'uses' => 'ClientController@getClients'
]);

$router->get('/clients/{id}', [
    'uses' => 'ClientController@getClientById'
]);

$router->post('/clients', [
    'uses' => 'ClientController@addClient'
]);



$router->get('/clients/addresses/{clientId}', [
    'uses' => 'ClientAddressController@getClientAddresses'
]);

$router->post('/clients/addresses', [
    'uses' => 'ClientAddressController@addClientAddress'
]);

$router->put('/clients/addresses', [
    'uses' => 'ClientAddressController@updateClientAddress'
]);

$router->patch('/clients/addresses', [
    'uses' => 'ClientAddressController@setDefaultClientAddress'
]);

$router->delete('/clients/addresses', [
    'uses' => 'ClientAddressController@deleteClientAddress'
]);