<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recherche extends Model
{
    public function catalogue() {
    	return $this->hasMany('App\Catalogue');
    }
}
