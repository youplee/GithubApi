<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';
    
    /**
     * @var string
     */
    protected $table = 'produits';

        /**
     * @var array
     */
    protected $fillable = ['name'];

    
    public function nomDatabase(){

        return Config::get('database.connections.mysql2.database');
    }

    public function courtiers(){
        
        return $this->belongsToMany('App\Courtier',$this->nomDatabase().'.courtier_produits');
    }
}
