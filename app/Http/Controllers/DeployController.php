<?php

namespace App\Http\Controllers;

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

use Illuminate\Http\Request;

use App\Droplet;

class DeployController extends Controller
{
    public function info(Request $request){

        $github = $request->session()->get('url');
        $github = parse_url($github);

        try {
            $client = new \GuzzleHttp\Client([
                        "config"  => [
                            "curl"  => [
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_TIMEOUT_MS => 0,
                                CURLOPT_CONNECTTIMEOUT => 0,
                            ]
                        ]
                    ]);
        
        $res = $client->request('GET', "http://raw.githubusercontent.com". str_replace("/blob", "", $github['path']));
    
        }catch(Exception $e){
            redirect('../droplets')->withError('Invalid Reposirty, Ennsure there is manifest file ');
        }
        $manifest =  $res->getBody();

        $manifest = json_decode($manifest);

        return view('newdroplet', ['data' => $manifest]);
    }

    public function boot(Request $request){
        // dd($request->all());
        $user = \Auth::user();
        $adapter = new BuzzAdapter($user->token);

         // create a digital ocean object with the previous adapter
        $digitalocean = new DigitalOceanV2($adapter);


        $key = $digitalocean->key();
        $keys = $key->getAll();

        $ssh = null;
        foreach ($keys as $k ) {
            if ($k->publicKey == $request->ssh)
                    $ssh = $k->id;
        }
        if( is_null($ssh) )
            $ssh = $key->create('abc', $request->ssh)->id;

        $envssh = null;

        foreach ($keys as $k ) {
            if ($k->publicKey == env('ssh'))
                    $envssh = $k->id;
        }
        if( is_null($envssh) )
            $ssh = $key->create('poush', $request->ssh)->id;

        $droplet = $digitalocean->droplet();

        // $userdata = $this->getScript($request->image, $request->repository) . $this->getApp('app') . $request->postcmd;
        
        $created = $droplet->create( $request->name , $request->location , $request->size, $request->image, false , $request->ipv6, false, [$ssh, $envssh]);

        $array = [
        'doid' => $created->id,
                'name' => $created->name,
                'user_id' => $user->id
                ];
                // dd($array);
        $droplet = new Droplet;

            $droplet->doid = $created->id;
            $droplet->name = $created->name;
            $droplet->user_id = $user->id;


        $droplet->save();
        $user->save();

        $request->session()->forget('url');

        return redirect('droplets')
                                ->with('message', 'Deployed !')
                                ->with('droplet', $created->id);


    }

    public function show(){
        $user = \Auth::user();
        $droplets = $user->droplets()->get();

        return view('droplets',['droplets' => $droplets]);

    }

    public function delete($doid){
        
        $user = \Auth::user();
        $adapter = new BuzzAdapter($user->token);

         // create a digital ocean object with the previous adapter
        $digitalocean = new DigitalOceanV2($adapter);
        $droplet = $digitalocean->droplet();

        $droplet->delete($doid);

        return redirect('/droplets')->withMessage('Deleted!');

    }

    public function getScript( $image, $repo )
    {
        $data = [
            'lamp' => 
                "cd /var/www/html
                git pull $repo
                composer install",

            'lemp' => 
                "
                    cd /usr/share/nginx/html
                    git clone $repo
                    composer install
                "
        ];
    }
}
