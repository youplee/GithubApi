<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Database;
use Illuminate\Support\Facades\Config;

class Pack extends Model
{
    protected $connection = 'mysql2';

    public function nomDatabase(){

        return Config::get('database.connections.mysql2.database');
    }

    public function habilitations(){
        return $this->belongsToMany('App\Habilitation', $this->nomDatabase().'.habilitation_pack')
                                    ->withPivot('pack_id');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
