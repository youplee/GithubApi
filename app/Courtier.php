<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Database;
use Illuminate\Support\Facades\Config;

class Courtier extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';
    
    /**
     * @var string
     */
    protected $table = 'courtiers'; 

    public function nomDatabase(){
        
        return Config::get('database.connections.mysql2.database');
    }
        
    public function produits(){

        return $this->belongsToMany('App\Produit', $this->nomDatabase().'.courtier_produits')
                    ->withPivot('produit_id');
    }

    public function agences(){
    	return $this->hasMany('App\Agence', $this->nomDatabase().'.agences');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function licences(){
        return $this->hasMany('App\Licence');
    }
}
