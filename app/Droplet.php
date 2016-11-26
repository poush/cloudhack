<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Droplet extends Model
{
    protected $table = 'droplets';

    protected $fillable = ['*'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
