<?php

namespace App\Http\Controllers;

use DigitalOceanV2\Adapter\BuzzAdapter;
use DigitalOceanV2\DigitalOceanV2;

use Illuminate\Http\Request;

use App\Droplet;

class DeployController extends Controller
{
    public function getManifest($request){
        $github = $request->session()->get('url');
        $github = parse_url($github);

        $manifest = "";
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
    
        $manifest =  $res->getBody();

        }catch(\Exception $e){
            return redirect('../droplets')->withError('Invalid Reposirty, Ensure there is manifest file ');
        }


        $manifest = json_decode($manifest);

        return $manifest;
    }

    public function info(Request $request){

        $manifest = $this->getManifest($request);

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
        // dd($keys);
        // dd(env('ssh'));

        // foreach ($keys as $k ) {
        //     if ($k->publicKey == env('ssh'))
        //             dd("true");
        //             // $envssh = $k->id;
        // }
        // dd($envssh);
        // if( is_null($envssh) )
        //     $envssh = $key->create('poush', $request->ssh)->id;

        $droplet = $digitalocean->droplet();

        $S = [$ssh];
        // if( $ssh == $envssh )
        //     $S = [$ssh];
        // else
        //     $S = [$ssh, $envssh];
        // $userdata = $this->getScript($request->image, $request->repository) . $this->getApp('app') . $request->postcmd;
        $manifest= $this->getManifest($request);
        $userdata = "cd /var/www/html
                git pull $manifest->repository
                composer install
                ";

        $created = $droplet->create( $request->name , $request->location , $request->size, $request->image, false , $request->ipv6, false, $S, $userdata);

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
            $droplet->repo = $manifest->repository;
            $droplet->app = isset($manifest->app)? $manifest->app : '';
            $droplet->image = $manifest->image;

        $droplet->save();
        $user->save();


        return redirect('droplets')
                                ->with('error', "Deployed! DON'T CLOSE BROWSER PROVISIONING!")
                                ->with('droplet', $created->id);


    }

    public function show(){
        if( ! \Auth::check())
            return redirect('login');
        $user = \Auth::user();
        $droplets = $user->droplets()->get();

        return view('droplets',['droplets' => $droplets]);

    }

    public function destroy($id){
        if( ! \Auth::check())
            return redirect('login');

        $user = \Auth::user();
        $adapter = new BuzzAdapter($user->token);

         // create a digital ocean object with the previous adapter
        $digitalocean = new DigitalOceanV2($adapter);
        $droplet = $digitalocean->droplet();

        try {
            $droplet->delete($id);
            Droplet::where('doid',$id)->delete();
        }catch(\Exception $e){
            return redirect('droplets')->withError('Looks likes there is some error. Try in some minutes');
        }

        return redirect('/droplets')->withMessage('Deleted!');

    }


    public function setup(Request $request, $id){
        $drop = Droplet::where('doid',$id)->first();

        $user = \Auth::user();
        $adapter = new BuzzAdapter($user->token);

         // create a digital ocean object with the previous adapter
        $digitalocean = new DigitalOceanV2($adapter);
        $droplet = $digitalocean->droplet();

        $droplet123 = $droplet->getById($id);

        $fp = fopen( public_path()."/logs/$id.txt" ,"w");
        $data = $this->actualDeploy( $drop->repo, $droplet123->networks[0]->ipAddress, $drop->image, $drop->app ) ;
        fwrite($fp, json_encode($data) );
        fclose($fp);

        return "";
        // $request->session()->forget('url');

    }

    public function actualDeploy( $repo, $ip, $image, $app ){

        $envoy = new \App\Envoy;
        $out = '';
        if($image == 'lamp') 
            $out .= json_encode( $envoy->run("lamp --repo=$repo --ip=$ip") );
        // if($app == 'laravel')
        //     $out .= json_encode( $envoy->run("laravel --repo=$repo --ip=$ip") );
        return $out;
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
