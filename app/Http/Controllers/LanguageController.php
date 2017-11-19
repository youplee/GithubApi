<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Recherche;
class LanguageController extends Controller
{
    public function loadData(){

        $languages  	= Language::where('active',1)->get()->pluck('libelle');
        $typeRecherches = Recherche::where('active',1)->get()->pluck('libelle');
        $sorts 			= ['code' => ['indexed'], 'issues' => ['comments', 'created', 'updated'], 'users' => ['followers', 'repositories', 'joined'], 'repositories' => ['stars', 'forks', 'updated']];
        return $data = ['languages' => $languages, 'typeRecherches' => $typeRecherches, 'sorts' => $sorts];
    }
}
