<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    public function courtier(){
        return $this->belongsTo('App\Courtier');
    }
}
