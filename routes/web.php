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

use Illuminate\Http\Request;


Route::get('/', function() {
	return view('welcome');
});

Route::get('github', function(  Request $request ) {
	$request->session()->put( 'url' , $request->url );

	return redirect("dologin");
});

Route::get('/dologin', function () {
	Auth::logout();
	return Socialite::with('digitalocean')->scopes(['read write'])->redirect();
});

Route::get('/afterdo', function() {
	$data = Socialite::driver('digitalocean')->user();
	$user = App\User::where('email', $data->email)->first();

	if( is_null($user) ){
		$user = new App\User;
		$user->email = $data->email;
		$user->token = $data->token;
		$user->name = is_null( $data->name ) ? 'DO User' : $user->name;
		$user->password = Hash::make(time());
	}

	$user->save();

	Auth::login($user);

	return redirect('deploy/info');

});

Route::get('newdroplet', function() {
	return view('newdroplet');
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

Route::get('/deploy/info', 'DeployController@info');

Route::post('deploy/boot', 'DeployController@boot');

Route::get('droplets', 'DeployController@show');
