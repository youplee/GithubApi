<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Database;
use Illuminate\Support\Facades\Config;
class Habilitation extends Model
{
    protected $connection = 'mysql';

    public function nomDatabase(){
        
        return Config::get('database.connections.mysql2.database');
    }

    public function packs(){
        return $this->belongsToMany('App\Pack', $this->nomDatabase().'.habilitation_pack');
    }
}
