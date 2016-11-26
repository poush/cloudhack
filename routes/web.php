<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

Route::get('/', function() {
	return view('welcome');
});

Route::get('/dologin', function () {
	Auth::logout();
	return Socialite::with('digitalocean')->scopes(['read write'])->redirect();
});

Route::get('/afterdo', function() {
	$data = Socialite::driver('digitalocean')->user();
	dd($data);	
	$user = User::where('email', $data->email)->first();

	// if( is_null($user) ){
	// 	$user = 
	// }


});

// Route::get('/admin', function(){

// 	$user = Socialite::driver('digitalocean')->stateless()->user();	

// 	var_dump($user);

// 	// dd($user->token);

// 	$adapter = new BuzzAdapter($user->token);

// 	// create a digital ocean object with the previous adapter
// 	$digitalocean = new DigitalOceanV2($adapter);

// 	$droplet = $digitalocean->droplet();
// 	$created = $droplet->create('the-name', 'nyc1', '512mb', 'ubuntu-14-04-x64');
// 	$droplets = $droplet->getAll();
// 	dd($droplets);

// });

Auth::routes();

Route::get('/home', 'HomeController@index');
