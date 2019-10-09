<?php

use Illuminate\Http\Request;
use function foo\func;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 2,
        'redirect_uri' => 'http://masterkidsapi.test/callback',
        'response_type' => 'code',
        'scope' => 'read',
        'state' => $state,
    ]);

    return redirect('http://masterkids.test/oauth/authorize?'.$query);
});
Route::get('/refresh', function () {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://masterkidsapi.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'def50200e89b6443143dcdca7eef95ac419488815b54512cf6c6e3ffd04cc1ea234582f9e2b8ad7616565dd08f3f7e523c5a92e4a6b9af4d628d3d61ba69cdc0abdc5a5e32a31ed08c412886c529b5371b76bdb2c50e8487ab1ba563378bb3163efd167b0ac8355d0510ba3a5870307b2777866c45071abedde14b9354101355800cb0593846e912a6be4e9130cb18d4545b7af7fcd1c9d3dd3484b0bfd54c7718fc9035fbdbddef9f168dfbc9038354020954f332ddc9465084597ac325593001e60fe1e74d3625ec7f705063a7dc921c80f226488c843c4a73240b0e0504f6a6b7ca0273ef9a71a6636a8361cc1fc22ee5ed617a849adaebf29008db7bf2e5fcfbaa4fece0e335f28de25a486532390a1e47f5d99af15c9d9228c048c3e0a24cdc68aae02c2d73ba13c54a3a188ac30a9bb019f1d5cf1287e2f49dc84cc128be2e6145c1f1ea8257fcc16f994c4a450eebb55d702109a55b696dfbf9ae82c11fd2a7a105e3c0',
            'client_id' => 2,
            'client_secret' => 'q9T21AaYynVY1zB9IyZFsRzJ8deSidfUe8UH4F96',
            'scope' => 'read',
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $http = new GuzzleHttp\Client;
    try{
        $response = $http->post('http://masterkidsapi.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 2,
                'client_secret' => 'q9T21AaYynVY1zB9IyZFsRzJ8deSidfUe8UH4F96',
                'redirect_uri' => 'http://masterkids.test/callback',
                'code' => $request->code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    } catch (\Exception $exception){
       return array('Error' => $exception);
    }
});
