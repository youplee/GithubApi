<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Catalogue extends Model
{
        use Favoriteable;

        protected $fillable = ['lien', 'typeRecherche_id'];

    public function recherche(){

        return $this->belongsTo('App\Recherche', 'typeRecherche_id');

    }
}
