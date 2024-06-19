<?php

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\GuruController;
// use App\Http\Controllers\KelasController;
// use App\Http\Controllers\MatpelController;
// use App\Http\Controllers\NilaiController;
// use App\Http\Controllers\SiswaController;

/** @var \Laravel\Lumen\Routing\Router $router */

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


// Auth Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});
// Guru Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('gurus', ['uses' => 'GuruController@index']);
    $router->get('gurus/{id}', ['uses' => 'GuruController@show']);
    $router->post('gurus', ['uses' => 'GuruController@store', 'middleware' => 'jwt.auth']);
    $router->put('gurus/{id}', ['uses' => 'GuruController@update', 'middleware' => 'jwt.auth']);
    $router->delete('gurus/{id}', ['uses' => 'GuruController@destroy', 'middleware' => 'jwt.auth']);
});
// $router->get('/gurus', 'GuruController@index');
// $router->get('/gurus/{id}', 'GuruController@show');
// $router->post('/gurus', ['uses' => 'GuruController@store', 'middleware' => 'jwt.auth']);
// $router->put('/gurus/{id}', ['uses' => 'GuruController@update', 'middleware' => 'jwt.auth']);
// $router->delete('/gurus/{id}', ['uses' => 'GuruController@destroy', 'middleware' => 'jwt.auth']);


// Siswa Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('siswas', 'SiswaController@index');
    $router->get('siswas/{nisn_siswa}', 'SiswaController@show');
    $router->post('siswas', 'SiswaController@store');
    $router->put('siswas/{nisn_siswa}', 'SiswaController@update');
    $router->delete('siswas/{nisn_siswa}', 'SiswaController@destroy');
});
// $router->get('/siswa', 'SiswaController@index');
// $router->get('/siswa/{id}', 'SiswaController@show');
// $router->post('/siswa', 'SiswaController@store');
// $router->put('/siswa/{nisn_siswa}', 'SiswaController@update');
// $router->delete('/siswa/{nisn_siswa}', 'SiswaController@destroy');

// Matpel Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('matpels', 'MatpelController@index');
    $router->post('matpels', 'MatpelController@store');
    $router->get('matpels/{id}', 'MatpelController@show');
    $router->put('matpels/{id}', 'MatpelController@update');
    $router->delete('matpels/{id}', 'MatpelController@destroy');
});
// $router->get('/matpels', 'MatpelController@index');
// $router->post('/matpels', 'MatpelController@store');
// $router->get('/matpels/{id}', 'MatpelController@show');
// $router->put('/matpels/{id}', 'MatpelController@update');
// $router->delete('/matpels/{id}', 'MatpelController@destroy');

// Kelas Routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('kelas', 'KelasController@index');
    $router->post('kelas', 'KelasController@store');
    $router->get('kelas/{id}', 'KelasController@show');
    $router->put('kelas/{id}', 'KelasController@update');
    $router->delete('kelas/{id}', 'KelasController@destroy');
});

// Rute untuk presensi
$router->group(
    ['prefix' => 'api'],
    function () use ($router) {
        $router->get('presensi/grouped', 'PresensiController@groupedByStatus');
        $router->get('presensi', 'PresensiController@index');
        $router->post('presensi', 'PresensiController@store');
        $router->get('presensi/{id}', 'PresensiController@show');
        $router->put('presensi/{id}', 'PresensiController@update');
        $router->delete('presensi/{id}', 'PresensiController@destroy');
    }
);

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('nilai', 'NilaiController@index');
    $router->post('nilai', 'NilaiController@store');
    $router->get('nilai/{id}', 'NilaiController@show');
    $router->put('nilai/{id}', 'NilaiController@update');
    $router->delete('nilai/{id}', 'NilaiController@destroy');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('dashboard', 'DashboardController@index');
});

$router->group(
    ['prefix' => 'api'],
    function () use ($router) {
        $router->get('guru/{id}/biodata', 'GuruBiodataController@show');
    }
);
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('logout', 'AuthController@logout');
});

$router->group(['middleware' => 'jwt'], function () use ($router) {
    // Route yang membutuhkan autentikasi JWT di sini
});
